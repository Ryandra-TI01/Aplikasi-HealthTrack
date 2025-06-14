import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
            },
            colors: {
                'primary': '#2D805A',
                'secondary-1': '#B2DFDB',
                'secondary-2': '#1C5B3E',
                'secondary-3': '#B1F3B8',
                'secondary-4':'#5AAC7F',
                'error': '#BA0000',
                'black':'#121212',
                'gray-6':'#C7C7CC',
                'gray-3':'#3A3A3C'
            },
            scrollBehavior: {
                smooth: 'smooth',
            },
        },
    },

    plugins: [
        forms, typography,
        require('@tailwindcss/forms'),
        function ({ addUtilities }) {
        addUtilities({
            '.link-underline': {
            position: 'relative',
            },
            '.link-underline::after': {
            content: '""',
            position: 'absolute',
            left: '0',
            bottom: '-2px',
            width: '0%',
            height: '2px',
            backgroundColor: '#2D805A',
            transition: 'width 0.3s ease-in-out',
            },
            '.link-underline:hover::after': {
            width: '100%',
            },
        })
        }
  ],
};
