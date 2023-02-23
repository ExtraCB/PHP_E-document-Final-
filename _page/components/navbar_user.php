<?php 

$menu = ["Homepage","Add_File","History_File_Send"];

$profile = new database();
$userid = $_SESSION['userid'];
$profile -> select("users","*"," id_user = $userid");
$myself = $profile -> query -> fetch_assoc();

if($myself['dept_user'] == ''){
    $dept_myself = 0;
}else{
    $dept_myself = $myself['dept_user'];
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                E-Document
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                foreach($menu as $val) { 
                    $filename = $val.".php";
                    ?>
                <li class="nav-item ">
                    <a class="nav-link <?= ($currentpage == $filename) ? 'active' : '' ?>"
                        href="./../user/<?= $filename; ?>"><?= $val; ?></a>
                </li>
                <?php }
                ?>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <a class="link-secondary me-3" href="#">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <!-- Avatar -->
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./../../file/<?= $myself['file_user'] ?>" class="rounded-circle" height="25" width="25"
                        loading="lazy" />
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item" href="./../general/edit_profile_user.php">My profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./../../_system/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->