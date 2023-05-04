$("#but").on("click", function (){

    var name=$("#name").val().trim();
    var surname=$("#surname").val().trim();
    var email=$("#email").val().trim();
    var pass=$("#password").val().trim();
    var repass=$("#repassword").val();

    if (name=="") {
        $("#rez").text("please enter name");
        return false;
    } else if (surname=="") {
        $("#rez").text("please enter surname");
        return false;
    } else if (email=="") {
        $("#rez").text("please enter email");
        return false;
    } else if (pass=="") {
        $("#rez").text("please enter password");
        return false;
    } else if (!email) {
        $("#rez").text("please enter valid email");
        return false;
    } else if (pass!==repass) {
        $("#rez").text("passwords are not the same");
        return false;
    }

    $("#rez").text("");

    $.ajax({
        url: 'php/form.php',
        type: 'POST',
        cache: false,
        data: {'name': name, 'surname': surname, 'email': email, 'password': pass, 'repassword': repass},
        dataType: "json",
        beforeSend: function () {
            $("#but").prop("disabled", true);
            $("#rez").text("Loadind");
        },
        success: function (data) {
            if (data.error===true) {
                $("#rez").text(data.mess);
                // $("#rez").text("");
                $("#but").prop("disabled", false);
            } else {
                $("#form").hide();
                $("#success").text(data.mess);
                $("#rez").text("");
                $("#but").prop("disabled", false);
            }
        },
    });
});