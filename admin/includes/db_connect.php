<?php
include_once ('psl-config.php');
include_once 'functions.php';
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$mysqli->set_charset("utf8");