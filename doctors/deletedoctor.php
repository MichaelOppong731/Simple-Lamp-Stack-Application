<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CS3319 Assignment 3</title>

	<link rel="stylesheet" href="../styles/basestyle.css" >
	<link rel="stylesheet" href="../styles/responsive-topnav-dropdown.css" >
    <link rel="stylesheet" href="../styles/blocks.css" >
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
			  <a href="viewdoctorinfo.php">View Doctor Info</a>
			  <a href="viewbyspecialties.php">View by Specialties</a>
			  <a href="insertdoctor.php">Insert Doctor</a>
			  <a href="#" class="active">Delete Doctor</a>
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

    
    <header>
        <h1>
            Delete Doctor
        </h1>
    </header>
    <main>

	<!-- https://www.w3schools.com/jsref/met_win_confirm.asp -->
        <div class="FlatParagraph">
            <form action="resultsdeletedoctor.php" method="post" onsubmit="return confirm('Do you really want to delete this doctor')">
                Select Doctor to Delete: <br>
                
                <?php include '../lists/doctorlist.php'; ?>

                <br><input type="submit" value="Remove Doctor">
            </form>
        </div>
    </main>

</body>
</html>
