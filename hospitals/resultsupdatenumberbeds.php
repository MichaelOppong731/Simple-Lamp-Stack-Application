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

    <h1>Hospital Beds:</h1>
    

    <?php
            $hoscode= $_POST["hoscode"];
            $numofbed= $_POST["numofbed"];
    
      
            echo "Before Modification:" . "<br>";
            
            $query = 'SELECT * FROM hospital WHERE hoscode = "' . $hoscode . '"';
                $result=mysqli_query($connection,$query);

                        if (!$result) {
                                die("database query3 failed.");
                        }

    ?>

    <table border ="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Hospital Name</th>
            <th>City</th>
            <th>Province</th>
            <th>Number of Beds</th>
        </tr>

        <?php
            if (mysqli_num_rows($result) > 0) {
                $sn=1;
                while($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $data['hosname']; ?> </td>
                <td><?php echo $data['city']; ?> </td>
                <td><?php echo $data['prov']; ?> </td>
                <td><?php echo $data['numofbed']; ?> </td>
            <tr>
            <?php
                $sn++;}
            } else { ?>
                <tr>
                <td colspan="8">No data found</td>
                </tr>
            <?php } ?>
    </table>

    <?php
            
            $query = 'UPDATE hospital SET numofbed = "' . $numofbed . '" WHERE hoscode = "' . $hoscode . '"';

            if (!mysqli_query($connection, $query)) {
                    die("Error: insert failed" . mysqli_error($connection));
                }
            
            
            // Print out new result
            echo "<br>"."<br>"."After Modification(s):" . "<br>";

            $query = 'SELECT * FROM hospital WHERE hoscode = "' . $hoscode . '"';
                $result=mysqli_query($connection,$query);

                        if (!$result) {
                                die("database query3 failed.");
                        }

    ?>

    <table border ="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>Hospital Name</th>
            <th>City</th>
            <th>Province</th>
            <th>Number of Beds</th>
        </tr>

        <?php
            if (mysqli_num_rows($result) > 0) {
                $sn=1;
                while($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $data['hosname']; ?> </td>
                <td><?php echo $data['city']; ?> </td>
                <td><?php echo $data['prov']; ?> </td>
                <td><?php echo $data['numofbed']; ?> </td>
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
