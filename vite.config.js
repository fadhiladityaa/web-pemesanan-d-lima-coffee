import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // server: {
    //     host: '0.0.0.0',
    //     hmr: {
<<<<<<< HEAD
    //         host: '10.11.10.12', // GANTI DENGAN IP LOKAL KAMU!
=======
    //         host: '10.125.152.238', // GANTI DENGAN IP LOKAL KAMU!
>>>>>>> 69fb9ba38e4e3b1d40400438b38456f2eca1b674
    //         protocol: 'ws'
    //     },
    // },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});