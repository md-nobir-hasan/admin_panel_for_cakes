$(document).ready(function() {
    show_data();
});

function DataInsert() {
    var cake_name = document.getElementById("cake_name").value;
    // alert(cat_name);
    var material_c = document.getElementById("material_c").value;
    var trta_c = document.getElementById("trta_c").value;
    var ul_c = document.getElementById("ul_c").value;
    var sp_c = document.getElementById("sp_c").value;
    var st_c = document.getElementById("st_c").value;

    var pattern_dis = /(^[0-9]{1,2}%{1}$)/m; //regex for discount validation

    if (
        (cake_name == "") &
        (material_c == "") &
        (trta_c == "") &
        (ul_c == "") &
        (sp_c == "") &
        (st_c == "")
    ) {
        var emty_all = " fill up the form";
        document.getElementById("emptyAll").innerHTML = emty_all;
        document.getElementById("emptyAll").style.display = "block";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (cake_name == "") {
        var emp_name = " Select a Cake Name";
        document.getElementById("emp_name").innerHTML = emp_name;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emp_name").style.display = "block";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (material_c == "") {
        var emt_material_c = " Please,Fill up Material Cost";
        document.getElementById("emt_material_c").innerHTML = emt_material_c;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";

        document.getElementById("emt_material_c").style.display = "block";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (trta_c == "") {
        var empty_trta_c = "Please,Input Transportation Cost";
        document.getElementById("empty_trta_c").innerHTML = empty_trta_c;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "block";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (!pattern_dis.test(ul_c)) {
        var em_ul_c = "You have to input one or two number and one %";
        document.getElementById("em_ul_c").innerHTML = em_ul_c;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "block";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (sp_c == "") {
        var em_sp_c = " Please,Input Space Cost";
        document.getElementById("em_sp_c").innerHTML = em_sp_c;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "block";
        document.getElementById("em_st_c").style.display = "none";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else if (st_c == "") {
        var em_st_c = " Please,Input Staff Cost";
        document.getElementById("em_st_c").innerHTML = em_st_c;
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "block";
        document.getElementById("msg").style.display = "none";
        document.getElementById("errmsg").style.display = "none";
    } else {
        document.getElementById("emptyAll").style.display = "none";
        document.getElementById("emp_name").style.display = "none";
        document.getElementById("emt_material_c").style.display = "none";
        document.getElementById("empty_trta_c").style.display = "none";
        document.getElementById("em_ul_c").style.display = "none";
        document.getElementById("em_sp_c").style.display = "none";
        document.getElementById("em_st_c").style.display = "none";
        $.ajax({
            method: "POST",
            url: "./php_controler/insert.php",
            data: {
                cake_name: cake_name,
                material_c: material_c,
                trta_c: trta_c,
                ul_c: ul_c,
                sp_c: sp_c,
                st_c: st_c,
            },
            success: function(data) {
                show_data();

                if (data == 1) {
                    document.getElementById("msg").style.display = "block";
                } else if (data == 3) {
                    alert("These value is existed.Please,go for edit");
                } else {
                    document.getElementById("errmsg").style.display = "block";
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