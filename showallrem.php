<?php
	include 'includes/header.php';
?>
            <div class="right">
                	
				<?php

					$query = "SELECT * FROM remotes 
								WHERE user_id={$_SESSION['userid']}
								ORDER BY date DESC, bgtime DESC";
					$result = mysqli_query($link, $query);

				?>
				
				<h1><center>All remotes</center></h1>
				
					<div id="remotes">
					<table>
						
						<tr>
							
							<th>Email</th>
							<th>Date</th>
							<th>Time</th>
							<th>Zone</th>
							<th>BG Time</th>
							<th>Resolved</th>
							<th>Problem</th>
						</tr>
						
				<?php

					while($remotes = mysqli_fetch_array($result)){
						
						echo "<tr>";
						if($_SESSION['currentdate'] == $remotes["date"]){ 
							echo "<td style=\"background-color: orange\" >" . $remotes["email"]. "</td>"; 
						}else{
							echo "<td>" . $remotes["email"]. "</td>";
						}
						echo "<td>" . $remotes["date"]. "</td>";
						echo "<td>" . $remotes["time"]. "</td>";
						echo "<td>" . $remotes["zone"]. "</td>";
						echo "<td>" . $remotes["bgtime"]. "</td>";
					 
						//problem resolved yes or no --v
						if($remotes["done"]==0){
							echo "<td><div style=\"color: red\" >No</div></td>";
						}elseif($remotes["done"]==1){
							echo "<td><div style=\"color: green\" >Yes</div></td>";
						}else{
							echo "<td><div style=\"color: red\" >Rescheduled</div></td>";
						}
						//problem resolved yes or no --^
						
						echo "<td>" . $remotes["problem"]. "</td>";
						
					}
				?>
						
					</table>
					</div>
            </div>
        </div>
        
<?php
	include 'includes/footer.php';
?>  