/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["**/*.{html,js,php}"], // Include PHP files in the content scanning
  theme: {
    extend: {
      fontFamily: {
        sans: ['Cardo', 'sans-serif'],
        secondary: ['Aclonica'], // Secondary font
      },
      colors: {
        primary: '#BFBFBF', // Custom primary color
        black: '#000000',   // Custom black color
      },
    },
  },
  plugins: [],
};
