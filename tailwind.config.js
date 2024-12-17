import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Random Grotesque Standard', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gold: {
                    300: '#EFE5C8',
                    500: '#D9BF79',
                } ,
                black: '#000000',
                dark: '#191A23',
                white: '#ffffff',
                green: {
                    300: '#E5ECDC',
                    500: '#9BAA8C',
                    700: '#7CAC56'
                },
                red: '#BE1114',
                brown: '#864D36'
            }
        },
    },

    plugins: [forms],
};
