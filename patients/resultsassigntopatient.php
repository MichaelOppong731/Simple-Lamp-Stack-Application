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
			  <a href="assigntopatient.php">Assign Doctor to Patient</a>
			  <a href="viewpatientsbydoctor.php">View Patients by Doctor</a>
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

    <h1>Assign Patient to Doctor</h1>

    <?php
        $ohipnum= $_POST["ohipnum"];
        $licensenum= $_POST["licensenum"];

        // Insert into looksafter table
        $query = 'INSERT INTO looksafter values("' . $licensenum . '", "' . $ohipnum . '");';
        if (!mysqli_query($connection, $query)) {
                die("Doctor already assigned to patient please try again. <br>" . mysqli_error($connection));

          
            }
        
        // Get doctor's name
        $query = 'SELECT firstname, lastname FROM doctor WHERE licensenum = "' .  $licensenum . '";';
        if (!mysqli_query($connection, $query)) {
                die("Doctor already assigned to patient please try again. <br>" . mysqli_error($connection));
            }
            $result=mysqli_query($connection,$query); 
            $data = mysqli_fetch_assoc($result);

            echo "Displaying patients of ";
            echo $data['firstname']; 
            echo " ";
            echo $data['lastname'];
            echo ":";


        // Display all patients cared for by doctor 
        $query = 'SELECT patient.firstname, patient.lastname FROM patient, looksafter WHERE patient.ohipnum = looksafter.ohipnum AND looksafter.licensenum = "' .  $licensenum . '";';
                $result=mysqli_query($connection,$query); 
    ?>

    <table border ="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>

    <?php
        if (mysqli_num_rows($result) > 0) {
            $sn=1;
            while($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $data['firstname']; ?> </td>
                <td><?php echo $data['lastname']; ?> </td>
            <?php
            $sn++;}
        } else { ?>
            <tr>
            <td colspan="8">No data found</td>
            </tr>
        <?php } ?>
    </table>
    

    <?php mysqli_close($connection); ?>

</body>
</html>
