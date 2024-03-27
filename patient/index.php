<?php
include_once '../admin/config.php';
include_once 'header.php';
?>
<link rel='stylesheet' href='style.css'>
<div class='content '>
    <h4 style='font-style:italic;'>Welcome to our medical appointment system!
        We're excited to have you join us on your journey towards better health and well-being.
        How can we assist you today?

    </h4>
    <button type="button" class="btn btn-outline-danger btn-link"><a href="register.php">Register Now</a></button>
</div>
<hr>
<hr>

<!--------for doctor card----->
<div class='doctor-list'>
    <h4 style="text-align: center;"> Our Doctors</h4>
    <div id='carouselExampleInterval' class='carousel slide bg-light' data-bs-ride='carousel'>
        <div class='carousel-inner'>
            <div class='carousel-item active ' data-bs-interval='1000'>
                <div class='row row-cols-2 row-cols-md-3 p-5 g-2'>
                    <?php
$cats = dbConnect()->query( 'SELECT * FROM doctor ORDER BY RAND( id ) LIMIT 3' );

while ( $row = $cats->fetch_assoc() ):
?>
                    <div class='col'>
                        <div class='card h-100'>
                            <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' class='card-img-top image'
                                alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>Name:<b><?php echo $row[ 'name' ];
?><i>( <?php echo $row[ 'name_pref' ];
?> )</i></b></h5>
                                <p class='card-text'>Specialty:<b><?php echo $row[ 'specialties' ];
?></b></p>
                                <p class='card-text'>Contact:<b><?php echo $row[ 'phone' ];
?></b></p>
                                <p class='card-text'>Email:<b><?php echo $row[ 'email' ];
?></b></p>
                                <div class='row d-flex w-75'>
                                    <!-- Button trigger modal -->
                                    <p>

                                    </p>

                                    <!-- Modal -->
                                    <div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog'
                                        aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalCenterTitle'>Schedule</h5>
                                                    <button type='button' class='close' data-dismiss='modal'
                                                        aria-label='Close'>
                                                        <span aria-hidden='true'>&times;
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class='modal-body' id='scheduleDetails'>

                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary'
                                                        data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <a href = '#' class = 'btn btn-primary  ms-5'>Set Appointment</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
?>

                </div>
            </div>
        </div>
    </div>

    <!-------for specialties-------------->
    <div class='speciality'>
        <div class='speheader'>
            <h2>Our Speciality</h2>
            <h4>We Specialize In</h4>
        </div>
        <div class='spe-container'>
            <div class='row row-cols-1 row-cols-md-3 p-4 g-2'>
                <?php
$cats = dbConnect()->query( 'SELECT * FROM special ORDER BY RAND( id ) LIMIT 3' );
while ( $row = $cats->fetch_assoc() ):
?>
                <div class='col'>
                    <div class='card h-100'>
                        <img src='../admin/uploads/<?php echo $row[ 'img' ] ?>' class='card-img-top image' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'><?php echo $row[ 'name' ] ?></h5>
                            <p class='card-text'></p>
                        </div>
                    </div>
                </div>
                <?php endwhile;
?>
            </div>
        </div>
    </div>
    <hr>
    <?php include'footer.php'?>