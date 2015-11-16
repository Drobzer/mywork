<?php
	include 'includes/header.php';
	
	$query = "SELECT * FROM users";
	$result = mysqli_query($link, $query) or die("Can not query users!");
	
?>


            <div class="right">
               
				<h2>Users</h2>
				
				<table id="users">
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Admin</th>
						<th colspan="4">Update</th>
					</tr>
					<?php
						$i = 2;
						while($user = mysqli_fetch_array($result)){
							if($i%2 == 0){
								echo "<tr class=\"first\">";
							}else{
								echo "<tr class=\"second\">";
							}
							echo "<td>".$user['id']."</td>";
							echo "<td>".$user['username']."</td>";
							
							if($user['adm'] == 1){
								echo "<td>Yes</td>";
							}else{
								echo "<td>No</td>";
							}
							echo "<td><a href=\"?usernameupd={$user['id']}\">Username</a></td>";
							echo "<td><a href=\"?passupd={$user['id']}\">Password</a></td>";
							echo "<td><a href=\"?adminupd={$user['id']}\">Admin</a></td>";
							echo "<td><a href=\"?delete={$user['id']}\">Delete</a></td>";
							
							// Update username new td
							if(isset($_GET['usernameupd'])){
								if($_GET['usernameupd'] == $user['id']){
									echo "<td><input type=\"text\" name=\"updusername\" placeholder=\"New Username\" ></td>";
									echo "<td><input type=\"submit\" name=\"submit\"></td>";
								}
							}
							
							// Update password new td
							if(isset($_GET['passupd'])){
								if($_GET['passupd'] == $user['id']){
									echo "<td><input type=\"password\" name=\"updpass\" placeholder=\"New Password\" ></td>";
									echo "<td><input type=\"submit\" name=\"submit\"></td>";
								}
							}
							
							echo "</tr>";
							$i++;
						}
					?>
				</table>
			</div>
		
		
    </div>
        
<?php
	include 'includes/footer.php';
?>    