<?php
include('../include/dbh.employee.php');
$dbh = new dbHandler();
$userData = $dbh->getAllClientInfoByID($_POST['id']);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="../message/message.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="card" style="background-color:#f8f9fa;">
    <div class="card-body h-100">
        <div class="d-flex justify-content-between">
            <h5 class="text-capitalize mx-3 mt-1"><?php echo $userData->fullname; ?></h5>
            <div class="dropdown m-0">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-images fs-4"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" id="filesTab" data-bs-toggle="modal" href="#fileModal" data-id="<?php echo $userData->id; ?>">Files & Images</a></li>

                </ul>
            </div>
        </div>
<<<<<<< Updated upstream

        <form id="messageEmployee">
            <input class="card-subtitle text-muted align-bottom m-0" name="clientID" id="clientID" value="<?php echo $userData->id; ?>" hidden>
            <div class="border" id="scrollBar" style="height: 700px; overflow-y:scroll;">
                <div class="p-3" id="messageRetrieve">
                    <div class="">
                        <small class="text-start" id="clientNameHeader"></small>
                        <div class="text-bg-secondary p-2 rounded-4" id="messageBubble"></div>
                    </div>
                </div>
            </div>
           

            <div class="card-footer d-flex justify-content-start align-items-center px-0"  style="background-color:#f8f9fa;" >
                <textarea type="text" class="form-control " id="contentID" name="employeeMessage" placeholder="Type message..." style="height: 20px;"></textarea>
                <div class="dropdown m-0">
                <button class="btn ms-1 text-muted" type="button file"  data-bs-toggle="dropdown" id="filesEmployee aria-expanded="false>
                <i class="fas fa-paperclip"></i>
                </button>
                <!-- <input type="text"> -->
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" id="filesTab" data-bs-toggle="modal" href="#attachModal" data-id=" ">Add Attachment(s)</a></li>
                    <li><a class="dropdown-item" id="filesTab" data-bs-toggle="modal" href="#attachModal" data-id=" ">Cost Estimate</a></li>
                </ul>
            </div>
                <!-- <button type="file" class="ms-1 text-muted btn" id="filesEmployee">
                    <i class="fas fa-paperclip"></i>
                </button> -->
                <button type="submit" class="ms-3 btn btn-primary btn-sm px-3">
                <i class="fas fa-paper-plane"></i>
                </button>
               
            </div>
        </form>
        <div id="filesContent">
            <div class="bg-info" id="scrollBar" style="height: 500px;  overflow-y:scroll;">
                <div class="p-3" id="messageRetrieve">
                    <div class="">
                        <!-- <small class="text-start" id="clientNameHeader"></small>
=======
    </div>
    <div class="card-body p-4">
        <h5 class="text-capitalize mx-3 mt-1"><?php echo $userData->fullname; ?></h5>
        <div class="container-fluid">
            <ul class="nav nav-pills nav-fill mb-1">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" id="messageTab">Message</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="filesTab">Files & Images</a>

                </li>
            </ul>
            <form id="messageEmployee">
                <input class="card-subtitle text-muted align-bottom m-0" name="clientID" id="clientID" value="<?php echo $userData->id ?>" hidden>
                <div class="border" id="scrollBar" style="height: 400px; overflow-y:scroll;">
                    <div class="p-3" id="messageRetrieve">
                        <div class="">
                            <small class="text-start" id="clientNameHeader"></small>
                            <div class="text-bg-secondary p-2 rounded-4" id="messageBubble"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <textarea class="form-control" aria-label="With textarea" id="contentID" name="employeeMessage"></textarea>
                    <input type="file" class="filesEmp" id="filesEmployee" name="filesEmployee[]" multiple>
                    <input type="file" class="costEst btn btn-success" id="costEstimate" name="costEstimate">                    
                    <button type="submit" class="btn btn-primary px-5 mt-3">Send</button>
                    <div class="alert alert-danger mt-3" role="alert" id="errorFiles">
                    </div>
                </div>
            </form>
            <!-- $q = "UPDATE mdl_user SET firstname=IF(LENGTH('$fname')=0, firstname, '$fname'),
             lastname=IF(LENGTH('$lname')=0, lastname, '$lname'), email=IF(LENGTH('$email')=0, email, '$email'),
              address='$address', city='$city', school='$school', phone1='$phone' WHERE id='$uid'"; -->
            <div id="filesContent">
                <div class="" id="scrollBar" style="height: 500px; overflow-y:scroll; background-color:bisque;">
                    <div class="p-3" id="filesRetrieve">
                        <div class="">
                            <!-- <small class="text-start" id="clientNameHeader"></small>
