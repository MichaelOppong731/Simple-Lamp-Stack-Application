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
			  <a href="viewdoctorinfo.php">View Doctor Info</a>
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


	<h1>Adding New Lab Member:</h1>

        <?php
                $licensenum= $_POST["licensenum"];
                $firstname= $_POST["firstname"];
                $lastname= $_POST["lastname"];
                $licensedate= $_POST["licensedate"];
                $birthdate= $_POST["birthdate"];
                $hospital= $_POST["hosworksat"];
                $specialty= $_POST["speciality"];

               
                $query = 'INSERT INTO doctor (licensenum, firstname, lastname, licensedate, birthdate, hosworksat, speciality) values("' . $licensenum . '","' . $firstname . '", "' . $lastname . '" , "' . $licensedate . '", "' . $birthdate . '", "' .  $hospital . '", "' . $specialty . '")'; 
                if (!mysqli_query($connection, $query)) {
                        die("Invalid Hospital code or existing license num please try again (specific error shown below). <br><br>" . mysqli_error($connection));
                    }
                


                
                echo "<br>" . "New Doctor Information:";
                $query = 'SELECT * FROM doctor WHERE doctor.licensenum = "' . $licensenum . '"';
                $result=mysqli_query($connection,$query);

                if (!$result) {
                        die("database query8 failed.");
                }

        ?>
        
        <table border ="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>licensenum</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>licenseDate</th>
            <th>birthdate</th>
            <th>hosworksat</th>
            <th>speciality</th>
            
        </tr>

        <?php
            if (mysqli_num_rows($result) > 0) {
                $sn=1;
                while($data = mysqli_fetch_assoc($result)) {
               ?>
               <tr>
                 <td><?php echo $data['licensenum']; ?> </td>
                 <td><?php echo $data['firstname']; ?> </td>
                 <td><?php echo $data['lastname']; ?> </td>
                 <td><?php echo $data['licensedate']; ?> </td>
                 <td><?php echo $data['birthdate']; ?> </td>
                 <td><?php echo $data['hosworksat']; ?> </td>
                 <td><?php echo $data['speciality']; ?> </td>
               <tr>
               <?php
                $sn++;}
            } else { ?>
                <tr>
                <td colspan="8">No data found</td>
                </tr>
            <?php } ?>
        </table>

        
	<!-- Disconnect from the database. -->	
	<?php mysqli_close($connection); ?>

</body>
</html>
