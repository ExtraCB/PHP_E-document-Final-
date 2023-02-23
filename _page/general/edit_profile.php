<?php 
session_start();
$currentpage = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="./../../style/css/admin_hp.css">
    <script defer src="./../../style/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./../../style/css/bootstrap.css">

</head>

<body>
    <!--Main Navigation-->
    <header>
        <?php include('./../components/sidebar.php') ?>
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row">
                <!-- tab controller -->
                <ul class="nav nav-tabs nav-fill mb-3" id="navtab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#tabs1" class="nav-link active" id="tab1" data-bs-toggle="tab" role="tab"
                            aria-controls="tabs1" aria-selected="true">แก้ไขโปรไฟล์</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs2" class="nav-link " id="tab2" data-bs-toggle="tab" role="tab"
                            aria-controls="tabs2" aria-selected="true">
                            แก้ไขรหัสผ่าน
                        </a>
                    </li>
                </ul>

                <!-- tab1 -->
                <div class="tab-content" id="tab-content">
                    <div class="tab-pane fade show active" id="tabs1" role="tabpanel" aria-labelledby="tab1">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <!-- Default form login -->
                                <form class=" border border-light p-5" action="#!">

                                    <p class="h4 mb-4 text-center">Edit Profile</p>

                                    <!-- Firstname -->
                                    <label for="" class="form-label">Firstname</label>
                                    <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" name="fname"
                                        placeholder="Firstname">

                                    <!-- Lastname -->
                                    <label for="" class="form-label">Lastname</label>
                                    <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" name="lname"
                                        placeholder="Lastname">

                                    <!-- Tel -->
                                    <label for="" class="form-label">Tel</label>
                                    <input type="text" id="defaultLoginFormPassword" class="form-control mb-4"
                                        name="tel" placeholder="Tel">

                                    <!-- Address -->
                                    <label for="" class="form-label">Address</label>
                                    <input type="text" id="defaultLoginFormPassword" class="form-control mb-4"
                                        name="address" placeholder="Address">


                                    <!-- Department -->
                                    <label for="" class="form-label">Department</label>
                                    <select name="dept" id="" class="form-control mb-4">
                                        <option value="" selected>Please Select</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>

                                    <!-- Edit Profile -->
                                    <button class="btn btn-info btn-block my-4 text-white" name="edit_profile"
                                        type="submit">Edit</button>

                                </form>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                    <!-- tab2 -->
                    <div class="tab-pane fade" id="tabs2" role="tabpanel" aria-labelledby="tab2">
                        <div class="tab-pane fade show active" id="tabs1" role="tabpanel" aria-labelledby="tab1">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-6">
                                    <!-- Default form login -->
                                    <form class=" border border-light p-5" action="#!">

                                        <p class="h4 mb-4 text-center">Edit Password</p>

                                        <!-- Password -->
                                        <label for="" class="form-label">Password</label>
                                        <input type="text" id="defaultLoginFormEmail" class="form-control mb-4"
                                            name="password_old" placeholder="Password">

                                        <!-- Password-New -->
                                        <label for="" class="form-label">Password New</label>
                                        <input type="text" id="defaultLoginFormEmail" class="form-control mb-4"
                                            name="password_new" placeholder="Password New">

                                        <!-- Password-Confirm -->
                                        <label for="" class="form-label">Password Confirm</label>
                                        <input type="text" id="defaultLoginFormPassword" class="form-control mb-4"
                                            name="password_confirm" placeholder="Password Confirm">


                                        <!-- Edit Password -->
                                        <button class="btn btn-info btn-block my-4 text-white" name="edit_password"
                                            type="submit">Edit</button>

                                    </form>
                                </div>
                                <div class="col-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!--Main layout-->
</body>


</html>