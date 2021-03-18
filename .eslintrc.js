module.exports = {
    extends: ['chop-chop/prettier'],
    rules: {
        // TypeScript checks this
        'import/no-unresolved': 0,
        // Disabled because of react in web in custom gutebnerg blocks
        'react/react-in-jsx-scope': 0,
        'react/jsx-filename-extension': 0,
        'react/prop-types': 0
    },
    settings: {
        'import/resolver': {
            node: {
                extensions: ['.js', '.jsx', '.json', '.ts', '.tsx'],
                paths: ['src'],
            },
        },
    },
};
