<?php
include_once '../admin/config.php';
error_reporting( 0 );
if ( isset( $_POST[ 'login' ] ) ) {
    $password = $_POST[ 'password' ];
    setSession( 'password', $password );
    //session insert
    $email = $_POST[ 'email' ];
    setSession( 'email', $email );
    //session insert
    $db = dbConnect();
    $qry = "SELECT * FROM `patient` WHERE email = '$email'";
    $result = mysqli_query( $db, $qry );
    $row = $result->fetch_assoc();
    if ( $row[ 'email' ] == getSession( 'email' ) && $row[ 'password' ] == getSession( 'password' ) ) {
        setSession( 'pat_name', $row[ 'name' ] );
        //session insert
        setSession( 'pat_id', $row[ 'id' ] );
        //session insert
        echo '<script type="text/Javascript"> alert("Login successfully.")</script>';
    } else {
        echo '<script type="text/Javascript"> alert("Error Login.")</script>';
    }

}

?>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<script src='js/bootstrap.bundle.min.js'></script>
<link rel='stylesheet' href='fontawesome-free-6.4.0-web\css\all.min.css'>

<style>
.navbar {
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 100;
    margin-bottom: 0px;
}

.nav-item a {
    color: #fff;
}

.modal-backdrop {
    z-index: -100;
    opacity: 0.1;
}

.modal-backdrop {
    display: none;
}
</style>

<nav class='navbar navbar-dark bg-primary navbar-expand-lg mb-3'>
    <div class='container-fluid '>
        <div class='d-inline-block align-text-top'>
            <a class='navbar-brand ' href='#'>
                <i class='fa fa-heartbeat' style='font-size:22px;color:aqua'>&nbsp;
                    Medical Appointment
                </i>
            </a>
        </div>

        <ul class='navbar-nav '>
            <li class='nav-item'>
                <a class='nav-link ' aria-current='page' href='index.php'>
                    <h5>Home</h5>
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' href='newdoctors.php'>
                    <h5>Search Doctor</h5>
                </a>
            </li>

            <li class='nav-item'>
                <a class='nav-link ' href='appointment.php'>
                    <h5>Appointments</h5>
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link ' href='about.php'>
                    <h5>About</h5>
                </a>
            </li>
            <!-- Button trigger modal -->
            <?php
$some = getSession( 'pat_id' );
if ( !isset( $some ) ) {
    echo "<button type = 'button' class = 'btn btn-primary' data-bs-backdrop = 'static' data-bs-toggle = 'modal' data-bs-target = '#staticBackdrop'> <h5> Login</h5> </button>";
} else {
    echo "<button type = 'submit' name='logout' class = 'btn btn-primary' data-bs-backdrop = 'static' ' data-bs-target = '#staticBackdrop'><a href='logout.php'style='text-decoration:none;color:white;'> <h5> Logout </h5> </a></button>";

}
?>
            <!-- Modal -->
            <div class='modal  fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false'
                tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                <div class='modal-dialog '>
                    <div class='modal-content'>
                        <div class='modal-header text-center'>
                            <h5 class='modal-title ' id='staticBackdropLabel'>Login</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <div class='container-fluid col-md-12'>
                                <form action='' id='login-frm' method='post'>
                                    <div class='form-group'>
                                        <label for='' class='control-label'>Email</label>
                                        <input type='email' name='email' required='' class='form-control'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='' class='control-label'>Password</label>
                                        <input type='password' name='password' required='' class='form-control'>
                                    </div><br>
                                    <div>
                                        <a href='register.php'>Create a new account!</a>

                                    </div>
                                    <button type='button' class='btn btn-secondary'
                                        data-bs-dismiss='modal'>Cancel</button>
                                    <button type='submit' name='login' id='login' class='btn btn-primary'>Login</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </ul>

    </div>

</nav>