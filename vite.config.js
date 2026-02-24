import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        hmr: {
            host: '192.168.200.121'
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        }
    },
    
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/cek-status.js',
                'resources/js/scroll.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
