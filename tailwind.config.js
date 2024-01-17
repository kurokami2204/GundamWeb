/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js",
    "./node_modules/flowbite/**/*.js",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screen: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px",
    },
    container: {
      center: true,
      padding: "1rem",
    },
    extend: {
      fontFamily: {
        poppins: ["Poppins", "sans-serif"],
        roboto: ["Roboto", "sans-serif"],
      },
      colors:{
        primary:'#FF6363',
        secondary:{
          100:'#E2E2D5',
          200:'#888883',
          300:'#fd3d57',
          400:'#ca3045'
        },   
      }   
    },
  },
  plugins: [
    require('tw-elements/dist/plugin'),
    require('flowbite/plugin'),
    require('@tailwindcss/line-clamp'),
    require("@tailwindcss/forms"),
  ],
}
