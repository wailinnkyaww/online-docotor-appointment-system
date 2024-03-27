<?php
include_once 'navbar.php';
include_once 'sidebar.php';
include_once '../admin/config.php';
$db = dbConnect();

if ( !isset( $_SESSION[ 'doctor_email' ] ) ) {
    header( 'Location: signin.php' );
    exit;
}

$old_password = $new_password = $confirm_password = '';
$error = '';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {

    $old_password = $_POST[ 'oldpassword' ];
    $new_password = $_POST[ 'newpassword' ];
    $confirm_password = $_POST[ 'confirmpassword' ];

    $doctoremail = $_SESSION[ 'doctor_email' ];

    $qry = "SELECT * FROM doctor WHERE email='$doctoremail'";
    $result = mysqli_query( $db, $qry );
    while( $row = $result->fetch_assoc() ) {

        if ( $row[ 'password' ] != $old_password ) {
            $error = 'Old password is incorrect.';
        } elseif ( $new_password != $confirm_password ) {
            $error = 'Passwords do not match.';
        } else {

            $stmt = $db->prepare( 'UPDATE doctor SET password = ? WHERE email = ?' );
            $stmt->bind_param( 'ss', $new_password, $doctoremail );
            $stmt->execute();
            echo '<script>window.location.href="home.php";</script>';
            exit;

        }

    }
}
?>
<style>
.container {
    padding-left: 14rem !important;
    padding-top: 6rem;
}
</style>
<div class='container '>
    <h3>Update Password Form</h3><br>
    <?php if ( !empty( $error ) ) {
    ?>
    <p><?php echo $error;
    ?></p>
    <?php }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
        class='px-4 py-3 col-md-5 border border-success' method='post'>
        <div class='mb-3'>
            <label for='oldpassword' class='form-label'>Old Password</label>
            <input type='password' class='form-control' name='oldpassword'>
        </div>
        <div class='mb-3'>
            <label for='newpassword' class='form-label'>New Password</label>
            <input type='password' class='form-control' name='newpassword'>
        </div>
        <div class='mb-3'>
            <label for='oldpassword' class='form-label'>Confirm Password</label>
            <input type='password' class='form-control' name='confirmpassword'>
        </div>
        <button type='submit' class='btn btn-primary'>Update</button>
    </form>

</div>