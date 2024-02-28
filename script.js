$(document).ready(function() {
  $('#loginForm').submit(function(e) {
    e.preventDefault();
    var username = $('#username').val();
    var password = $('#password').val();      
    $.ajax({
      type: 'POST',
      url: 'login.php',
      data: { username: username, password: password },
      success: function(response) {          
        var token = JSON.parse(response); // faccio parse
        console.log("Token: " + token.token); // mi restituisco tutto il token in console log          
      },
        error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
  