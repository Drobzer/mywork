<?php
    session_start();
    include_once 'includes/connect.php';
    include_once 'includes/functions.php';
	
    if(!isset($_SESSION['login']) && $_SESSION['login'] != TRUE){
		header("Location: loginreg.php");
        exit;
	}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>CP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style/style.css" media="all" rel="stylesheet" type="text/css">
		<link href="style/boxes.css" media="all" rel="stylesheet" type="text/css">	
    </head>
    <body onload="apply_settings(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}?>)">
       
        <div class="head">
            <h1>Welcome <?php echo ucfirst($_SESSION['user']); ?></h1>
        </div>
        
        <div class="nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="schedule.php">Schedule a Remote</a></li>
                <li><a href="view.php">View Remotes</a></li>
                <li><a href="report.php">Report</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
		
		<div class="content">
            <div class="left">
                <ul>
					<li><a href="mystats.php">My stats</a></li>
					<li><a href="showallrem.php">Show All remotes</a></li>
					<li><a href="problemsdb.php">ADD to Problems DB</a></li>
					<li><a href="search.php">Search Problems DB</a></li>
					<?php
						if($_SESSION['adm'] ==1){
							echo "<li><a href=\"users.php\">Users DB</a></li>";
						}
					?>
				</ul>
            </div>