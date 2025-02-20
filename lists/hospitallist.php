<?php
   $query = 'SELECT * FROM hospital;';
   $result = mysqli_query($connection,$query);
   if (!$result) {
        die("databases query failed.");
    }
   while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="hoscode" value="';
        echo $row["hoscode"];
        echo '">' . $row["hosname"] . " Hospital in " . $row["city"] . ", " . $row["prov"] . "<br>";
   }
   mysqli_free_result($result);
?>
