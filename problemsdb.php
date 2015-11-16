<?php
	include 'includes/header.php';
?>

            <div class="right">
                
				<form method="post" id="problems">
					<table>
						<tr>
							<td><h2>Add a problem and description on how to fix it</h2></td>
						</tr>
						<tr>
							<td>Name of the infection/problem: </td>
							<td><input type="text" name="problem"></td>
						</tr>
						<tr>
							<td>OS of the infected PC: </td>
							<td><input type="text" name="os"></td>
						</tr>
						<tr>
							<td>Symptoms: </td>
							<td><textarea name="symptoms" rows="10" cols="60"></textarea></td>
						</tr>
						<tr>
							<td>Description: </td>
							<td><textarea name="description" rows="10" cols="60"></textarea></td>
						</tr>
						<tr>
							<td>Solution: </td>
							<td><textarea name="solution" rows="10" cols="60"></textarea></td>
						</tr>
						<tr>
							<td>Used tools or software: </td>
							<td><textarea name="usedtools" rows="10" cols="60"></textarea></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" name="submit" value="Submit"></td>
						</tr>
						
					</table>
				</form>
               
			   <?php
			   // Script to update(logic)
			   
			   if(isset($_POST['submit'])){
					$problem = mysql_prep($_POST['problem']);
					$os = mysql_prep($_POST['os']);
					$symptoms = mysql_prep($_POST['symptoms']);
					$description = mysql_prep($_POST['description']);
					$solution = mysql_prep($_POST['solution']);
					$tools = mysql_prep($_POST['usedtools']);
				   
					$query = "INSERT INTO problems (problem, os, symptoms, description, solution, tools, added_by) 
					VALUES ('$problem', '$os', '$symptoms', '$description', '$solution', '$tools', {$_SESSION['userid']})";
						  
					mysqli_query($link, $query) or die("Error updating problems DB!");
			   }
			   ?>
            </div>
        </div>
<?php
	include 'includes/footer.php';
?>     
        