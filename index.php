<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CS3319 Assignment 3</title>

	<link rel="stylesheet" href="styles/basestyle.css" >
	<link rel="stylesheet" href="styles/responsive-topnav-dropdown.css" >
</head>
<body>

    <?php include "connectdb.php"; ?>
	<nav class="topnav" id="myTopnav">
		<a href="#" class="active">Home</a>
		<div class="dropdown">
			<button class="dropbtn"> Doctors
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="doctors/viewdoctorinfo.php">View Doctor Info</a>
			  <a href="doctors/viewbyspecialties.php">View by Specialties</a>
			  <a href="doctors/insertdoctor.php">Insert Doctor</a>
			  <a href="doctors/deletedoctor.php">Delete Doctor</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn"> Patients
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="patients/assigntopatient.php">Assign Doctor to Patient</a>
			  <a href="patients/viewpatientsbydoctor.php">View Patients by Doctor</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn"> Hospitals
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="hospitals/viewhospitalinfo.php">View Hospital Info</a>
			  <a href="hospitals/updatenumberbeds.php">Update No. Beds</a>
			</div>
		</div>
	</nav>

	<br>
	<p>
		All eight tasks are excutable using pages that can be accessed from the navigation bar above in order. Feel free to reference the tables below to see which page contains which actions. 
	</p>

	<br>
	<br>

	<h2>Doctors Page</h2>
	
	<table border ="1" cellspacing="0" cellpadding="10">
		<tr>
			<th>Page</th> <th>Contents</th>
		</tr>
		<tr>
			<td>View Doctor Info</td>
			<td>Lists all the information about the doctors</td>
		</tr>
		<tr>
			<td>View by Specialties</td>
			<td>Given a selected specialty, lists information of all doctors</td>
		</tr>
		<tr>
			<td>Insert Doctor</td>
			<td>Insert a new doctor</td>
		</tr>
		<tr>
			<td>Delete Doctor</td>
			<td>Delete an existing doctor</td>
		</tr>
	</table>

	<br>
	<h2>Patients Page (fill in)</h2>
	
	<table border ="1" cellspacing="0" cellpadding="10">
		<tr>
			<th>Page</th> <th>Contents</th>
		</tr>
		<tr>
			<td>View Doctor Info</td>
			<td>Lists all the information about the doctors</td>
		</tr>
		<tr>
			<td>View by Specialties</td>
			<td>Given a selected specialty, lists information of all doctors</td>
		</tr>
	</table>

	<br>
	<h2>Hospitals Page (fill in)</h2>
	
	<table border ="1" cellspacing="0" cellpadding="10">
		<tr>
			<th>Page</th> <th>Contents</th>
		</tr>
		<tr>
			<td>View Doctor Info</td>
			<td>Lists all the information about the doctors</td>
		</tr>
		<tr>
			<td>View by Specialties</td>
			<td>Given a selected specialty, lists information of all doctors</td>
		</tr>
	</table>

	

	

</body>
</html>
