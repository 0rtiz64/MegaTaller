
<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/7/2018
 * Time: 8:25 AM
 */

	$enlace = mysqli_connect("127.0.0.1", "root", "", "megataller");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//mysqli_close($enlace);

 ?>