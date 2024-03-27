<?php
include_once 'navbar.php';
include_once 'sidebar.php';
include_once '../admin/config.php';
$db = dbConnect();
?>
<style>
.container {
    padding-left: 15rem;
    margin-top: 5rem;
}
</style>

<div class='container  '>
    <h3>Personal Information</h3>
    <div class='card p-3' style='width: 40%;'>

        <?php
$doctor_email = $_SESSION[ 'doctor_email' ];

$qry = "SELECT * FROM doctor WHERE email='$doctor_email'";
$result = mysqli_query( $db, $qry );
while( $row = $result->fetch_assoc() ):
?>
        <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'>Name: <?php echo 'Dr.'.$row[ 'name' ] ?></h5>
        </div>
        <ul class='list-group list-group-flush'>

            <li class='list-group-item'>Specialty:<?php echo $row[ 'specialties' ] ?></li>
            <li class='list-group-item'>Degree: <?php echo $row[ 'name_pref' ] ?></li>
            <li class='list-group-item'>Phone No: <?php echo $row[ 'phone' ] ?></li>
            <li class='list-group-item'>Email: <?php echo $row[ 'email' ] ?></li>
        </ul>
        <?php
endwhile;

?>
    </div>
</div>