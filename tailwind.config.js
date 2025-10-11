/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: { extend: {colors: {
        'black-theme': '#333333',
        'dark-gray': '#666666',
        'white-theme': '#ffffff',
      },} },
  plugins: [],
}
