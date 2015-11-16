<?php
    session_start();
    include_once 'includes/connect.php';
    
    if(isset($_SESSION['login']) && $_SESSION['login'] == TRUE){
        header("Location: index.php");
        exit;
    }
    
    $login_errors = "";
    $register_errors = "";
    $success = "";
    
    if(isset($_POST['login'])){
        
        $user = urlencode(mysqli_real_escape_string($link, $_POST['user']));
        $pass = urlencode(mysqli_real_escape_string($link, $_POST['passlogin']));
        $pass = md5($pass);
        
        $query = "SELECT * FROM users WHERE username = '{$user}'";
        
        $result = mysqli_query($link, $query);
        
        if(mysqli_num_rows($result) != 0){
            while($check = mysqli_fetch_array($result)){
                if($check['password'] == $pass){
                    $_SESSION['login'] = TRUE;
                    $_SESSION['user'] = $user;
                    $_SESSION['userid'] = $check['id'];
					$_SESSION['adm'] = $check['adm'];
					$_SESSION['pass'] = $check['password'];
					$_SESSION['currentdate'] = date("Y-m-d");
                    header("Location: index.php");
                    exit;
                }else{
                    $login_errors = "Wrong PASSWORD!";
                }
            }
        }else{
            $login_errors = "USER: <b>{$user}</b> NOT FOUND!";
        }
    }elseif(isset($_POST['register'])){
        
        $userreg = urlencode(stripslashes($_POST['userreg']));
		$passreg = urlencode(stripslashes($_POST['passreg']));
        
        $query = "SELECT * FROM users WHERE username='{$userreg}'";
		$result = mysqli_query($link, $query);
		
	if(mysqli_num_rows($result) != 0){
            $register_errors = "This username is in use!";
	}else{
            if(isset($userreg) && !empty($userreg) && isset($passreg) && !empty($passreg) ){
            
                $passreg = md5($passreg);

                $query = "INSERT INTO users(username, password, adm) 
                VALUES('{$userreg}', '{$passreg}', 0)";

                $result = mysqli_query($link, $query);

                if(mysqli_affected_rows($link) == 0 ){
                        $register_errors = "Error registering user!";
                }else{
                        $success = "User ". $userreg ." Registered Successfully!";
                }
				
            }else{
                $register_errors = "Empty field!";
            }
        }
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
        <title>Login/Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style/table.css" media="all" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="tables-loginreg">
            
            <div id="login">
                <form name="loginform" method="post" onsubmit="chkempty()">
                    <table>
                        <tr>
                            <th><h3>Login</h3></th>
                        </tr>
                        <tr>
                            <td class="box" >Username: </td>
                            <td ><input type="text" name="user" placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td class="box">Password: </td>
                            <td><input type="password" name="passlogin" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input id="loginbtn" type="submit" name="login" value="Login"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="errors"><?php echo $login_errors; ?></div></td>
                        </tr>
                        
                    </table>
                </form>
            </div>
            
            <div id="register">
                <form method="post" name="regform" onsubmit="chkempty2()">
                    <table>
                        <tr>
                            <th><h3>Register</h3></th>
                        </tr>
                        <tr>
                            <td class="box">Username: </td>
                            <td><input type="text" name="userreg" placeholder="Username"></td>
                        </tr>
                        <tr>
                            <td class="box">Password: </td>
                            <td><input type="password" name="passreg" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td class="box" >Confirm Password: </td>
                            <td ><input type="password" name="confpass" placeholder="********"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="register" value="Register"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="errors"><?php echo $register_errors; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div class="success"><?php echo $success; ?></div></td>
                        </tr>
                    </table>
                </form>
            </div>
            
        </div>
            
            <script>
            
                function chkempty(){
                    
                    var x = document.forms["loginform"]["user"].value;
                    var y = document.forms["loginform"]["passlogin"].value;
                    if(x == null || x == ""){
                        alert("Empty user field!");
                        return false;
                    }else if(y == null || y == ""){
                        alert("Password field Empty!");
                        return false;
                    }
                }
                
                function chkempty2(){
                    
                    var x = document.forms["regform"]["userreg"].value;
                    var y = document.forms["regform"]["passreg"].value;
                    var z = document.forms["regform"]["confpass"].value;
                    if(x == null || x == ""){
                        alert("Empty user field!");
                        return false;
                    }else if(y == null || y == ""){
                        alert("Password field Empty!");
                        return false;
                    }else if(z == null || z == ""){
                        alert("You haven't confirmed the password!");
                        return false;
                    }else if(y != z){
                        alert("Password mismach! Please confirm your password!");
                        return false;
                    }
                }
            
                
            </script>
    </body>
</html>