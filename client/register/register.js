$(document).ready(function () {
    $("#alertError").hide();
    $("#alertSuccess").hide();

    // $("#step1").hide();
    $("#step2").hide();
    $("#step3").hide();
    $("#step4").hide();


    $("#step1Btn").click(function (e) {
        e.preventDefault();

        var form = $("#registerForm")[0];
        console.log($("#registerForm"));
        if (form[0].checkValidity()) {
            if (form[2].checkValidity()) {
                if (form[3].checkValidity()) {
                    if (form[4].checkValidity()) {
                        $("#step1").hide();
                        $("#step2").show();
                        $(".progress-bar").width("40%");
                    } else {
                        form[4].reportValidity();
                    }

                } else {
                    form[3].reportValidity();
                }
            } else {
                form[2].reportValidity();
            }

        } else {
            form[0].reportValidity();
        }


    });

    $("#prev1Btn").click(function (e) {
        e.preventDefault();
        $("#step1").show();
        $("#step2").hide();
        $(".progress-bar").width("20%");
    });

    $("#step2Btn").click(function (e) {
        e.preventDefault();
        var form = $("#registerForm")[0];
        if (form[8].checkValidity()) {
            if (form[9].checkValidity()) {
                if (form[10].checkValidity()) {
                    $("#step2").hide();
                    $("#step3").show();
                    $(".progress-bar").width("70%");

                } else {
                    form[10].reportValidity();
                }
            } else {
                form[9].reportValidity();
            }

        } else {
            form[8].reportValidity();
        }
        
    });

    $("#prev2Btn").click(function (e) {
        e.preventDefault();
        $("#step2").show();
        $("#step3").hide();
        $(".progress-bar").width("30%");
    });
    $("#step3Btn").click(function (e) {
        e.preventDefault();
        var form = $("#registerForm")[0];
        if (form[13].checkValidity()) {
            if (form[14].checkValidity()) {
                $("#step3").hide();
                $("#step4").show();
                $(".progress-bar").width("100%");
            } else {
                form[14].reportValidity();
                
            }
        } else {
            form[13].reportValidity();
            
        }
       
    });

    $("#prev3Btn").click(function (e) {
        e.preventDefault();
        $("#step3").show();
        $("#step4").hide();
        $(".progress-bar").width("70%");
    });

    $('#registerForm').submit(function (event) {
        event.preventDefault();


        $.ajax({
            type: 'post',
            url: 'registerProcess.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response.status == 'error') {
                    console.log("pasok ba here");
                    $("#alertError").html(response.msg);
                    $("#alertError").show();
                } else {
                    console.log("pasok ba here 2");
                    $("#alertError").hide();
                    $("#alertSuccess").html(response.msg);
                    $("#alertSuccess").show();
                    $('#registerForm').trigger("reset");


                }
            }, error: function (response) {
                console.error(response);
            }
        });
    });

    $('#registerForm').change(function (event) {
        $("#alertError").hide();
        $("#alertSuccess").hide();
    });
});