>>>>>>> Stashed changes
                            <div class="text-bg-secondary p-2 rounded-4" id="messageBubble"></div> -->
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    $(document).ready(function() {

        $("#filesContent").hide();
        $("#messageTab").click(function() {

            $(this).addClass("active");
            $("#filesTab").removeClass("active");
            $("#messageEmployee").show();
            $("#filesContent").hide();

        });

        $("#filesTab").click(function() {

            $(this).addClass("active");
            $("#messageTab").removeClass("active");
            $("#filesContent").show();
            $("#messageEmployee").hide();

        });

        $(".border").scrollTop($(".border")[0].scrollHeight);

        $('#messageBubble').hide();
        $('#errorFiles').hide();
        displayMessage();
        // setInterval(displayMessage, 1000);

        $('#messageEmployee').submit(function(e) {

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "../message/messageProcess.php",
                data: new FormData(this),
                // dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#messageEmployee').trigger("reset");
                    $('#filesEmployee').trigger("reset");
                    $('#costEstimate').trigger("reset");
                    $('#contentID').html("");
                    if (response.status == 'success') {
                        displayMessage();
                    }
                },
                error: function(response) {
                    console.error(response.responseText);
                }
            });
        });


        $('#filesEmployee').change(function(e) {
            e.preventDefault();
            var $fileUpload = $("input[name='filesEmployee']");
            if (parseInt($fileUpload.get(0).files.length) > 5) {

                $('#errorFiles').show();
                $('#errorFiles').html("You can only upload a maximum of 5 files. Please Try again!");
                $('#filesEmployee').trigger("reset");
                
            } else {
                $('#errorFiles').hide();
            }
        });

        // $('#costEstimate').change(function(e){
        //     e.preventDefault();
        //     var costEstUpload = $("#costEstimate");
        //     var dotIndex = costEstUpload.lastIndexOf('.');
        //     var ext = costEstUpload.substring(dotIndex);
        //     if(ext == '.xlsx' || '.xls' || '.pdf' || '.doc' || '.docx'){
        //         $('#errorFiles').show();
        //         $('#errorFiles').html("File type does not match correct format: .xlsx, .xls, .pdf, .docx, doc");
        //         $('#costEstimate').trigger("reset");
        //     }else{
        //         $('#errorFiles').hide();
        //     }
        // });

        function displayMessage() {
            var id = $('#clientID').val();

            $.ajax({
                type: "POST",
                url: "../message/messageProcess.php",
                data: {
                    getMessage: true,
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var splitBack = '';
                    var content = ``;
                    var filesContMsg = ``;
                    // console.log(response);
                    $.each(response.content, function(indexInArray, val) {
                        response.content.sort(function(a, b) {
                            return new Date(a.dateTime) - new Date(b.dateTime);
                        });

                        var isEmployee = false;
                        if (val.sender == "employee") {
                            isEmployee = true;
                        }
                        var contentMsgDisplay = '';
                        var imgArr = val.content.split(',');
                        for (let i in imgArr) {
                            contentMsgDisplay = imgArr[i];
                            // console.log(contentMsgDisplay);

                            var dotIndex = contentMsgDisplay.lastIndexOf('.');
                            var ext = contentMsgDisplay.substring(dotIndex);
                            // console.log(ext);
                            

                            // splitBack = contentMsgDisplay.replace("../../clientEmployeeFiles/", '');
                            
                            //--- para sa mga files ---
                            // console.log(filesContMsg);
                            if (contentMsgDisplay != ext) {
                                // console.log(contentMsgDisplay);
                                if (ext == '.jpg' || ext == '.png') {

                                    
                                    if (isEmployee) {
                                        content += `<div class="d-flex align-items-baseline text-end justify-content-end mb-4">
                                    <div class="pe-2">
                                        <div>
                                            <div class="card text-white d-inline-block p-1  border-0 rounded-4" title="${val.dateTime}" style="background-color: #00a6fb">
                                            <img src="${contentMsgDisplay}" class="d-block img-fluid img rounded-4" style="max-height: 150px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative avatar">
                                        <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle" alt="">
                                    </div>
                                </div> `;
                                    } else {
                                        content += `
                            <div class="d-flex align-items-baseline mb-4">
                            <div class="position-relative avatar">
                                <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle rounded-4" alt="">
                            </div>
                            <div class="pe-2">
                                <div>
                                    <div class="card  text-white d-inline-block p-1  border-0 rounded-4" title="${val.dateTime}" style="background-color: #0582ca">
                                    <img src="${contentMsgDisplay}" class="d-block img-fluid img" style="max-height: 150px;">
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
                                    }
                                } else if (ext == '.doc' || ext == '.docx') {
                                    splitBack = contentMsgDisplay.replace("../../clientEmployeeFiles/", '');
                                    
                                    filesContMsg +=`
                                            <div class="form-control">
                                            <div>${splitBack}</div>
                                            <button type="button" class="fileBtn btn btn-info btn-sm mt-1">Download</button>
                                            </div>`;


                                    // console.log(filesContMsg);
                                    if (isEmployee) {
                                        content += `<div class="d-flex align-items-baseline text-end justify-content-end mb-4">
                                    <div class="pe-2">
                                        <div>
                                            <div class="card text-white d-inline-block p-2 px-3 m-1 border-0 rounded-4" title="${val.dateTime}" style="background-color: #fdfffc">
                                            <div>${splitBack}</div>
                                            <button type="button" class="fileBtn btn btn-info btn-sm mt-1">Download</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative avatar">
                                        <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle" alt="">
                                    </div>
                                </div> `;
                                    } else {
                                        content += `
                            <div class="d-flex align-items-baseline mb-4">
                            <div class="position-relative avatar">
                                <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="pe-2">
                                <div>
                                    <div class="card  text-white d-inline-block p-2 px-3 m-1 border-0 rounded-4" title="${val.dateTime}" style="background-color: #0582ca">
                                    <div>${splitBack}</div>
                                            <button type="button" class="fileBtn btn btn-info btn-sm mt-1">Download</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
                                    }
                                }

                            } else {

                                //para sa text content

                                if (isEmployee) {
                                    content += `<div class="d-flex align-items-baseline text-end justify-content-end mb-4 ">
                                    <div class="pe-2">
                                        <div>
                                            <div class="card text-white d-inline-block p-2 px-3 m-1 border-0 rounded-4" title="${val.dateTime}" style="background-color: #00a6fb">
                                            ${contentMsgDisplay}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative avatar">
                                        <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle" alt="">
                                    </div>
                                </div> `;
                                } else {
                                    content += `
                            <div class="d-flex align-items-baseline mb-4">
                            <div class="position-relative avatar">
                                <img src="../../images/defaultUserImage.jpg" style="max-height: 50px;" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="pe-2">
                                <div>
                                    <div class="card  text-white d-inline-block p-2 px-3 m-1 border-0 rounded-4" title="${val.dateTime}" style="background-color: #0582ca">
                                    ${contentMsgDisplay}
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
                                }
                            }
                        }
                        // <iframe src='https://docs.google.com/viewer?url=ENTER URL OF YOUR DOCUMENT HERE&embedded=true' frameborder='0'></iframe>
                        // <img src="../projects/${data}" class="d-block img-fluid img">

                    });
                    $("#messageRetrieve").html(content);
                    $("#filesRetrieve").html(filesContMsg);

                    $('.fileBtn').click(function(e) {
                        e.preventDefault();
                        var path = 'http://localhost:/AEVGBuilders/clientEmployeeFiles/';
                        var url = path.concat(splitBack);
                        console.log(url);
                        var docuFilesMsg = window.open(url);
                        docuFilesMsg.location;

                    });
                },
                error: function(response) {
                    console.error(response);
                }
            });
        }



    });
</script>