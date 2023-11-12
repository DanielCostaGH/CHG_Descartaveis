import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import vuetify from 'vite-plugin-vuetify'
import VueRouter from 'vue-router';

export default defineConfig({

    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vuetify(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    optimizeDeps: {
        include: ["swiper/vue"], // Adicione essa linha
    },
});
