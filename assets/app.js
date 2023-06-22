/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import $ from "jquery";
import Typed from "typed.js";
import "tw-elements";

// Récupérer le bouton hamburger et le menu déroulant

// $(".navbar-nav a").on("click", function (event) {
//   if (this.hash !== "") {
//     event.preventDefault();

//     $("html, body").animate(
//       {
//         scrollTop: $(this.hash).offset().top - 45,
//       },
//       1500,
//       "easeInOutExpo"
//     );

//     if ($(this).parents(".navbar-nav").length) {
//       $(".navbar-nav .active").removeClass("active");
//       $(this).closest("a").addClass("active");
//     }
//   }
// });

if ($(".typed-text-output").length == 1) {
  var typed_strings = $(".typed-text").text();
  var typed = new Typed(".typed-text-output", {
    strings: typed_strings.split(", "),
    typeSpeed: 100,
    backSpeed: 20,
    smartBackspace: false,
    loop: true,
  });
  typed.start(); // démarrer l'animation
}
