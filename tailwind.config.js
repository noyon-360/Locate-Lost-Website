import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                darkNavy: "#0a192f",
                midnightBlue: "#112240",
                accentBlue: "#64ffda",
                lightCyan: "#a8dcdc",
                softGray: "#ccd6f6",
                mutedWhite: "#e6f1ff",
                charcoalGray: "#8892b0",
            },
            fontFamily: {
                montserrat: ["Montserrat", "sans-serif"],
                lato: ["Lato", "sans-serif"],
            },
        },
    },
    plugins: [],
};
