/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      fontFamily: {
        exo: ['Exo', 'sans-serif'],  // Ajouter la police Exo
        nunito: ['Nunito', 'sans-serif'],  // Ajouter la police Nunito
      },
      colors: {
        whiteGreen: '#EEFFE5',
        navgreen: '#1B580F',
        button:'#1F8506',
        forestgreen:'#23A300',
        blackgreen: '#083201'
      },
    },
  },
  plugins: [],
};
