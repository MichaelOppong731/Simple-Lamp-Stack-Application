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
			  <a href="#" class="active">Insert Doctor</a>
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


    <header>
        <h1>
            Add New doctor
        </h1>
    </header>
    <main>
        <div class="FlatParagraph">

            <form action="resultsadddoctor.php" method="post">
                Liscense number: <input type="text" name="licensenum"><br>
                First Name: <input type="text" name="firstname"><br>
                Last Name: <input type="text" name="lastname"><br>
                License Date: <input type="date" name="licensedate"><br>
				Birthdate: <input type="date" name="birthdate"><br>
				Hospital: <input type="text" name="hosworksat"><br>
				Specialty: <input type="text" name="speciality"><br>

                <br><input type="submit" value="Add new doctor">
            </form>
        </div>
    </main>


    
   

</body>
</html>
