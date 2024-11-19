const path = require('path');

module.exports = {
    entry: './public/js/main.js', // Tvoja glavna JS datoteka
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'public/js'),
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },
        ],
    },
    mode: 'development', // Koristi 'production' za gotove projekte
};