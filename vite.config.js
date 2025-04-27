import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    base: process.env.APP_URL + '/', // This ensures Vite uses the correct base URL (HTTPS)
    server: {
        https: process.env.APP_ENV !== 'local',
    },
});
