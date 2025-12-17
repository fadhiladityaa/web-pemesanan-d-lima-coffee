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
                primary: "#C67C4E",
                secondary: "#EAD8C6",
                menu: "#494949"
            },
            boxShadow: {
                soft: '2px 2px 4px rgba(0, 0, 0, .12), -2px -2px 12px rgba(0, 0, 0, .098)',
                medium:  '0 5px 9px rgba(0, 0, 0, .12), 0 -3px 9px rgba(0, 0, 0, .08)',
                cust: '10px 10px 0px rgba(0, 0, 0, 10), -10px -10px 0px rgba(0, 0, 0, 10),'
,
            }
        },
    },
    plugins: [
        require("daisyui"),
        require("tailwind-scrollbar-hide"),
    ],
    daisyui: {
        themes: ["light"],
    },
};
