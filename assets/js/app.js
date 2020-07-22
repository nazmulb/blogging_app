/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "../scss/app.scss";

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from "jquery";

// JS for public website

const resetMsg = function () {
    $('#msgCmt').html('');
};

$(document).ready(function () {
  //$('.footer-text').prepend(greet('jill'));

  $("#postCommentForm").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);

    $.ajax({
      type: form.attr("method"),
      url: form.attr("action"),
      data: form.serialize(), // serializes the form's elements.
      success: function (data) {
        form.trigger("reset");
        $('#newPostComments').append(`<p>${data.message}</p>`);
      },
      error: function (data) {
        console.log(data);
        $('#msgCmt').append('<p class="alert alert-danger">Something went wrong.</p>');

        setTimeout(resetMsg, 3000);
      },
    });
  });
});
