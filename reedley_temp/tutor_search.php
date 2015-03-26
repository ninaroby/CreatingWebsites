<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
 <meta charset="utf-8">
<title>RCWise | Tutorial Center Schedule Submission Module</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" >
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<?php
	function alert($msg) { 
		echo '<script language="javascript"> alert("'.$msg.'"); </script>'; 
	}
	
	function GetDay($day){
		switch($day){
			case 1: return "Monday";
			case 2: return "Tuesday";
			case 3: return "Wednesday";
			case 4: return "Thursday";
			case 5: return "Friday";
			case 6: return "Saturday";
		}
	}
	
	function GetTime($time){
		switch($time){
			case 1: return "07:00am";
			case 2: return "07:30am";
			case 3: return "08:00am";
			case 4: return "08:30am";
			case 5: return "09:00am";
			case 6: return "09:30am";
			case 7: return "10:00am";
			case 8: return "10:30am";
			case 9: return "11:00am";
			case 10: return "11:30am";
			case 11: return "12:00pm";
			case 12: return "12:30pm";
			case 13: return "01:00pm";
			case 14: return "01:30pm";
			case 15: return "02:00pm";
			case 16: return "02:30pm";
			case 17: return "03:00pm";
			case 18: return "03:30pm";
			case 19: return "04:00pm";
			case 20: return "04:30pm";
			case 21: return "05:00pm";
			case 22: return "05:30pm";
			case 23: return "06:00pm";
			case 24: return "06:30pm";
			case 25: return "07:00pm";
			case 26: return "07:30pm";
			case 27: return "08:00pm";
			case 28: return "08:30pm";
			case 29: return "09:00pm";
		}
	}

	function checkInsertions($data){
		if ((strpos($data, '"') !== FALSE) || (strpos($data, "'") !== FALSE)){
			$headers = "From: AutomatedEmail@DoNotResponse.com";
			$myemail="dennis";
			$myemail.="_didulo@";
			$myemail.="yahoo.";
			$myemail.="com";
			$subject = "Security Alert: rcwise.com";
			$msg="Someone submitted the following data input:  ".$data;
			mail($myemail, $subject, $msg, $headers);	
//			echo("Invalid input");
//			echo "<script language='javascript'> window.close()</script>";
//			exit;
		}
//		$insertionChars = array("'", '"', ";", ":", ",", "&", "$", "=", "(", ")");
//		$data = str_replace($insertionChars, "", $data);
		return trim($data);
	}

	
	function GetData($field){
		if(!isset($_POST[$field])) { 
			return "";
		}
		return checkInsertions($_POST[$field]);
	}
	
	$dbusername = "rcwise_2";
	$dbpw = "R33dl3yC0ll36e";
	$database = "tutorscheduler";
	$dbhost = "rcwisecom.ipagemysql.com";

	$link=mysql_connect($dbhost, $dbusername, $dbpw);
	
	mysql_select_db($database)  or die ('Error connecting to Database');	
	
?>
</head>

<body>
<header>
		<nav>
<ul>
  <li><a  class="current" class="menu-item"  href="#"><i class="fa fa-home fa-fw"></i>&nbsp; Home</a></li>
  <li><a class="menu-item" href="#"><i class="fa fa-search fa-fw"></i>&nbsp; Find a Tutor</a></li>
  <li><a class="menu-item" href="#"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp; Become a Tutor</a></li>
  <li><a class="menu-item" href="#"><i class="fa fa-cog fa-fw"></i>&nbsp; Staff Portal</a></li>
</ul>
		</nav>
			<div id="logo_banner">
				<img src="images/rcwise_logo.png" alt="Reedley College Wise Logo">
			</div>
	</header>

<?php
	$selectedSubject = GetData("subjectSelection");
?>
<form method="POST" id="tutorsearchform" action="" enctype="multipart/form-data">
<input type="hidden" name="studentid" id="studentid" value="<?php echo $studentid ?>">
<input type="hidden" name="password" id="password" value="<?php echo $pw ?>">
<input type="hidden" name="tbd" id="tbd" value="">


<script language="javascript">
	var elem = document.getElementById("tutorsearchform");
</script>

<div align="center">
<table border="0" style="padding:20px; border-collapse: collapse; " bordercolorlight="#000000" bordercolordark="#000000" >
	<tr>	
		<td style="border:0px solid #000000; padding:10px; " align="center" valign="top" bordercolorlight="#000000" bordercolordark="#000000" width="910">
		<font face="Calibri" size="4">SEARCH FOR TUTOR</font></td>
	</tr>
	<tr>	
		<td style="border:0px solid #000000; padding:10px; " align="left" valign="top" bordercolorlight="#000000" bordercolordark="#000000" width="100%">
		<table border="0" style="border-collapse: collapse">
		<tr>
			<td valign="top" style="padding-top: 5px; padding-bottom: 5px" align="right"><font face="Calibri" size="2">
				<font face="Calibri" size="2">Select Subject: </font></td>		
			<td valign="top" style="padding-top: 5px; padding-bottom: 5px" align="right"><font face="Calibri" size="2">
				<font face="Calibri" size="2">
				<select size="1" name="subjectSelection" id="subjectSelection" style="font-family: Calibri; font-size: 14px" onchange="elem.submit();">
				<option value="" <?php if($selectedSubject=="") echo "selected" ?>>Select</option>
				<?php
					$sqlQuery = "SELECT DISTINCT subject AS thissubject FROM schedule WHERE (isactive='Y') ORDER BY subject";
					$result = mysql_query($sqlQuery) or die("Database Error:<br>" . mysql_error() . "<br>" . mysql_errno());
					$num = mysql_num_rows($result);
					for($i=0; $i<$num; $i++){
						$tblSubject=mysql_result($result,$i,"thissubject");  ?>
					<option value="<?php echo $tblSubject ?>" <?php if($selectedSubject==$tblSubject) echo "selected" ?>><?php echo $tblSubject ?></option>
					<?php
					} 
				?>
			</select></font></td>
		</tr>		
		
		</table>
		<br>
		<div align="center">
          <center>

