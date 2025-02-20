<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CS3319 assignment3</title>

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
			  <a href="updatenumberbeds.php">Update No. Beds</a>
			</div>
		</div>
	</nav>

    <?php
        $hoscode= $_POST["hoscode"];

        //$query1 = 'SELECT hospital.hosname, hospital.city, hospital.prov, hospital.numofbed, doctor.firstname, doctor.lastname FROM hospital, doctor WHERE hospital.headdoc = doctor.licensenum;';
        $query1 = 'SELECT hospital.hoscode, hospital.hosname, hospital.city, hospital.prov, hospital.numofbed, doctor.firstname, doctor.lastname FROM hospital, doctor WHERE hospital.headdoc = doctor.licensenum AND hospital.hoscode = "' .  $hoscode . '";';
                $result1=mysqli_query($connection,$query1); 


        $query2 = 'SELECT firstname, lastname FROM doctor WHERE hosworksat = "' .  $hoscode . '";';
                $result2=mysqli_query($connection,$query2); 
    ?>

    <h1>Hospital Information</h1>

    <br>
    <table border ="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>Hospital Name</th> <th>City</th> <th>Province</th> <th>Number of Beds</th> <th>Head Doc First Name</th><th>Head Doc Last Name</th>
    </tr>

    <?php
        if (mysqli_num_rows($result1) > 0) {
            $sn=1;
            while($data1 = mysqli_fetch_assoc($result1)) {
            ?>
            <tr>
                <td><?php echo $data1['hosname']; ?> </td>
                <td><?php echo $data1['city']; ?> </td>
                <td><?php echo $data1['prov']; ?> </td>
                <td><?php echo $data1['numofbed']; ?> </td>
                <td><?php echo $data1['firstname']; ?> </td>
                <td><?php echo $data1['lastname']; ?> </td>
            <?php
            $sn++;}
        } else { ?>
            <tr><td colspan="8">No data found</td></tr>
        <?php } ?>
    </table>

    <br>
    <br>

    <h1>Doctors Who Work At Hospital</h1>

    <br>
    <table border ="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>First Name</th> <th>Last Name</th> 
    </tr>

    <?php
        if (mysqli_num_rows($result2) > 0) {
            $sn=1;
            while($data2 = mysqli_fetch_assoc($result2)) {
            ?>
            <tr>
                <td><?php echo $data2['firstname']; ?> </td>
                <td><?php echo $data2['lastname']; ?> </td>
            <?php
            $sn++;}
        } else { ?>
            <tr><td colspan="8">No data found</td></tr>
        <?php } ?>
    </table>

        
	
	<?php mysqli_close($connection); ?>

</body>
</html>
