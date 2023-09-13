import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/color.js',
                'resources/js/department.js',
                'resources/js/favourite.js',
                'resources/js/reviews.js',
                'resources/js/cart.js',
                'resources/js/checkout.js',
                'resources/js/order.js',
            ],
            refresh: true,
        }),
    ],
});
