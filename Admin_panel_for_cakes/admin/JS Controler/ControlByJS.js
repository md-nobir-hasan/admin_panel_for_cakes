$(document).ready(
    function() {
        show_data();
    }

)


function show_data() {
    $.ajax({
        cache: false,
        url: "./php_controler/shows.php",
        method: "POST",
        success: function(data) {
            $("#show_data").html(data);
        }
    });
}