import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import eslintPlugin from 'vite-plugin-eslint';
import eslint from 'vite-plugin-eslint';

export default defineConfig({
    plugins: [
        eslint(),
        laravel({
            input: ['resources/js/app.js','resources/css/app.css'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        eslintPlugin({
            cache: false,
            emitWarning: true,
            emitError: true,
        }),
    ],
});
