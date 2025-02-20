<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CS3319 Assignment 3</title>

	<link rel="stylesheet" href="../styles/basestyle.css" >
	<link rel="stylesheet" href="../styles/responsive-topnav-dropdown.css" >
</head>
<body>

    <?php include "../connectdb.php"; ?>
	<nav class="topnav" id="myTopnav">
		<a href="../index.php">Home</a>
		<div class="dropdown">
			<button class="dropbtn"> Doctors
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="#" class="active">View Doctor Info</a>
			  <a href="viewbyspecialties.php">View by Specialties</a>
			  <a href="insertdoctor.php">Insert Doctor</a>
			  <a href="deletedoctor.php">Delete Doctor</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn"> Patients
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="../patients/assigntopatient.php">Assign Doctor to Patient</a>
			  <a href="../patients/viewpatientsbydoctor.php">View Patients by Doctor</a>
			</div>
		</div>
		<div class="dropdown">
			<button class="dropbtn"> Hospitals
			  <em class="fa fa-caret-down"></em>
			</button>
			<div class="dropdown-content">
			  <a href="../hospitals/viewhospitalinfo.php">View Hospital Info</a>
			  <a href="../hospitals/updatenumberbeds.php">Update No. Beds</a>
			</div>
		</div>
	</nav>


	<h2>View doctors</h2>

    <form action="resultsviewdoctorinfo.php" method="post" enctype="multipart/form-data">
            Select Field to Order By: <br>
			<input type = "radio" name = "field" value = "1">Last Name<br>
			<input type = "radio" name = "field" value = "3">Birthdate<br>
			<br>
			Select Method of Ordering: <br>
			<input type = "radio" name = "order" value = "1">Ascending<br>
			<input type = "radio" name = "order" value = "3">Descending<br>
		<br><input type="submit" value="View Doctors">
	</form>

</body>
</html>
