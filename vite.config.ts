import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
// import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.tsx'],
            ssr : ['resources/js/ssr.tsx'],
            refresh: true,
            // fonts: [
            //     bunny('Instrument Sans', {
            //         weights: [400, 500, 600],
            //     }),
            // ],
        }),
        inertia(),
        react({
            babel: {
                plugins: ['babel-plugin-react-compiler'],
            },
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
    ],
    oxc: {
        jsx: {
            runtime: 'automatic',
        },
    },
    build: {
        chunkSizeWarningLimit: 1200,
        rolldownOptions: {
            output: {
                codeSplitting: {
                    minSize: 3000,
                    groups: [
                        {
                            name(id) {
                                if (
                                    id.includes('node_modules/@mui/')
                                ) {
                                    return 'mui'
                                }
                            },
                        },
                        {
                            name(id) {
                                if (
                                    id.includes('node_modules/@emotion/')
                                ) {
                                    return 'emotion'
                                }
                            },
                            
                        },
                        {
                            name(id) {
                                if (
                                    id.includes('@tanstack/')
                                ) {
                                    return 'tanstack'
                                }
                            },
                        },
                        {
                            name(id) {
                                if (
                                    id.includes('@reduxjs/')
                                ) {
                                    return 'reduxjs'
                                }
                            },
                        },
                    ]
                }
            }
        }
    }
});
