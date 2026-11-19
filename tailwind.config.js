import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './app/Services/**/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    DEFAULT: '#18134E',
                    50: '#F2F1FA',
                    100: '#E4E2F5',
                    700: '#28217A',
                    800: '#1E1861',
                    900: '#18134E',
                    950: '#0F0B33',
                },
                gold: {
                    DEFAULT: '#C5922A',
                    50: '#FBF7EE',
                    100: '#F5EBD3',
                    200: '#EAD4A0',
                    300: '#DFBC6D',
                    400: '#D5A43F',
                    500: '#C5922A',
                    600: '#B27F1E',
                    700: '#8F6315',
                },
                canvas: '#F8F9FC',
            },
        },
    },
    plugins: [forms],
};
