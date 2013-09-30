<?php
	session_start();
	$childCount	=	$_POST['chldCnt'];
	unset($_SESSION['childObject'.$childCount]);
?>