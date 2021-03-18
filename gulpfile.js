const fs = require('fs');
const path = require('path');
const gulp = require('gulp');
const gulpSass = require('gulp-sass');
const through = require('through2');
const glob = require('glob');
const webpack = require('webpack');
const zip = require('gulp-zip');
const wait = require('gulp-wait');
const browserSync = require('browser-sync');
const wpcli = require('./env/wpcli');
const getArguments = require('./env/getArguments');

require('dotenv').config();

getArguments.parse();

const dist = 'web';

const appArguments = getArguments();
const production = !!appArguments.production;

/**
 * Like regular `require` but invalidates the cache for the module.
 * That means we'll get *a new object* each time we require a file
 * this way. This allows us to safely mutate the the required object
 * (e.g. a config file).
 */
const requireNoCache = module => {
    delete require.cache[require.resolve(module)];
    return require(module);
};

gulp.task(`styles:all`, () => {
    return gulp
        .src([`${dist}/app/themes/**/*.{sass,scss}`], {base: './'})
        .pipe(wait(100))
        .pipe(
            gulpSass({
                outputStyle: production ? 'compressed' : 'expanded',
                precision: 8,
                includePaths: glob.sync(`./${dist}/app/themes/**/css/`),
            }).on('error', gulpSass.logError)
        )
        .pipe(gulp.dest('./'));
});

gulp.task('styles:all:watch', () => {
    gulp.watch(`${dist}/app/themes/**/*.{sass,scss}`, gulp.task('styles:all'));
});

/*
 * Remove all generated JS bundles.
 * If webpack is configured to add hash to bundles they will not be overriden,
 * so multiple builds just keep adding new files. This task will remove
 * the generated bundles to have fresh build every time.
 */
gulp.task('clean-bundles', () => {
    return gulp.src(`${dist}/app/themes/**/*bundle*.js`).pipe(
        through.obj((chunk, enc, cb) => {
            fs.unlinkSync(chunk.path);
            cb(null, chunk);
        })
    );
});

/*
 * Compile scripts using webpack.
 */

/**
 * @param {string} configName Name of the config file to import.
 * @param {string} name Printed in console to identify the build, for devs convenience.
 * @param {function} cb Gulp callback, passes from task.
 */
const compileWebpack = (configName, name, cb) => {
    if (!fs.existsSync(`${configName}.js`)) {
        cb();
        return;
    }

    const config = requireNoCache(configName);

    // It's possible that config will not exits, because if the entry files' glob from webpack's 
    // configuration is empty (such files or directories do not exist) then we don't want to compile 
    // webpack for that configuration (thus webpack config will return nothing in that case).
    //
    // We want to have one version of environment that works with both old and new wp frameworks.
    // In the new wp framework separate webpack configuration for compilation of JS files in blocks is needed. 
    // In the old wp framework blocks directory (and js files for blocks) do not exist, so it is necessary to add 
    // this check below to prevent the build from failing when those files are not found.
    if (!config) { 
        cb(); 
        return; 
    }

    if (production) {
        config.mode = 'production';
    }

    console.info(`\n[webpack][${name}]\n`);

    webpack(config, (err, stats) => {
        console.info(
            stats.toString({
                chunks: false, // Makes the build much quieter
                colors: true,
            })
        );

        cb();
    });
};

gulp.task('scripts:default', cb => {
    compileWebpack('./webpack.config', 'default', cb);
});

gulp.task('scripts:ie', cb => {
    compileWebpack('./webpack.config.ie', 'IE', cb);
});

gulp.task('scripts:gutenberg', cb => {
    compileWebpack('./webpack.config.gutenberg', 'gutenberg', cb);
});


gulp.task('scripts', gulp.series('scripts:default', 'scripts:ie', 'scripts:gutenberg'));

const compileOnWatch = compiler => {
    // We need a named function here (instead of doing e.g.
    // `compiler => cb =>`), because otherwise gulp displays `<anonymous>`,
    // which is not very helpful.
    // eslint-disable-next-line sonarjs/prefer-immediate-return
    const watchIsCompiling = cb => {
        compiler.run((_error, stats) => {
            console.info(
                stats.toString({
                    colors: true,
                })
            );

            console.info();
            cb();
        });
    };

    return watchIsCompiling;
};


gulp.task('scripts:watch:modern', () => {
    const config = requireNoCache('./webpack.config.js');

    const compiler = webpack(config);

    return gulp.watch(`${dist}/app/themes/**/*.{js,ts}`, compileOnWatch(compiler));
});

gulp.task('scripts:watch:ie', () => {
    if (!fs.existsSync('webpack.config.ie.js')) {
        return;
    }

    const config = requireNoCache('./webpack.config.ie.js');

    if (!config) { 
        return;
    }
    
    const compiler = webpack(config);

    return gulp.watch(`${dist}/app/themes/**/*.{js,ts}`, compileOnWatch(compiler));
});

gulp.task('scripts:watch:gutenberg', () => {
    if (!fs.existsSync('webpack.config.gutenberg.js')) {
        return;
    }

    const config = requireNoCache('./webpack.config.gutenberg.js');

    if (!config) { 
        return;
    }

    const compiler = webpack(config);

    return gulp.watch(`${dist}/app/themes/**/*.{js,ts}`, compileOnWatch(compiler));

});