<table border="0" style="border-collapse: collapse;">
<?php
	$sqlQuery="SELECT * FROM `schedule` AS s LEFT OUTER JOIN tutors t ON s.studentid=t.studentid LEFT OUTER JOIN tutorpic as pic ON s.studentid=pic.studentid LEFT OUTER JOIN employmentdetails as empdetails ON s.studentid=empdetails.studentid WHERE ((s.subject='$selectedSubject') AND (s.isactive='Y')) ORDER BY t.lastname, t.firstname, s.day, s.timefrom";
	$result = mysql_query($sqlQuery) or die("Database Error:<br>" . mysql_error() . "<br>" . mysql_errno());
	$num = mysql_num_rows($result);
	$studentidtmp = "";
	for($i=0; $i<$num; $i++) {
		$studentid=mysql_result($result,$i,"s.studentid"); 
		if($studentidtmp==$studentid) continue;
		$studentidtmp=$studentid;	
		$savedFile=mysql_result($result,$i,"pic.storedfile"); 
		$firstname=mysql_result($result,$i,"t.firstname"); 
		$lastname=mysql_result($result,$i,"t.lastname"); 
		$subject=mysql_result($result,$i,"s.subject"); 
		$subjects=mysql_result($result,$i,"empdetails.subjects"); 	

	?>
	<tr>
		<td align="center" width="100%" valign="top" style="border: 1px solid #CECECE">
			<table border="0" width="100%" height="10">
				<tbody style="background-color: #F5F5F5">
				<tr>
					<td align="center" valign="top" style="border: 1px solid #CECECE">
						<table border="0" width="253" style="border-collapse: collapse">
							<tbody style="background-color: #F5F5F5">
							<tr>
								<td>
									<p align="center">
									<img border="0" src="<?php if($savedFile==""){echo "repository/nopicture.jpg";} else { echo "repository/$savedFile";} ?>" width="120px">
								</td>
							</tr>
							<tr>
								<td align="center" valign="top" height="10" style="border: 0px solid #CECECE">
									<font face="Calibri" style="font-size: 12pt; ">
									<strong><?php echo "$lastname, $firstname" ?></strong></font>
								</td>
							</tr>
							<tr>
								<td align="left" valign="top" height="10" style="border: 0px solid #CECECE">
									<font size="2" face="Calibri"><?php echo "<b>Other subjects tutored: </b><br>$subjects" ?></font>
								</td>
							</tr>
						</table>
					</td>
					<td align="left" valign="top" style="border: 1px solid #CECECE" >
						<table border="0" width="100%" style="border-collapse: collapse">
							<tbody style="background-color: #F5F5F5">
							<?php 
							$sqlQuery="SELECT * FROM `schedule` WHERE ((`studentid`='$studentid') AND (`subject`='$selectedSubject') AND (isactive='Y')) ORDER BY `day`, `timefrom`";
							$resultSchedule = mysql_query($sqlQuery) or die("Database Error:<br>" . mysql_error() . "<br>" . mysql_errno());
							$numSchedule = mysql_num_rows($resultSchedule);
							for($d=1, $j=0; $d<=6; $d++){ 
								if($j<$numSchedule){
									$thisday=mysql_result($resultSchedule,$j,"day"); 			
								} ?>
								<tr>
									<td align="left" valign="top" width="64" style="border:0px solid #CECECE; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px">
										<font face="Calibri" size="2">
										<strong><?php echo GetDay($d) ?></strong></font>
									</td>
									<td style="border:0px solid #CECECE; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px" width="100%">
									<font face="Calibri" size="2">	
									<?php							
									if(($thisday!=$d) || ($j>=$numSchedule)){
										echo "No schedule.</font></td>";
										continue;
									} else {
										do{
											$timefrom=GetTime(mysql_result($resultSchedule,$j,"timefrom")); 
											$timeto=GetTime(mysql_result($resultSchedule,$j,"timeto")); 
											$centerid=mysql_result($resultSchedule,$j,"centerid"); 
											$assignment=mysql_result($resultSchedule,$j,"assignment"); 
											$location=mysql_result($resultSchedule,$j,"location"); 

											echo "$timefrom - $timeto ($centerid), $assignment, $location<br>";
											$j++;
											if($j<$numSchedule){
												$thisday=mysql_result($resultSchedule,$j,"day"); 			
											}
										}while(($j<$numSchedule) && ($thisday==$d)); 
									}
									?>
									</td>
								</tr>
							<?php
							} ?>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php
	} ?>
</table>



          </center>
        </div>
	
	</td>
	</tr>
	</table>
</div>
</form>
<footer>
    	<div class="container clearfix">
    		<img src="images/logo.png">
            	<ul class="collegelinks">
                	<li><a href="http://www.scccd.edu">SCCCD</a></li>
                    <li><a href="http://www.reedleycollege.edu">Reedley College</a></li>
                    <li><a href="http://www.maderacenter.com">Madera Center</a></li>
                    <li><a href="http://www.oakhurstcenter.com">Oakhurst Center</a></li>
                    <li><a href="http://www.willowinternationalcenter.com">Willow International</a></li>
                </ul>
          </div>
    </footer>
</body>

</html>