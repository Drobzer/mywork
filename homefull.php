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
    <body>
       
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
			<div class="right">
               
				<h2>Settings</h2>
				<?php
					if(isset($_COOKIE['cpen_bkgcolor'])){
						echo $_COOKIE['cpen_bkgcolor'];
					}
				?>
				<form>
					<table>
						<tr>
							<td>Background color</td>
							<td><input type="color" name="color" <?php if(isset($_GET['color'])){ echo "value =\"{$_GET['color']}\"";} ?>></td>
						</tr>
						
						<tr>
							<td><input type="submit" name="submit" value="Submit" ></td>
						</tr>
					</table>
				</form>

				<button onclick="chgcol()">Change</button>
				
				<form name="bgcolorForm">Try it now: 
				<select onChange="if(this.selectedIndex!=0)
				document.body.style.backgroundColor=this.options[this.selectedIndex].value">
				<option value="choose">set background color    
				<option value="FFFFCC">light yellow
				<option value="CCFFFF">light blue
				<option value="CCFFCC">light green
				<option value="CCCCCC">gray
				<option value="FFFFFF">white
				</select></form>
			</div>
		
		<?php
			if(isset($_GET['submit'])){
				setcookie('cpen_bkgcolor', $_GET['color'],time() + (10 * 365 * 24 * 60 * 60) , "/");
			}
		?>
    </div>
			<div class="footer">
			<p>Drobecorp Illuminati</p>
		</div>
		<script>
			function chgcol(){
				document.body.style.backgroundColor = "black";
			}
		</script>
    </body>
</html>