gulp.task(
    'scripts:watch',
    gulp.parallel('scripts:watch:modern', 'scripts:watch:ie', 'scripts:watch:gutenberg')
);

/*
 * Launch browsersync for live reload and browser testing.
 */
gulp.task('browsersync', () => {
    return browserSync({
        files: [
            {
                match: `${dist}/**/*.*`,
            },
        ],
        ignore: [`${dist}/app/uploads/*`],
        watchEvents: ['change', 'add'],
        codeSync: true,
        proxy: process.env.APP_URL,
        snippetOptions: {
            ignorePaths: ['*/wp/wp-admin/**'],
        },
    });
});

/*
 * Watch changes to files, and recompile.
 */
gulp.task(
    'watch',
    gulp.parallel('styles:all:watch',  'scripts:watch', 'browsersync')
);

/*
 * Build the project.
 */
gulp.task('build', gulp.series('styles:all', 'clean-bundles', 'scripts'));

/*
 * Filepack
 */
gulp.task('filepack', () => {
    return gulp
        .src([
            'web/app/**',
            '!web/app/mu-plugins/**',
            '!web/app/mu-plugins',
            'db/db.sql',
            'resources/theme-installation-instructions.pdf',
        ])
        .pipe(zip('filepack.zip'))
        .pipe(gulp.dest(dist));
});

/*
 * WordPress / database tasks
 */
gulp.task('db:export', cb => {
    // Output file name.
    let exportName = appArguments.file || 'db';

    // Add timestamp if requested by a parameter.
    const dateSuffix = !!appArguments.timestamp;
    if (dateSuffix) {
        exportName = `${exportName}-${Date.now()}`;
    }

    // We add an option to remove the "/wp" part from the URL in case
    // the page is to be installed without bedrock.
    const removeWp = !!appArguments['no-wp'];

    // What to replace the site URL with?
    const replaceWith = appArguments.url || '<-- REPLACE_ADDRESS -->';

    // Target location with filename for our database dump
    const filePath = `db/${exportName}.sql`;

    if (removeWp) {
        // Remove "/wp" from the URL.
        // Some URLs have "/wp" at the end, and some don't. We need to replace
        // both with the same target URL. In that case we need to use
        // a --regex flag which will tell `search-replace` to treat
        // first argument as an regex expression (without delimiters).

        const replace = `${process.env.APP_URL}(/wp)?`;

        wpcli('search-replace', [
            `"${replace}"`,
            `"${replaceWith}"`,
            `--export=${filePath}`,
            `--regex`,
            `--all-tables-with-prefix`,
        ]);
    } else {
        // Do not remove "/wp" from the URL.
        // This is used when we want to create an SQL dump for environments
        // that use Bedrock. Just replace the main address, nothing more.
        const replace = process.env.APP_URL;
        wpcli('search-replace', [
            `"${replace}"`,
            `"${replaceWith}"`,
            `--export=${filePath}`,
            `--all-tables-with-prefix`,
        ]);
    }

    // Wordpress tables have "zero" value as an default for datetime columns
    // which are treated as an error when SQL_MODE
    // contain `NO_ZERO_IN_DATE, NO_ZERO_DATE` flags
    // (like it is on some mysql configurations).
    // This fix writes to sql dump file 2 lines that will
    // temporairly change the SQL_MODE to more liberal one
    // so our dump can be successfully imported.
    const sqlContent = fs.readFileSync(filePath);
    const prependSql =
        "/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;";
    const appendSql = '/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;';
    fs.writeFileSync(filePath, `${prependSql}\n${sqlContent}\n${appendSql}`);

    cb();
});

gulp.task('db:import', cb => {
    const fileName = appArguments.file || 'db';
    if (!fs.existsSync(path.resolve(__dirname, `db/${fileName}.sql`))) {
        cb();
        return;
    }

    wpcli('db', ['import', `db/${fileName}.sql`]);

    wpcli('search-replace', [
        '"<-- REPLACE_ADDRESS -->"',
        `"${process.env.APP_URL}"`,
        `--all-tables-with-prefix`,
    ]);

    cb();
});

/*
 * Installation
 */
const installWordpress = cb => {
    // wpcli('db', ['create']);

    // wpcli('core', [
    //     'install',
    //     `--url="${process.env.APP_URL}"`,
    //     `--title="WP Title Example"`,
    //     '--admin_user=wpdev',
    //     '--admin_email="example@example.com"',
    //     '--admin_password="qwe123EWQ#@!"',
    // ]);

    // wpcli('rewrite', ['flush']);

    // cb();
};

gulp.task('wp-install', installWordpress);

/**
 * Flush permalinks
 */
gulp.task('wp-flush', cb => {
    wpcli('rewrite', ['flush', '--hard']);

    cb();
});

/**
 * Regenerate thumbnails
 */
gulp.task('wp-regen', cb => {
    wpcli('media', ['regenerate', '--yes']);

    cb();
});

gulp.task('install', installWordpress);

/*
 * This runs when you just type "gulp".
 */
gulp.task('default', gulp.series('build', 'watch'));
