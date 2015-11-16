<?php
	include 'includes/header.php';
?>
            <div class="right">
                
				<?php
					$query = "SELECT * FROM report WHERE user_id={$_SESSION['userid']}";
					
					$result = mysqli_query($link, $query) or die("ERROR with query reports");
					
					
				?>
				<h1><center>My Stats</center></h1>
				
				<div id="remotes">
				<table>
					<tr>
						<th>Date</th>
						<th>Voice Mails</th>
						<th>Calls</th>
						<th>Remotes</th>
						<th>Support logs</th>
						<th>Mails</th>
					</tr>
					
					<?php
					
						while($reports = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>". $reports['date']."</td>";
							
							if($reports['vmails'] == 1){
								echo "<td>Yes</td>";
							}else{
								echo "<td>No</td>";
							}
							echo "<td>". $reports['calls']."</td>";
							echo "<td>". $reports['remotes']."</td>";
							
							if($reports['sl'] == 1){
								echo "<td>Yes</td>";
							}else{
								echo "<td>No</td>";
							}
							
							if($reports['mails'] == 1){
								echo "<td>Yes</td>";
							}else{
								echo "<td>No</td>";
							}
							
							echo "</tr>";
						}
					
					?>
					
					<?php
						//display total calls and remotes for user
						$query = "SELECT SUM(report.calls) AS calls, SUM(report.remotes) AS remotes 
									FROM report WHERE user_id={$_SESSION['userid']}";
									
						$result = mysqli_query($link, $query) or die("Error in the total generation!");
						
						$total = mysqli_fetch_array($result);
						
					?>
					<tr>
						<th>Total</th>
						<th>-</th>
						<th><?php echo $total['calls'];?></th>
						<th><?php echo $total['remotes'];?></th>
						<th>-</th>
						<th>-</th>
					</tr>
				</table>
				</div>
				
            </div>
        </div>
        
<?php
	include 'includes/footer.php';
?>    