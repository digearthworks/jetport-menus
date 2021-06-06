const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            gridTemplateColumns: {
                // Simple 16 column grid
               '16': 'repeat(16, minmax(0, 1fr))',
                // Simple 18 column grid
               '18': 'repeat(18, minmax(0, 1fr))',

               '20': 'repeat(20, minmax(0, 1fr))',
               '22': 'repeat(22, minmax(0, 1fr))',
               '24': 'repeat(24, minmax(0, 1fr))',
               '26': 'repeat(26, minmax(0, 1fr))',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
