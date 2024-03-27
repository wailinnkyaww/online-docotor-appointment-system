<?php
include_once 'navbar.php';
include_once 'sidebar.php';
include_once '../admin/config.php';

?>
<style>
.table {
    margin-left: 18rem !important;
    margin-top: 5rem !important;
    width: 70%;
}

table {
    caption-side: top;
}
</style>
<div class='container-md-8 '>
    <table class='table table-light  table-hover'>
        <caption class='fs-4 text-dark'>Cancel Appointment Lists</caption>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Name</th>
                <th scope='col'>Date</th>
                <th scope='col'>Schedule</th>
                <th scope='col'>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
$doctor_name = $_SESSION[ 'doctor_name' ];
if ( isset( $_GET[ 'id' ] ) ) {
    $apps = mysqli_query( $db, "UPDATE appointment SET status='cancel' WHERE id=".$_GET[ 'id' ] );
    echo '<script>window.location.href="appointmentlist.php"</script>';
    exit;

} else {

    $num = 1;
    $qry = mysqli_query( $db, "SELECT * FROM appointment WHERE status='cancel' and doct_name='$doctor_name'" );
    while( $row = $qry->fetch_assoc() ):
    ?>
            <tr>
                <th scope='row'><?php echo $num++  ?></th>
                <td><?php echo $row[ 'pat_name' ]?></td>
                <td><?php  echo changeDay( $row[ 'date' ] ) ?></td>
                <td><?php  echo changeTime( $row[ 'time' ] ) ?></td>
                <td><?php  echo $row[ 'status' ]?></td>
            </tr>
            <?php
    endwhile;

    ?>
        </tbody>
    </table>
</div>
<?php }
    ?>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>