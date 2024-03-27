<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome-free-6.4.0-web\css\all.min.css">
<script src="js/bootstrap.bundle.min.js"></script>

<style>
.navbar {
    z-index: 10;
}
</style>
<?php 
 include_once "config.php";
  $admin_name=$_SESSION['admin_name']; 

?>
<nav class="navbar navbar-dark bg-primary navbar-expand-lg position-fixed w-100 ">
    <div class="container-fluid">
        <div class="d-inline-block align-text-top">
            <a class="navbar-brand " href="#">
                <i class="fa fa-heartbeat" style="font-size:22px;color:aqua">&nbsp;Medical Appointment
                </i>
            </a>
        </div>

        <ul class="navbar-nav ">

            <li class="nav-item dropdown float-right " style="list-style: none;padding-right:100px">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="true"> <span style="z-index:999;color: #fff;font-weight:500;font-size:20px">
                        <?php echo 'Welcome '.ucfirst($admin_name) ?>
                    </span>
                </a>
                <ul class="dropdown-menu bg-gray extended">
                    <li><a class="dropdown-item" href="logout.php">Logout

                        </a></li>


                </ul>
            </li>
        </ul>
    </div>
</nav>