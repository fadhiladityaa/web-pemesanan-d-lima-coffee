import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        'host': '0.0.0.0',
        hmr: {
            // *** PENTING: Ganti dengan IP Lokal Anda ***
            host: '192.168.1.9', 
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
