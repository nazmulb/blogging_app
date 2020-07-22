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
  $("#postCommentForm").submit(function (e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);

    $.ajax({
      type: form.attr("method"),
      url: form.attr("action"),
      data: form.serialize(), // serializes the form's elements.
      success: function (data) {
        form.trigger("reset");
        const newData = `<div class="box-card post-comment">
                            <p class="post-comment-date">${data.content}</p>
                            <p class="post-comment-text">${data.publishedAt}</p>
                        </div>`;
        $('#newPostComments').prepend(newData);
      },
      error: function (data) {
        console.log(data);
        $('#msgCmt').prepend('<p class="alert alert-danger">Something went wrong.</p>');
        setTimeout(resetMsg, 3000);
      },
    });
  });
});
