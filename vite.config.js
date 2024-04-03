import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                'resources/css/database.css',
                "resources/js/app.js",
                "resources/js/games.js",
                "resources/js/running.js",
                "resources/js/flame_map.js",
                "resources/js/flame.js",
                "resources/js/leave_group.js",
                "resources/js/groups.js",
                "resources/js/libs/htmx.js",
                "resources/js/quiz.js",
                "resources/js/settings/configureSettings.js",
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
