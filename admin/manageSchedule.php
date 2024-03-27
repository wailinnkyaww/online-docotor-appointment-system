<?php
include_once 'navber.php';
include_once 'sidebar.php';
include_once 'config.php';
$doct_id = $_GET[ 'id' ];
if ( isset( $_POST[ 'submit' ] ) ) {

    $days = $_POST[ 'days' ];
    $time_from = $_POST[ 'time_from' ];
    $time_to = $_POST[ 'time_to' ];
    $check = $_POST[ 'check' ];

    // Initialize array to store query results
    $save = array();

    // Loop through each day
    foreach ( $days as $k => $val ) {
        // Check if checkbox is checked
        if ( isset( $check[ $k ] ) ) {
            $data = " doct_id = '$doct_id' ";
            $data .= ", day = '$days[$k]' ";
            $data .= ", time_from = '$time_from[$k]' ";
            $data .= ", time_to = '$time_to[$k]' ";

            // Check if it's an update or insert
            if ($check[$k] < 0) {
                // Update existing record
                $sql = 'UPDATE schedule SET ' . $data . ' WHERE id = ' . $check[$k];
                header('Location:doctorlist.php');
            } else {                
                // Insert new record
                $sql = 'INSERT INTO schedule SET ' . $data;
                header('Location:doctorlist.php');
                
            }

            // Execute SQL query
            $result = dbConnect()->query($sql);
            // Store result in save array
            $save[] = $result;
        }
    }

    // Check if any query executed successfully
    if (!empty($save)) {
        return 1; // Success
    }
}
//model box
$qrys = dbConnect()->query( 'SELECT * FROM schedule where id = 18');
$c = $qrys->num_rows;
while( $row = $qrys->fetch_assoc() ) {
    $id[ $row[ 'day' ] ] = $row[ 'id' ];
    $from[ $row[ 'day' ] ] = date( 'H:i', strtotime( $row[ 'time_from' ] ) );
    $to[ $row[ 'day' ] ] = date( 'H:i', strtotime( $row[ 'time_to' ] ) );
}

?>

<style>
.main {
    margin: 5rem 20px 0px 280px;
}
</style>
<form method='post' action='' class='main'>
    <div class='card' id='exampleModalCenter'>
        <div class='card-header'>
            <h5 class='card-title' data-id='' data-name='' id='exampleModalLongTitle'><?php echo $_GET[ 'name' ]
?>'s Schedule</h5>
            </div>
            <div class = 'card-body'>
            <div class = 'col-lg-12'>
            <div class = 'row'>
            <div class = 'col-md-12'>
            <table class = 'table'>
            <thead>
            <tr>
            <th class = 'text-center'>#</th>
            <th class = 'text-center'>Day</th>
            <th class = 'text-center'>From</th>
            <th class = 'text-center'>To</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $days = array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' );
            for ( $i = 0 ; $i < 7; $i++ ):
            ?>
            <tr>
            <td class = ''>
            <input type = 'hidden' name = 'id' value = "<?php echo $_GET['id'] ?>">
            <input type = 'checkbox' name = "check[<?php echo $i ?>]"
            value = "<?php echo isset($id[$days[$i]]) ? $id[$days[$i]] : 0 ?>"
            <?php echo isset( $id[ $days[ $i ] ] ) ? 'checked' : '' ?>>

            </td>
            <td class = ''>
            <?php echo $days[ $i ] ?>
            <input type = 'hidden' name = "days[<?php echo $i ?>]"
            value = "<?php echo $days[$i] ?>">
            </td>
            <td class = 'text-center'>
            <input name = "time_from[<?php echo $i ?>]" type = 'time'
            value = "<?php echo isset($from[$days[$i]]) ? $from[$days[$i]] : '' ?>"

            class = 'form-control' id = ''>
            </td>
            <td class = 'text-center'><input name = "time_to[<?php echo $i ?>]" type = 'time'
            value = "<?php echo isset($to[$days[$i]]) ? $to[$days[$i]] : '' ?>"

            class = 'form-control' id = ''></td>
            </tr>
            <?php endfor;
            ?>
            </tbody>
            </table>
            </div>
            </div>
            </div>
            </div>
            <div class = 'card-footer'>
            <button type = 'button' class = 'btn btn-secondary' data-dismiss = 'modal'><a href = 'doctorlist.php'
            style = 'text-decoration: none; color:aliceblue'>Close</a></button>
            <button type = 'submit' class = 'btn btn-primary' name = 'submit' value = 'submit'>Save changes</button>
            </div>
            </div>
            </form>