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
			  <a href="../doctors/viewdoctorinfo.php">View Doctor Info</a>
			  <a href="../doctors/viewbyspecialties.php">View by Specialties</a>
			  <a href="../doctors/insertdoctor.php">Insert Doctor</a>
			  <a href="../doctors/deletedoctor.php">Delete Doctor</a>
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
			  <a href="viewhospitalinfo.php">View Hospital Info</a>
			  <a href="#" class="active">Update No. Beds</a>
			</div>
		</div>
	</nav>

    <header>
        <h1>
            Update number of beds
        </h1>
    </header>
    <main>
        <div class="FlatParagraph">

            <form action="resultsupdatenumberbeds.php" method="post" enctype="multipart/form-data">
				Select Hospital: <br>
				<?php include '../lists/hospitallist.php'; ?> <br>
                New number of Beds: <input type="text" name="numofbed"><br>
               

                <br><input type="submit" value="Make Modifications">
            </form>
        </div>
    </main>

    
    

</body>
</html>
