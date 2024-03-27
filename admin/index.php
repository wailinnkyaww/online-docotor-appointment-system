<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
$db = dbConnect();
?>
<style>
.container {
    margin-top: 7rem !important;
    margin-left: 15rem;
    width: 80%;
}
</style>
<?php

if ( !isset( $_SESSION[ 'admin_name' ] ) ) {
    header( 'Location:login.php' );
    exit;
}
$qry = 'SELECT * FROM appointment ORDER BY id  ASC ';

$result = mysqli_query( $db, $qry );
$rowcount = mysqli_num_rows( $result );

?>

<div class='container '>
    <div class='row d-flex w-100  m-4 g-3'>
        <div class='col-md-12 p-4 bg-primary w-50'>
            <div class='info-box '>
                <i class='fa fa-database fs-4 me-3'></i>

                <span class='count fs-5 text-white'> <?php echo $rowcount;
?> </span>
                <div class='title fs-5 text-white  m-4 '>
                    <h5>Appointments</h5>
                </div>
            </div>
        </div>
        <?php
$qry = 'SELECT * FROM patient ORDER BY id  ASC ';

$result = mysqli_query( $db, $qry );
$rowcount = mysqli_num_rows( $result );
?>
        <div class='col-md-12 p-4  bg-success w-50'>
            <div class='info-box'>
                <i class='fa-solid fa-users fs-4 me-3'></i>

                <span class='count fs-5 text-white '> <?php  echo $rowcount ?> </span>
                <div class='title fs-5 text-white m-4'>
                    <h5>Patients</h5>
                </div>
            </div>
        </div>
    </div>
    <?php
$qry = 'SELECT * FROM doctor ORDER BY id  ASC ';

$result = mysqli_query( $db, $qry );
$rowcount = mysqli_num_rows( $result );
?>
    <div class='row d-flex w-100 m-4 g-3'>
        <div class='col-md-12 p-4 bg-dark w-50'>
            <div class='info-box '>
                <i class='fa-solid fa-user-doctor fs-4 me-3 text-white'></i>

                <span class='count fs-5 text-white'> <?php echo $rowcount;
?> </span>
                <div class='title fs-5 text-white  m-4 '>
                    <h5>Doctors</h5>
                </div>
            </div>
        </div>
        <?php
$qry = 'SELECT * FROM special ORDER BY id  ASC ';

$result = mysqli_query( $db, $qry );
$rowcount = mysqli_num_rows( $result );
?>
        <div class='col-md-12 p-4  bg-warning w-50'>
            <div class='info-box'>
                <i class='fa-solid fa-notes-medical fs-4 me-3'></i>

                <span class='count fs-5 text-white '> <?php  echo $rowcount ?> </span>
                <div class='title fs-5 text-white m-4'>
                    <h5>Specialties</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</div>