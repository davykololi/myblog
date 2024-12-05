import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./resources/**/*.js",
    ],

    safelist: [{
        pattern: /hljs+/,
    }],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            typography: {
                DEFAULT: {
                    css: {
                        maxWidth: '100ch',
                        color: '#333',
                        a: {
                            color: '#3182ce',
                            '&:hover': {
                                color: '#2c5282',
                            },
                        },
                    },
                },
            },

            animation: {
                text: 'text 5s ease infinite',
            },
            keyframes: {
                text:{
                    '0% , 100%' : {
                        'background-size' : '200% 200%',
                        'background-position' : 'left center',
                    },
                    '50%' : {
                        'background-size' : '200% 200%',
                        'background-position' : 'right center',
                    }
                }
            }
        }
    },

    plugins: [
            forms,
            typography,
            require('tailwind-highlightjs'),
            ],

    darkMode:'class',
};
