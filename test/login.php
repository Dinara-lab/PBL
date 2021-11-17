<?php 

session_start();

	include("connections.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			// $query = "SELECT md5(concat(md5('$user_name'), '$password'))";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$hui = md5(md5($user_name) . $password);
			
			$user_name = trim($user_name);

			
			// $query = "INSERT INTO `admins` (login, password) values ('$user_name','$hui')";
			// $result = mysqli_query($con, $query);

			$query = "SELECT * FROM `admins` WHERE md5(login) = md5('$user_name') AND password = md5(concat(md5(login), '$password'))";
			$result = mysqli_query($con, $query);
			
			$user_data = mysqli_fetch_assoc($result);
			$num_of_rows = mysqli_num_rows($result);
			// echo gettype($num_of_rows);
			
			if($num_of_rows > 0){
				echo "Success!";
				print_r($num_of_rows);
				$_SESSION["name"] = $user_name;
				header("Location: http://localhost/test/index1.php");
				die();
			}
			else{
				echo "Posel Nahui";
			}

			//read from database
			// $query = "select * from admins where login = '$user_name' limit 1";
			// $result = mysqli_query($con, $query);

			// if($result)
			// {
			// 	if($result && mysqli_num_rows($result) > 0)
			// 	{

			// 		$user_data = mysqli_fetch_assoc($result);
					
			// 		if($user_data['password'] === $password)
			// 		{
            //             echo "Write password!";
			// 			// $_SESSION['user_id'] = $user_data['user_id'];
			// 			// header("Location: index.php");
			// 			 die;
			// 		}
			// 	}
			// }
			
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

    #text1{

        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: solid thin #aaa;
        width: 100%;
    }

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text1" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>