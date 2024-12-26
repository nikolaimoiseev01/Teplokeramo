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
                sans: ['Random Grotesque Spacious Book', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '116': '29rem', // 464px
                '128': '32rem',
            },
            animation: {
                'spin-slow': 'spin 20s linear infinite', // Регулируйте скорость вращения через время (4s)
            },
            letterSpacing: {
                // widest: '.1em',
            },
            colors: {
                gold: {
                    200: "#EEE5CF",
                    300: '#EFE5C8',
                    500: '#D9BF79',
                } ,
                black: '#000000',
                dark: '#191A23',
                white: '#ffffff',
                green: {
                    300: '#E5ECDC',
                    400: '#B7C3AA',
                    500: '#9BAA8C',
                    700: '#7CAC56'
                },
                red: {
                    200: '#E83E33',
                    400: '#BE1114'
                },
                brown: '#864D36',
                gray: {
                    200: '#c6c6c6',
                    400: '#767676'
                }
            },
            screens: {
                '2xl': {'max': '1535px'}, // => @media (max-width: 1535px) { ... }
                'xl': {'max': '1279px'}, // => @media (max-width: 1279px) { ... }
                'lg': {'max': '1023px'}, // => @media (max-width: 1023px) { ... }
                'md': {'max': '767px'}, // => @media (max-width: 767px) { ... }
                'sm': {'max': '639px'}, // => @media (max-width: 639px) { ... }
            }
        },
    },

    plugins: [forms],
};
