/** @type {import('tailwindcss').Config} */
module.exports = {
  prefix: "tw-",
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig ",
    "./node_modules/tw-elements/dist/js/**/*.js",
  ],
  theme: {
    extend: {
      color: {
        "pink-100": "#FFEBF2",
      },
    },
    fontFamily: {
      "f-text": ["Roboto", "sans-serif"],
      "f-title": ["Sansita Swashed", "cursive"],
      "f-second": ["Caveat", "cursive"],
    },
  },
  plugins: [
    require("tw-elements/dist/plugin"), 
    require("@tailwindcss/forms")],
};
