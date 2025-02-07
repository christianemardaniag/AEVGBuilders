$(document).ready(function () {
    fetchSettings();
    $("#content").load("dashboard/dashboard.php");
    $("#errorAlert").hide();
    $("#savePassBtn").hide();
    $("#spinnerSettings").hide();
    $("#successAlert").hide();
    $("#pass").hide();

    $(".nav-link").click(function (e) {
        e.preventDefault();
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    });

    $("#dashboardNav").click(function (e) {
        e.preventDefault();
        $("#content").load("dashboard/dashboard.php");
    });

    $("#employeeNav").click(function (e) {
        e.preventDefault();
        $("#content").load("employee/employee.php");
    });

    $("#clientNav").click(function (e) {
        e.preventDefault();
        $("#content").load("client/client.php");
    });

    $("#projectNav").click(function (e) {
        e.preventDefault();
        $("#content").load("projects/projects.php");
    });

    $("#preprojectNav").click(function (e) {
        e.preventDefault();
        $("#content").load("projects/preProjects.php");
    });

    $("#projectStats").click(function (e) {
        e.preventDefault();
        $("#content").load("projectStatus/projectStats.php");
    });

    // $("#materialsNav").click(function (e) {
    //     e.preventDefault();
    //     $("#content").load("materials/materials.php");
    // });

    $("#blockedNav").click(function (e) {
        e.preventDefault();
        $("#content").load("blocked/block.php");
    });

    $("#changePassBtn").click(function () {
        $("#confirmPassword").removeAttr("disabled");
        $("#newPassword").removeAttr("disabled");
        $("#pass").show();
        $("#savePassBtn").show();
    });


    $('#savePassBtn').click(function () {
        $("#errorPass").hide();
    });

    // $("#pass").on("hidden.bs.collapse", function () {
    //     $("#newPassword").attr("disabled", "disabled");
    //     $("#confirmPassword").attr("disabled", "disabled");
    // });

    setInterval(() => {
        $("#timeNow").html(moment().format('llll'));
    }, 1000);

    $("#updateProfileModal").on("show.bs.modal", function () {
        $("#profileForm").trigger("reset");
        $("#errorAlert").hide();
        $.ajax({
            type: "POST",
            url: "profileProcess.php", //
            data: { getAdminInfo: true },
            dataType: "JSON",
            success: function (data) {
                $("#username").val(data.username);
                $("#email").val(data.email);
            },
            error: function (response) {
                alert("SESSION expired login again");
                window.location.href = 'login/login.php';
            }
        });
    });

    $("#profileForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "profileProcess.php",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 'error') {
                    $("#errorAlert").html(response.msg);
                    $("#errorAlert").show();
                } else {
                    $("#newPassword").attr("disabled", "disabled");
                    $("#confirmPassword").attr("disabled", "disabled");
                    $("#pass").hide();
                    $("#updateProfileModal").modal('hide');
                }
            },
            error: function (response) {
                console.error(response);
            }
        });
    });

    $('#logOut').click(function (e) {
        e.preventDefault();
    });

    var meetUpLocation = [];
    function fetchSettings() {
        $.ajax({
            type: "POST",
            url: "../settings/settings.php",
            data: { GET_LOGO: true },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $(".img-logo").attr("src", response.logo);
            }, error: function (response) {
                console.error(response);
            }
        });
        $.ajax({
            type: "POST",
            url: "../settings/settings.php",
            data: { GET_SETTINGS_DETAILS: true },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $("#editAddress").val(response.address);
                $("#editContact").val(response.contact);
                $("#editEmail").val(response.email);
                meetUpLocation = response.appointment;
                displayMeetUpLocation();
            }, error: function (response) {
                console.error(response);
            }
        });
    }

    function displayMeetUpLocation() {
        var content = ``;
        $.each(meetUpLocation, function (indexInArray, val) {
            content += `<li>${val} <button type="button" data-index='${indexInArray}' class="btn btn-sm btn-dark ms-3 removeLocation" style="font-size: 10px;"><i class="fas fa-trash"></i></button></li>`
        });
        $("#editMeetUpLocation").html(content);

        $(".removeLocation").click(function (e) {
            e.preventDefault();
            var index = $(this).data("index");
            meetUpLocation.splice(index);
            displayMeetUpLocation();
        });
    }

    $("#addLocationBtn").click(function (e) {
        e.preventDefault();
        var newLocation = $("#newLocation").val();
        meetUpLocation.push(newLocation);
        $("#newLocation").val("");
        $(this).attr("disabled", true);
        displayMeetUpLocation();
    });

    $("#newLocation").keyup(function (e) {
        var value = $(this).val();
        if (value != "") {
            $("#addLocationBtn").attr("disabled", false);
        } else {
            $("#addLocationBtn").attr("disabled", true);
        }
    });

    $("#editLogo").click(function (e) {
        e.preventDefault();
        $("#logoFile").trigger("click");
    });

    $('#logoFile').change(function () {
        var file = $("#logoFile").get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function () {
                // console.log(reader.result);
                $("#editLogoImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $("#settingsForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../settings/settings.php",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                fetchSettings();
                $("#spinnerSettings").hide();
                $("#successAlert").fadeIn();
            }, beforeSend: function () {
                $("#spinnerSettings").show();
            },
            error: function (response) {
                $("#error").html(response);
                console.error(response);
            }
        });

        $.ajax({
            type: "POST",
            url: "../settings/settings.php",
            data: { editMeetUpLocation: true, location: meetUpLocation },
            dataType: "json",
            success: function (response) {
                console.log(response);
            }, error: function (response) {
                console.error(response);
            }
        });
    });
});
