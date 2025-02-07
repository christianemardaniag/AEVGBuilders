<?php
include("include/dbh.admin.php");
$dbh = new dbHandler();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="include/style.css">
    <link rel="stylesheet" href="admin.css">
    <style media="print">
        #content {
            margin-left: 0px;
        }
    </style>

</head>

<body>
    <div class="container-fluid m-0 p-0">
        <div class="position-fixed d-print-none">
            <main>
                <div class="d-flex flex-nowrap">
                    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
                        <a href="/" class="d-flex mx-auto align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <img src="../images/waevg.png" class="text-center img-logo" height="45">
                        </a>
                        <div class="text-uppercase text-center fw-bold fs-6 d-none d-lg-inline mt-3 text-info">
                            Admin
                        </div>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white active" aria-current="page" id="dashboardNav">
                                    <i class="fad fa-analytics bi me-2"></i>
                                    <span class="d-none d-lg-inline">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white" id="employeeNav">
                                    <i class="far fa-user-alt bi me-2"></i>
                                    <span class="d-none d-lg-inline">Employee</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white" id="clientNav">
                                    <i class="far fa-user-alt bi me-2"></i>
                                    <span class="d-none d-lg-inline">Client</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white" id="projectNav">
                                    <i class="fad fa-folder-open bi me-2"></i>
                                    <span class="d-none d-lg-inline">Finished Projects</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white" id="preprojectNav">
                                    <i class="fad fa-folder-open bi me-2"></i>
                                    <span class="d-none d-lg-inline">Pre-Posted Projects</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-white" id="projectStats">
                                    <i class="fad fa-calendar-alt bi me-2"></i>
                                    <span class="d-none d-lg-inline">Project Status</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#" class="nav-link text-white" id="materialsNav">
                                    <i class="fal fa-paperclip bi me-2"></i>
                                    <span class="d-none d-lg-inline">Materials</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="#" class="nav-link text-white" id="blockedNav">
                                    <i class="fas fa-ban bi me-2"></i>
                                    <span class="d-none d-lg-inline">Archives</span>
                                </a>
                            </li>
                        </ul>


                        <medium id="timeNow"></medium>
                        <hr>
                        <div class="dropdown">
                            <a href="#" id="logOut" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fal fa-user me-2"></i>
                                <strong> ADMIN</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" data-bs-toggle="modal" href="#settings">Settings</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" href="#updateProfileModal">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../logout/logout.php">Sign out</a></li>
                            </ul>
                        </div>


                    </div>
                </div>
            </main>
        </div>

        <div id="content" class="pt-3">

        </div>

    </div>

    <!-- UPDATE PROFILE -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm">
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="username" name="username" placeholder="username" minlength="5" required>
                            <label for="text">Username</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="email" class="form-control" id="email" name="email" email required>
                            <label for="email">Email address</label>
                        </div>
                        <div id="pass">
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="8" required>
                                <label for="password">Old Password</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required disabled>
                                <label for="newPassword">New Password</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password" required disabled>
                                <label for="confirmPassword">Re-type New Password</label>
                            </div>
                        </div>
                        <!-- <button type="submit" class="btn btn-sm btn-danger w-100 mb-2" id="savePassBtn">Save Changes</button> -->
                        <button type="button" class="btn btn-sm btn-primary w-100" id="changePassBtn">Change Password</button>
                        <div class="alert alert-danger mt-2 py-2 text-center" role="alert" id="errorAlert">
                            {{ errorMessage }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Settings -->
    <div class="modal" id="settings" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Settings</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="settingsForm">
                    <div class="modal-body">
                        <div class="container">
                            <div class="alert alert-success alert-dismissible fade show" id="successAlert" role="alert">
                                Save Successfully
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div id="error"></div>
                            <div class="row">
                                <div class="col">
                                    <h5>Logo</h5>
                                    <img src="" alt="Logo" class="img-logo border bg-dark rounded-top" id="editLogoImg" width="300px">
                                    <button class="btn btn-primary d-block rounded-bottom" style="width: 300px; border-radius: 0px;" id="editLogo">Upload New Logo</button>
                                    <input type="file" name="logo" class="d-none" id="logoFile" accept="image/*">
                                    <input type="hidden" name="old_logo" id="old_logo">
                                    <div class="mt-4">
                                        <h5>About Us</h5>
                                        <div class="mb-3">
                                            <label for="editAddress" class="form-label fs-5">Address</label>
                                            <input type="text" class="form-control" id="editAddress" name="editAddress">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editContact" class="form-label fs-5">Contact Number</label>
                                            <input type="text" class="form-control" id="editContact" name="editContact">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editEmail" class="form-label fs-5">Email address</label>
                                            <input type="email" class="form-control" id="editEmail" name="editEmail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h5>Meet Up Location</h5>
                                    <ul id="editMeetUpLocation">
                                    </ul>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="newLocation" id="newLocation">
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary" id="addLocationBtn" disabled>Add Meet Up Location</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col">

                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes
                            <div class="spinner-border spinner-border-sm" role="status" id="spinnerSettings">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="moment.js"></script>
    <script src="admin.js"></script>
</body>

</html>
