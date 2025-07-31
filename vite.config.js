import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        hmr: {
            host: 'localhost',
            protocol: 'ws'
        },
        watch: {
            usePolling: true,
        },
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: ['resources/css/app.css', 'resources/js/app.js'],
            output: {
                entryFileNames: 'assets/[name].[hash].js',
                chunkFileNames: 'assets/[name].[hash].js',
                assetFileNames: 'assets/[name].[hash].[ext]',
            },
        },
        sourcemap: false,
        minify: 'esbuild',
    },
    // Ajouter cette section cruciale
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    base: process.env.NODE_ENV === 'production'
        ? '/build/'
        : '/',
});
