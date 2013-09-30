<?php	
	include('../library/dbcon.php');
	session_start();
	$_SESSION['u']=isset($_POST['txtuser']);
	$_SESSION['p'] = isset($_POST['txtpass']);
	
	
	/* Session Start for Admin */
	function sessionStart($user,$pass){
		$pswd = md5($pass);
		//echo $pswd;
		$query ="SELECT * FROM users WHERE username = '".$user."' AND password ='".$pswd."' AND u_type = 0 AND del_flag=0 ";
		echo $query;
		$row = mysql_query($query);
		if(mysql_num_rows($row)) { 
			$result = mysql_fetch_assoc($row);
			//session_start();
			$_SESSION['userName']=$user;
			$_SESSION['userPassw']=$pswd;
			//echo $_SESSION['userPassw'];
			$_SESSION['adminName'] = $result["name"];
			$_SESSION["userId"] = $result["id"];
			$_SESSION["session"] = $result["id"];
			$_SESSION["time"] = time();
			//echo $_SESSION["userId"] ;
			header("Location: admin_dashboard.php");
		}
		else { 
			$error= " <p style='color:#FF0000'>Admin Login Failed</p>";
			return $error;
		}
	
	}
	
	/* Session Check and Time out for Admin */
	function sessionCheck(){
		$q ="SELECT * FROM users WHERE  username = '".$_SESSION['userName']."' AND password ='".$_SESSION['userPassw']."' AND u_type = 0 AND del_flag=0 ";
		//echo $q;
		$rw = mysql_query($q);
		if(mysql_num_rows($rw)) {
			//session_start();
			$re = mysql_fetch_assoc($rw);
			$_SESSION["session"] = $re["id"];
			$_SESSION["adminId"] = $re["id"];
			$_SESSION['adminName']=$re["name"];
			
			//session_start();
			if( !isset($_SESSION["session"]) ) {
				header("location: admin_dashboard.php");
			}
		}
		if( !isset($_SESSION["session"]) ) {
				header("location: index.php");
			}
	}
	
	/* Logout*/
	function sessionDestroy(){
		global $SESSION;
		session_start();
		unset($_SESSION["session"]);
		unset($_SESSION['userId']);
		unset($_SESSION['time']);
		unset($_SESSION['u']);
		unset($_SESSION['p']);
		unset($_SESSION['t']);
		session_destroy();
		header("location: index.php");
	}
	
	