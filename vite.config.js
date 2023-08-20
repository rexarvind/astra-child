const path = require('path');
import { defineConfig } from 'vite';
import autoprefixer from 'autoprefixer';

export default defineConfig({
    root: path.resolve(__dirname, 'src'),
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
    css: {
        postcss: {
            plugins: [autoprefixer],
        },
    },
    server: {
        port: 8080,
        hot: true,
    },
});
