<?php
include_once 'header.php';
include_once '../admin/config.php';
$db = dbConnect();
?>
<style>
.container-history {
    margin-top: 5rem !important;
    margin-bottom: 12rem;
}
</style>
<div class='container-history w-100 mt-4'>
    <div class='row'>
        <div class='col-md-3'>
            <img src='images/a4.jpg' class='rounded float-start' alt='...'>

        </div>
        <div class='col-md-6'>
            <table class='table table-success table-striped table-hover'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <!-- <th scope = 'col'>Date</th> -->
                        <th scope='col'>Doctor Name</th>
                        <th scope='col'>Day</th>
                        <th scope='col'>Time</th>
                        <th scope='col'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$some = getSession( 'pat_id' );

$num = 1;
$apps = mysqli_query( $db, "SELECT * FROM appointment  WHERE pat_id='$some'" );
while( $row = $apps->fetch_assoc() ):
?>
                    <tr>
                        <th scope='row'><?php echo $num++;
?></th>
                        <!-- <td> <?php
echo $row[ 'date' ] ? date( 'Y-m-d', strtotime( $row[ 'date' ] ) ): 'no';
?></td> -->
                        <td>Dr.<?php echo $row[ 'doct_name' ];
?></td>

                        <td><?php echo changeDay( $row[ 'date' ] );
?></td>
                        <td><?php echo changeTime( $row[ 'time' ] );
?></td>
                        <td><?php echo $row[ 'status' ] ?></td>
                    </tr>
                    <?php
endwhile;

?>
                </tbody>
            </table>
        </div>
        <div class='col-md-3'>
            <img src='images/a4.jpg' class='rounded float-end' alt='...'>

        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>