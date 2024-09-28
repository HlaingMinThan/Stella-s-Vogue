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
    ],

    theme: {
        extend: {
            keyframes: {
                fadeIn: {
                    '0%': { opacity: 0 },
                    '100%': { opacity: 1 },
                },
            },
            animation: {
                fadeIn: 'fadeIn 0.5s ease-in-out',
            },
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto', 'sans-serif'],
            },
            colors: {
                ...defaultTheme.colors,
                secondary:'#00000080',
                primary: '#CC8809',
                royalBlue: '#0033A0',
                thaiFlagRed: '#DA291C',
                white: '#FFFFFF',
                lightGray: '#F1F1F1',
                thaiGold: '#FFD700',
                darkGray: '#333333',
                lightBlue: '#E6F0FF',
                darkRed: '#A11C22',
            },
            dropShadow: {
                1: '0px 1px 0px #E2E8F0',
            },
            screens: {
                'mbs' : '320px',
                '2xsm': '375px',
                'xsm': '400px',
                'xs' : '480px',
                '3xl': '2000px',
                ...defaultTheme.screens,
            },
            boxShadow: {
                ...defaultTheme.boxShadow,
                card: '0 -1px 12px rgba(0, 0, 0, .015), 0 6px 8px rgba(0, 0, 0, .08)',
            },
            borderWidth:{
                '12': '12px',
                '16': '16px',
                '24': '24px',
            },

            typography: {
                DEFAULT: {
                    css: {
                        li: {
                            p: {
                                margin: 0
                            }
                        }
                    }
                }
            }

        },
    },
    plugins: [forms, typography],
};
