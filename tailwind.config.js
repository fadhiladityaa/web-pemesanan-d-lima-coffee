import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', 'sans-serif'],
                fancy: ['Charm', 'cursive'],
                poppins: ['Poppins', 'serif']
            },
            fontSize : {
                ssm: '0.750rem',
                mmd: '1.1001rem'
            },
            backgroundImage: {
                'bg1': "url('/img/bg.jpeg')"
            },
            colors: {
                primary: "#B6895B",
                secondary: "#EAD8C6",
                menu: "#494949"
            }
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: ["light"],
    },
};
