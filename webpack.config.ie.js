delete require.cache[require.resolve('./webpack.config')];
const baseSettings = require('./webpack.config');

// If you need to use any polyfills that can be installed from
// NPM repository, add them here.
const polyfills = [
    'nodelist-foreach-polyfill',
    'element-closest-polyfill',
    'objectFitPolyfill',
];

// Emit it under a different file name, so regular browsers
// don't have to receive the same (much larger) bundle as IE.

baseSettings.output.filename = baseSettings.output.filename.replace('.min.js', '.ie.js');

// Override babel rules for regular JS files.
baseSettings.module.rules[0].use.options.presets = [
    [
        // This preset picks which things to inject and polyfill
        // automatically based on what browsers we want to support.
        // https://babeljs.io/docs/en/babel-preset-env
        '@babel/preset-env',
        {
            useBuiltIns: 'usage',
            corejs: { version: 2, proposals: true },
            targets: {
                ie: 11,
            },
        },
    ],
];

// Override TS rules.
baseSettings.module.rules[1].use[0].options.configFile = 'tsconfig.ie.json';

// Create a new object from entry points with added polyfills
const entryWithPolyfills = Object.entries(baseSettings.entry).reduce(
    (acc, current) => {
        acc[current[0]] = [...polyfills, current[1]];
        return acc;
    },
    {}
);

baseSettings.entry = entryWithPolyfills;

module.exports = baseSettings;
