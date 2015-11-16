<?php
	include 'includes/header.php';
?>
            <div class="right">
               
				<h2>Settings</h2>
	<!--			
				<form>
					<table>
						<tr>
							<td>Background color</td>
							<td><input type="color" name="color" <?php //if(isset($_COOKIE['cpen_bkgcolor'])){ echo "value =\"{$_COOKIE['cpen_bkgcolor']}\"";} ?>></td>
						</tr>
						
						<tr>
							<td><input type="submit" name="submit" value="Submit" ></td>
						</tr>
					</table>
				</form>
	-->			
        
        <a href="?color=red"><div id="red" onmouseover="previewred()" onmouseout="restore(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}else{ echo "'". "#E6E9EB"."'";}?>)">
            
            </div></a>
        
        <a href="?color=black"><div id="black" onmouseover="previewblack()" onmouseout="restore(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}else{ echo "'". "#E6E9EB"."'";}?>)">
            
            </div></a>
        
        <a href="?color=green"><div id="green" onmouseover="previewgreen()" onmouseout="restore(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}else{ echo "'". "#E6E9EB"."'";}?>)">
            
            </div></a>
        
        <a href="?color=orange"><div id="orange" onmouseover="previeworange()" onmouseout="restore(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}else{ echo "'". "#E6E9EB"."'";}?>)">
            
            </div></a>
        
        <a href="?color=blue"><div id="blue" onmouseover="previewblue()" onmouseout="restore(<?php if(isset($_COOKIE['cpen_bkgcolor'])){echo "'".$_COOKIE['cpen_bkgcolor']."'";}else{ echo "'". "#E6E9EB"."'";}?>)">
            
            </div></a>
        
        
			</div>
		
		<?php
			if(isset($_GET['color'])){
				setcookie('cpen_bkgcolor', $_GET['color'],time() + (10 * 365 * 24 * 60 * 60) , "/");
				header("refresh:1, home.php");
				exit;
			}
		?>
    </div>
       
<?php
	include 'includes/footer.php';
?>    