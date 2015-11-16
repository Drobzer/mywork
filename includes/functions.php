<?php

function mysql_prep($value){
    global $link;
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysqli_real_escape_string");
    
    if($new_enough_php){
        if($magic_quotes_active){
            $value = stripslashes($value);
        }
        $value = mysqli_real_escape_string($link, $value);
    }else{
        if(!$magic_quotes_active){
            $value = addslashes($value);
        }
    }
    return $value;
}

function confirm_query($result_set){
    global $link;
    if(!$result_set){
        die("Query failed: " . mysqli_error($connection));
    }
}

function generate_remote_temp($id){
    global $link;
                
    $query = "SELECT * FROM remotes WHERE id={$id}";
    $result =  mysqli_query($link, $query);
    $ses_row =  mysqli_fetch_array($result);


    echo "<p>The remote session is scheduled for ";
    echo date("l", strtotime($ses_row["date"]));
    echo " ".date("d", strtotime($ses_row["date"]));

    if(date("d", strtotime($ses_row["date"]))== 1 
            || date("d", strtotime($ses_row["date"]))== 21 
            || date("d", strtotime($ses_row["date"])) == 31){

        echo "st";

    }elseif (date("d", strtotime($ses_row["date"]))== 2 
            || date("d", strtotime($ses_row["date"]))== 22) {

        echo "nd";
    }elseif (date("d", strtotime($ses_row["date"]))== 3 
            || date("d", strtotime($ses_row["date"]))== 23) {

        echo "rd";
    }else{
       echo "th"; 
    }

    echo " of ".date("F", strtotime($ses_row["date"]))." ".date("Y",strtotime($ses_row["date"]));
    echo " at ".$ses_row["time"]. " ".$ses_row["zone"];


    echo "<p>We need our remote support tool to be left opened and running at least 30 min before our scheduled time and to be provided with the ID and the Password from it.</p>";

    echo "<p>Note that every time you open the tool, it should change its password.</p>";

}

function resolve_remote($finid, $email){
    
    global $link;
    
    $query="update remotes set done=1 where id={$finid}";
    mysqli_query($link, $query);

    if(mysqli_affected_rows($link)!=0){
        echo "Done!!! Remote session for ". $email . " has been set to Resolved!";
        
        header("refresh:2; view.php");
    }
}

function query_remotes_by_user_id($id=0){
	global $link;
	$query = "SELECT * FROM remotes 
			WHERE done=0 AND user_id={$id}
			UNION
			SELECT * FROM remotes 
			WHERE done=3 AND user_id={$id}
			ORDER BY date, bgtime asc limit 10";
			
	$result = mysqli_query($link, $query);
	return $result;
}

function query_remotes_done_by_user_id($id=0){
	global $link;
	$query = "SELECT * FROM remotes WHERE done=1 and user_id={$id} ORDER BY date DESC, bgtime DESC LIMIT 5";
	$result = mysqli_query($link, $query);
	return $result;
}

function query_all_remotes($id=0){
	global $link;
	$query = "SELECT * FROM remotes WHERE id={$id}";
	$result = mysqli_query($link, $query);
	return $result;
}

function update_res_remotes($id=0){
	global $link;
	global $res_date;
	global $res_time;
	global $res_zone;
	global $res_bgtime;
	global $res_problem;
	
	$query = "UPDATE remotes
				SET date='{$res_date}',
				time='{$res_time}',
				zone='{$res_zone}',
				bgtime='{$res_bgtime}',
				done=3,
				problem='{$res_problem}'
				WHERE id='{$id}'";
									
	$upd = mysqli_query($link, $query);
}

function get_user_for_report_by_id($id=0){
	global $link;
	$query = "SELECT * FROM report WHERE user_id={$id}";
    $result = mysqli_query($link, $query);
	return $result;
}

function get_user_for_report_by_id_and_date($id=0){
	global $link;
	$currdate = date("Y-m-d");
	
	$query = "SELECT * FROM report WHERE user_id={$id} AND date='{$currdate}'";
    $result = mysqli_query($link, $query);
	return $result;
}

function upd_reports($userid=0){
	global $link;
	
	$today = date("Y-m-d");
	$currtime = date("H:i:s", time());
				
    $query = "INSERT INTO report (user_id, vmails, calls, remotes, sl, mails, date, time) 
				VALUES ($userid, 0, 0, 0, 0, 0, '$today', '$currtime')";
                            
    mysqli_query($link, $query) or die("Report update failed!");
}
?>

