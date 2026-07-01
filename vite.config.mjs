import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // Pastikan import ini ada

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // Ubah jadi ini agar tidak memaksa port tertentu jika sedang sibuk
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});