$(document).ready(function() {
    show_data();
});

function DataInsert() {
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var pattern_dis = /(^[0-9]{1,2}%{1}$)/m; //Regular expresion for discount validation.for this regex  only one or two number and one % can be inputed

    if ((name == "") & (price == "") & (discount == "")) {
        var emty_all = " fill up the form";
        document.getElementById("emptyAll").innerHTML = emty_all;
        document.getElementById("emptyAll").style.display = "block";
        document.getElementById("emptyName").style.display = "none";
        document.getElementById("emptyCode").style.display = "none";
        document.getElementById("emptydetails").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (!name.match(/([A-Za-z]){1,20}/)) {
        var emty_name = "Name fill up with only letter within 20 character";
        document.getElementById("emptyName").innerHTML = emty_name;
        document.getElementById("emptyName").style.display = "block";
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emptyCode").style.display = "none";
        document.getElementById("emptydetails").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (price == "") {
        var emty_code = "fill up price ";
        document.getElementById("emptyCode").innerHTML = emty_code;
        document.getElementById("emptyCode").style.display = "block";
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emptyName").style.display = "none";
        document.getElementById("emptydetails").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (!pattern_dis.test(discount)) {
        var empty_details = " You have to input one or two number and one %";
        document.getElementById("emptydetails").innerHTML = empty_details;
        document.getElementById("emptydetails").style.display = "block";
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emptyName").style.display = "none";
        document.getElementById("emptyCode").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else {
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emptyName").style.display = "none";
        document.getElementById("emptyCode").style.display = "none";
        document.getElementById("show_div").style.display = "block";
        // document.getElementById("show_divt").style.display="block";

        $.ajax({
            method: "POST",
            url: "./php_controler/insert.php",
            data: {
                name: name,
                price: price,
                discount: discount,
            },
            success: function(data) {
                show_data();

                if (data == 1) {
                    alert("This code is exist .Try another.");
                } else if (data == 2) {
                    document.getElementById("msg").style.display = "block";
                    document.getElementById("emptyCode").style.display = "none";
                    document.getElementById("emptyAll").style.display = "none";
                    document.getElementById("emptyName").style.display = "none";
                    document.getElementById("emptydetails").style.display = "none";
                    document.getElementById("errmsg").style.display = "none";
                } else {
                    document.getElementById("errmsg").style.display = "block";
                    document.getElementById("emptyCode").style.display = "none";
                    document.getElementById("emptyAll").style.display = "none";
                    document.getElementById("emptyName").style.display = "none";
                    document.getElementById("emptydetails").style.display = "none";
                    document.getElementById("msg").style.display = "none";
                }
            },
        });
    }
}

function show_data() {
    $.ajax({
        cache: false,
        url: "./php_controler/shows.php",
        method: "POST",
        success: function(data) {
            $("#show_data").html(data);
        },
    });
}