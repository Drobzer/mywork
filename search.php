<?php
	include 'includes/header.php';
?>

            <div class="right">
                
				<form>
					<table>
						<tr>
							<td><h2>Search</h2></td>
						</tr>
						<tr>
							<td>Infaction/problem name:</td>
							<td><input type="test" name="problem"></td>
							<td>
								<select name="inf_problem">
									<option value="1">Full word or sentance</option>
									<option value="2">Like.. part of the content</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Operating System:</td>
							<td><input type="test" name="os"></td>
							<td>
								<select name="inf_os">
									<option value="1">Full word or sentance</option>
									<option value="2">Like.. part of the content</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Symptoms:</td>
							<td><input type="test" name="symptoms"></td>
							<td>
								<select name="inf_symptoms">
									<option value="1">Full word or sentance</option>
									<option value="2">Like.. part of the content</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>Solution:</td>
							<td><input type="test" name="solution"></td>
							<td>
								<select name="inf_solution">
									<option value="1">Full word or sentance</option>
									<option value="2">Like.. part of the content</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Tools used:</td>
							<td><input type="test" name="tools"></td>
							<td>
								<select name="inf_tools">
									<option value="1">Full word or sentance</option>
									<option value="2">Like.. part of the content</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><input type="submit" name="submit" value="Submit"></td>
						</tr>
					</table>
				</form>
               
			   <?php
					if(isset($_GET['submit'])){
							
							$query_arr = array("SELECT * FROM problems WHERE ");
							
							if(isset($_GET['problem']) && $_GET['problem'] != NULL){ 
								$problem = mysql_prep($_GET['problem']);  
								if(isset($_GET['inf_problem'])){
									if($_GET['inf_problem'] == 1){
										array_push($query_arr, "problem=" . "'".$problem."'"); 
									}else{
										array_push($query_arr, "problem LIKE '%".$problem."%'");
									}
								}
							}
							if(isset($_GET['os']) && $_GET['os'] != NULL){ 
								$os = mysql_prep($_GET['os']);
								if(isset($_GET['inf_os'])){
									if($_GET['inf_os'] == 1){
										array_push($query_arr, "os=" . "'".$os."'"); 
									}else{
										array_push($query_arr, "os LIKE '%".$os."%'");
									}
								}	
							}
							
							if(isset($_GET['symptoms']) && $_GET['symptoms'] != NULL){ 
								$symptoms = mysql_prep($_GET['symptoms']); 
								if(isset($_GET['inf_symptoms'])){
									if($_GET['inf_symptoms'] == 1){
										array_push($query_arr, "symptoms=" . "'".$symptoms."'");
									}else{
										array_push($query_arr, "symptoms LIKE '%".$symptoms."%'");
									}
								}	
							}
							if(isset($_GET['solution']) && $_GET['solution'] != NULL){ 
								$solution = mysql_prep($_GET['solution']); 
								if(isset($_GET['inf_solution'])){
									if($_GET['inf_solution'] == 1){
										array_push($query_arr, "solution=" . "'".$solution."'");
									}else{
										array_push($query_arr, "solution LIKE '%".$solution."%'");
									}
								}
							}
							if(isset($_GET['tools']) && $_GET['tools'] != NULL){ 
								$tools = mysql_prep($_GET['tools']); 
								if(isset($_GET['inf_tools'])){
									if($_GET['inf_tools'] == 1){
										array_push($query_arr, "tools=" . "'".$tools."'");
									}else{
										array_push($query_arr, "tools LIKE '%".$tools."%'");
									}
								}
							}
							
							array_push($query_arr, " and ");
							
							$size = count($query_arr);
							$query = '';
							
							for($i=0; $i < $size - 1; $i++){
								$query .= $query_arr[$i];
								if($i==0 || $i == $size-2){
									continue;
								}else{
									$query .= $query_arr[$size-1];
								}
							}
							
							$result = mysqli_query($link, $query) or die("Unable to make query to the server!");
							
							// Search results table section
							
								echo "<div id=\"prob_result\">";
								
							
							//-------------------------------
							
							while($result_set = mysqli_fetch_array($result)){
							
								echo "<table>";
								
								echo "<tr><th>Problem/Infection</th>";
								echo "<th>OS</th>";
								echo "<th>Symptoms</th>";
								echo "<th>Description</th>";
								echo "<th>Solution</th>";
								echo "<th>Tools</th></tr>";
								
								
								echo "<tr><td>".$result_set['problem'] . "</td>";
								echo "<td>".$result_set['os'] . "</td>";
								echo "<td>".$result_set['symptoms'] . "</td>";
								echo "<td>".$result_set['description'] . "</td>";
								echo "<td>".$result_set['solution'] . "</td>";
								echo "<td>".$result_set['tools'] . "</td></tr>";
								
								echo "</table>";
							}
							
								echo "</div>";
					}
			   ?>
			   
            </div>
        </div>
<?php
	include 'includes/footer.php';
?>     
        