$(document).ready(function () {
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        // You can add AJAX request here to handle form submission without page reload
        // Example:
        // $.ajax({
        //     url: $(this).attr('action'),
        //     type: $(this).attr('method'),
        //     data: $(this).serialize(),
        //     success: function(response) {
        //         Handle the response from the server
        //     },
        //     error: function(error) {
        //         console.log(error);
        //     }
        // });
    });
});
