<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">

<?php
    include_once "config.php";
	if(isset($_POST['login'])){
		$name=$_POST['name'];
		$password=$_POST['password'];

		if($name=='admin' && $password == 'admin123'){
			$_SESSION['admin_name']=$name;
			echo '<script> alert("Login Successful")</script>';
		header('Location:index.php');
		exit;
		}else{
			$error = "Invalid email or password.";
			echo '<script>alert( $error )</script>' ;
		}
	}
?>


<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 p-5 shadow rounded">
        <form method="post" action="">
            <div class="d-flex  justify-content-center  align-items-center flex-column">
                <i class="fa fa-heartbeat " class="w-25" style="font-size:3rem;color:aqua"> </i>
                <h1 class="display-4 fs-1   text-center"> ADMIN LOGIN</h1>
                <div class="mb-3"> <label class="form-label"> User name</label>
                    <input type="text" class="form-control" name="name">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="login"> LOGIN</button>

        </form>
    </div>
</body>

</html>