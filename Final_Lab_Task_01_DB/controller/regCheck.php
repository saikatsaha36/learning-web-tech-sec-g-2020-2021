<?php
	session_start();
	require_once('../model/userModel.php');

	if(isset($_POST['signup'])){

		$username = $_POST['username'];
		$password = $_POST['password'];
		$repass = $_POST['repass'];
		$email = $_POST['email'];

		if($username == "" || $password == "" || $email == ""){
			echo "null value found...";
		}else{
			if($password == $repass){

				$user = ['username'=> $username, 'password'=> $password, 'email'=>$email];

				$_SESSION['current_user'] = $user;

				    if(filesize('u../model/user.json')==0){
        $json=json_encode($user);
        $myfile=fopen('../model/user.json', 'w');
        fwrite($myfile, '['.$json.']');
    }
    else{
        $inp = file_get_contents('../model/user.json');
        $tempArray = json_decode($inp);
        array_push($tempArray, $user);
        $jsonData = json_encode($tempArray);
        file_put_contents('../model/user.json', $jsonData);
    }



				header('location: ../view/login.html');
			}else{
				echo "password & confirm password mismatch...";
			}
		}
	}


?>