$(document).ready(function () {

    $("#alertError").hide();
    $("#alertSuccess").hide();
    $("#profileForm").submit(function (event) {
        // console.log('test lang');
        event.preventDefault();
        $.ajax({
            url: "profileProcess.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);
                //alert("Record successfully updated");

            }
        });
    });
    // $("#changePass").hide();
    // $("#errorAlert").hide();
    // $("#changePassForm").hide();
    // $("#changebtn").click(function(event) {
    //     $("#changePass").show();
});


    // $("#changePassForm").submit(function(event) {
    //     // console.log('test lang');
    //     event.preventDefault();
    //     $.ajax({
    //         url: "changeForm.php",
    //         type: "POST",
    //         dataType: "json",
    //         data: new FormData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function(result) {
    //             console.log(result);
    //             if (result.status == "error") {
    //                 $("#errorAlert").html(result.msg);
    //                 $("#errorAlert").show();
    //             } else {
    //                 alert("Password Changed Succesfully");
    //                 $("#changePass").hide();
    //                 $("#errorAlert").hide();
    //                 $('#changePassForm').trigger("reset");

    //             }

    //         }
    //     });
    // });

    // $("#changeInfoBtn").click(function () {
    //     $(this).addClass("active");
    //     $("#changePasswordBtn").removeClass("active");
    //     $("#passForm").show();
    //     $("#changePassForm").hide();
    // });

    // $("#changePasswordBtn").click(function () {
    //     $(this).addClass("active");
    //     $("#changeInfoBtn").removeClass("active");
    //     $("#changePassForm").show();
    //     $("#passForm").hide();
    // });

//}); // end of document ready function