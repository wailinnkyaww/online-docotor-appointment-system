<?php
include_once 'navbar.php';
include_once 'sidebar.php';
include_once '../admin/config.php';
$db = dbConnect();
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
    <table class='table table-dark table-hover '>
        <caption class='fs-4 text-dark'>New Appointment Lists</caption>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Name</th>
                <th scope='col'>Date</th>
                <th scope='col'>Schedule</th>
                <th scope='col'>Status</th>
                <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
$doctor_name = $_SESSION[ 'doctor_name' ];
$num = 1;
$apps = mysqli_query( $db, "SELECT * FROM appointment  WHERE doct_name='$doctor_name'" );
while( $row = $apps->fetch_assoc() ):

?>

            <tr>
                <th scope='row'><?php echo $num++ ?></th>
                <td><?php echo $row[ 'pat_name' ]?></td>
                <td><?php  echo changeDay( $row[ 'date' ] ) ?></td>
                <td><?php  echo changeTime( $row[ 'time' ] ) ?></td>
                <td><?php  echo  $row[ 'status' ] ?></td>
                <td><a href="visitedappointment.php?id=<?php echo $row['id'] ?>">
                        <button type='button' class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='top'
                            data-bs-custom-class='custom-tooltip' data-bs-title='Done'>
                            <i class='fa-solid fa-eye '></i>
                        </button></a>
                    <a href="cancelappointment.php?id=<?php echo $row['id'] ?>">
                        <button type='button' class='btn btn-primary' data-bs-toggle='tooltip' data-bs-placement='top'
                            data-bs-custom-class='custom-tooltip' data-bs-title='Cancel'>
                            <i class='fa-solid fa-xmark'></i>
                        </button></a>
                </td>
            </tr>
            <?php
endwhile;

?>
        </tbody>
    </table>
</div>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>