<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php';
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$mysqli->set_charset("utf8");