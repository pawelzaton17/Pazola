const path = require('path');
const glob = require('glob');
const entryPlus = require('webpack-entry-plus');

const entryFiles = [
    {
        entryFiles: glob.sync('./web/app/themes/**/parts/**/*index.js'),
        outputName(item) {
            return item.replace('./web', '').replace('index.js', 'index');
        },
    },
    {
        entryFiles: glob.sync('./web/app/themes/**/js/script.js'),
        outputName(item) {
            return item.replace('./web', '').replace('script.js', 'bundle');
        },
    },
];

const settings = {
    entry: entryPlus(entryFiles),
    output: {
        path: path.resolve(__dirname, 'web'),
        filename: '[name].min.js',
    },

    resolve: {
        extensions: ['.js', '.ts', '.tsx'],
        alias: {
            Base: path.resolve(glob.sync('web/app/themes/**/js')[0]),
        },
        modules: [
            path.resolve(glob.sync('web/app/themes/**/js')[0]),
            path.resolve(__dirname, 'node_modules'),
        ],
    },

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    // https://webpack.js.org/loaders/babel-loader/
                    loader: 'babel-loader',
                    options: {
                        plugins: [
                            [
                                '@babel/plugin-proposal-class-properties',
                                { loose: true },
                            ],
                            [
                                '@babel/plugin-proposal-object-rest-spread',
                                { loose: true },
                            ],
                        ],
                    },
                },
            },

            {
                test: /\.(tsx?)$/,
                use: [
                    {
                        loader: 'ts-loader',
                        options: {
                            configFile: 'tsconfig.unstrict.json',
                        },
                    },
                ],
                exclude: /node_modules/,
            },
        ],
    },

    mode: 'development',
};

module.exports = settings;
