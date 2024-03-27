<?php
include_once 'navbar.php';
include_once 'sidebar.php';
include_once '../admin/config.php';
?>

<style>
.container {
    margin-top: 7rem !important;
    margin-left: 17rem;
    width: 80%;
}
</style>

<?php
$db = dbConnect();
$doctor_name = $_SESSION[ 'doctor_name' ];
if ( !isset( $_SESSION[ 'doctor_email' ] ) ) {
    header( 'Location:signin.php' );
    exit;
}
$qry = "SELECT * FROM appointment WHERE doct_name='$doctor_name'";

$result = mysqli_query( $db, $qry );
$rowcount = mysqli_num_rows( $result );

?>

<div class='container '>
    <div class='row d-flex w-100 me-2 p-2'>
        <div class='col-md-12 p-4 bg-primary w-25'>
            <div class='info-box '>
                <i class='fa fa-database fs-4 me-3'></i>

                <span class='count fs-5 text-white'> <?php  echo $rowcount;
?> </span>
                <div class='title fs-5 text-white  m-4 '>
                    <h5>Appointments</h5>
                </div>
            </div>
        </div>
        <span class='gap' style='width: 10px;'></span>
        <?php
$qry = "SELECT * FROM appointment WHERE status='done' and doct_name='$doctor_name'" ;
$result = mysqli_query( $db, $qry );
$viewcount = mysqli_num_rows( $result );

?>
        <div class='col-md-12 p-4  bg-success w-25'>
            <div class='info-box'>
                <i class='fa fa-cubes fs-4 me-3'></i>

                <span class='count fs-5 text-white '> <?php  echo $viewcount;
?> </span>
                <div class='title fs-5 text-white m-4'>
                    <h5>Visited</h5>
                </div>
            </div>
        </div>
        <span class='gap' style='width: 10px;'></span>
        <?php
$qry = "SELECT * FROM appointment WHERE status='cancel' and doct_name='$doctor_name'" ;
$result = mysqli_query( $db, $qry );
$cancelcount = mysqli_num_rows( $result );

?>
        <div class='col-md-12 p-4  bg-warning w-25'>
            <div class='info-box'>
                <i class='fa fa-cubes fs-4 me-3'></i>

                <span class='count fs-5 text-white '> <?php  echo $cancelcount;
?> </span>
                <div class='title fs-5 text-white m-4'>
                    <h5>Cancel</h5>
                </div>
            </div>
        </div>
    </div>
</div>