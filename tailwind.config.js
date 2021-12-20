module.exports = {
    darkMode: "media",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/Providers/NavigationServiceProvider.php",
    ],
    theme: {
        extend: {
            colors: {
                'teal-dark': '#237c6d',
                'teal': '#31ad98',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
    ],
}
