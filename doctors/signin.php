<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">

<?php 
include_once "../admin/config.php";
$db=dbConnect();
if(isset($_SESSION['doctor_email'])){
    header('Location:home.php');
    exit;
}
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $qry="SELECT * FROM doctor WHERE email='$email'";
    $result=mysqli_query($db,$qry);
    $row=$result->fetch_assoc();
    if($row['email'] == $email && $row['password'] == $password){
        $_SESSION['doctor_email'] = $email;
        echo '<script> alert("Login Successful")</script>';
        header('Location:home.php');
        exit;
    }else{
        $error = "Invalid email or password.";
    }
}
?>

<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 p-5 shadow rounded">
        <form method="post" action="">
            <div class="d-flex justify-content-center  align-items-center flex-column">
                <i class="fa fa-heartbeat " class="w-25" style="font-size:3rem;color:aqua"> </i>
                <h1 class="display-4 fs-1  text-center"> DOCTOR LOGIN</h1>
                <div class="mb-3">
                    <label class="form-label"> Doctor Email:</label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="login"> LOGIN</button>

        </form>
        <?php if(isset($error)) { ?>
        <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
</body>