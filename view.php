<?php
	include 'includes/header.php';
?>
            <div class="right">
				<div id="remotes">	
					<table>
						<tr>
							<h1><center>Remotes Table</center></h1>
						</tr>
						<tr>
							<th>Email</th>
							<th>Date</th>
							<th>Time</th>
							<th>Zone</th>
							<th>BG Time</th>
							<th>Resolved</th>
							<th>Problem</th>
							<th>Generate template</th>
							<th>Issue resolved?</th>
							<th>Reschedule</th>
						</tr>
					
					<?php
					
					$remotes_set = query_remotes_by_user_id($_SESSION['userid']);
					
					while($remotes = mysqli_fetch_array($remotes_set)){
							
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
		
						//Generate button function ---v
						echo "<td><center><form><input type=\"hidden\" name=\"id\" value=\"".$remotes["id"]."\" ></>";
						echo "<input type=\"submit\" value=\"Generate\" ></form></center>";
						echo "</td>";
						//Generate button function ---^
		
						//Remote resolved button function ---v
						echo "<td><center><form><input type=\"hidden\" name=\"finishid\" value=\"".$remotes["id"]."\" ></>";
						echo "<input type=\"hidden\" name=\"email\" value=\"".$remotes["email"]."\" ></>";
						echo "<input type=\"submit\" value=\"Yes\" ></form></center>";
						echo "</td>";
						//Remote resolved button function ---^
		
						echo "<td><center><form><input type=\"hidden\" name=\"reschedule\" value=\"".$remotes["id"]."\" ></>";
						echo "<input type=\"submit\" value=\"Yes\" ></form></center></td>";
						echo "</tr>";
					}
					?>
					</table>	
				</div>
				
				<div id="resolvedremotes">
				<table>
    
					<tr>
						<h1><center>RESOLVED</center></h1>
					</tr>
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
					$remotes_done_set = query_remotes_done_by_user_id($_SESSION['userid']);
					
					while($remotes2 = mysqli_fetch_array($remotes_done_set)){
						echo "<tr>";
						echo "<td>" . $remotes2["email"]. "</td>";
						echo "<td>" . $remotes2["date"]. "</td>";
						echo "<td>" . $remotes2["time"]. "</td>";
						echo "<td>" . $remotes2["zone"]. "</td>";
						echo "<td>" . $remotes2["bgtime"]. "</td>";
						
						//problem resolved yes or no --v
						if($remotes2["done"]==0){
							echo "<td><div style=\"color: red\" >No</div></td>";
						}elseif($remotes2["done"]==1){
							echo "<td><div style=\"color: green\" >Yes</div></td>";
						}else{
							echo "<td><div style=\"color: red\" >No</div></td>";
						}
						//problem resolved yes or no --^
						
						echo "<td>" . $remotes2["problem"]. "</td>";
						
						echo "</tr>";
					}
				?>
				</table>
				</div>
				
				<?php
					if(isset($_GET["id"])){
						?>
					<div class="scheduletable">
					<table>
						<tr><center><h1>Template</h1></center></tr>
						<tr><td>
					   <?php generate_remote_temp($_GET["id"]); ?>
						</td></tr>
						<tr><td><center><form action="view.php" ><input type="submit" name="clear" value="Close" ></center></td></tr></form>
					</table>  
					</div>
					<?php
					}

					if(isset($_GET["finishid"]) && isset($_GET["email"])){
						?>
						<table>
							<tr><center><h1>Remote Resolved!</h1></center></tr>
							<tr><center>
							<?php resolve_remote($_GET["finishid"], $_GET["email"]); ?>
							</center></tr>
						</table>
				<?php
					}

				?>
				
				<?php
					if(isset($_GET['reschedule'])){
						$res_result = query_all_remotes($_GET['reschedule']);
						$reschedule = mysqli_fetch_array($res_result);
				?>
				<div class="scheduletable" >
					<form id="rescheduleform">
					<table>
						<tr><center><h1>Remote Reschedule</h1></center></tr>
						<tr>
							<td>Email:</td>
							<td><?php echo $reschedule['email']; ?></td>
							<input type="hidden" name="res_id" value="<?php echo $reschedule['id']; ?>">
						</tr>
						<tr>
							<td>Date:</td>
							<td><input type="date" name="res_date" value="<?php echo $reschedule['date']; ?>" id="res_date" ></td>
						</tr>
						
						<tr>
							<td>Time:</td>
							<td><input type="time" name="res_time" value="<?php echo $reschedule['time']; ?>" id="res_time" ></td>
						</tr>
							
						<tr>
							<td>Time zone:</td>
							<td><input type="text" name="res_zone" value="<?php echo $reschedule['zone']; ?>" id="res_zone" ></td>
						</tr>
						
						<tr>
							<td>BG Time:</td>
							<td><input type="time" name="res_bgtime" value="<?php echo $reschedule['bgtime']; ?>" id="res_bgtime" ></td>
						</tr>
							
						<tr>
							<td>Problem:</td>
							<td><textarea cols="30" rows="10" name="res_problem" id="res_problem" form="rescheduleform"><?php echo $reschedule['problem']; ?></textarea></td>
						</tr>
							
						<tr>
							<td colspan="2" ><center><input type="submit" name="res_submit" value="Save" >
							<input type="submit" name="res_close" value="Close" ></center></td>
						</tr>
							
					</table>
					</form>
				</div>
				<?php
					}
				?>
				
				<?php
					if(isset($_GET['res_submit'])){
						$res_id = $_GET['res_id'];
						$res_date = mysql_prep($_GET['res_date']);
						$res_time = mysql_prep($_GET['res_time']);
						$res_zone = mysql_prep($_GET['res_zone']);
						$res_bgtime = mysql_prep($_GET['res_bgtime']);
						$res_problem = mysql_prep($_GET['res_problem']);
						
						update_res_remotes($res_id);
					
						if(mysqli_affected_rows($link) != 0){
							echo "<table id=\"reschedule_message\">
									<tr><td><h2><center>Rescheduled!</center></h2></td></tr>
								</table>";
									
									header("Refresh:2; view.php");
									exit;
						}else{
							echo "<table id=\"reschedule_error_message\">
									<tr><td><h2><center>Error!</center></h2></td></tr>
									</table>";
						}
						
					}
				?>
				
			</div>
        </div>
		
<?php
	include 'includes/footer.php';
?>   