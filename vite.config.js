import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
<<<<<<< HEAD
            host: '192.168.1.9', // GANTI DENGAN IP LOKAL KAMU!
=======
            host: '10.197.213.11', // GANTI DENGAN IP LOKAL KAMU!
>>>>>>> fadhil/tampilan-dashboard-seederedukasi
            protocol: 'ws'
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});