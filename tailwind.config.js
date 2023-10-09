/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {

      boxShadow: {
        'xlx':  '1px 0 10px rgba(0, 0, 0, 0.1), 1px 0 10px rgba(0, 0, 0, 0.1)',
      },

      colors: {
        'blue_gradient': {
          'light': '#6BAAFC',
          'dark': '#305FEC',
        },
        'purple_gradient': {
          'light': '#D623FE',
          'dark': '#A530F2',
        },
      },
    },
  },
  plugins: [],
}


