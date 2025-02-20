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

    <h1>Doctor info:</h1>

    <?php
        $field = $_POST["field"];
        $order = $_POST["order"];

        // Order by last name in ascending order
        if ($field < "2" and $order < "2") {
          
          $query = 'SELECT * FROM doctor ORDER BY lastname;';
            $result=mysqli_query($connection,$query); 
        }

        // Order by last name in descending order
        if ($field < "2" and $order > "2") {
          
          $query = 'SELECT * FROM doctor ORDER BY lastname DESC;';
            $result=mysqli_query($connection,$query); 
        }

        // Order by birthdate in ascending order
        if ($field > "2" and $order < "2") {
          
          $query = 'SELECT * FROM doctor ORDER BY EXTRACT(YEAR FROM birthdate), EXTRACT(MONTH from birthdate) ASC;';
            $result=mysqli_query($connection,$query); 
        }

        // Order by birthdate in desencing order
        if ($field > "2" and $order > "2") {
          
          $query = 'SELECT * FROM doctor ORDER BY EXTRACT(YEAR FROM birthdate), EXTRACT(MONTH from birthdate) DESC;';
            $result=mysqli_query($connection,$query); 
        }
    ?>

    <table border ="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>License Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>License Date</th>
        <th>Birth Date</th>
        <th>Hospital</th>
        <th>Speciality</th>
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

