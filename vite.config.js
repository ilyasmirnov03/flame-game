import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/running.js",
                "resources/js/groups.js",
                "resources/js/flame.js",
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: "localhost",
        },
    },
});
