<?php

print_r($_POST);

require_once("config.php");

// Assigning $_POST values to individual variables for reuse.

$firstname = $_POST['firstname'];
$lname = $_POST['lastname'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$dob = $_POST['dateofbirth'];
$email = $_POST['emailaddress'];


$checkuser = user_already_exists($firstname, $lname, $email, $dob );
echo  $checkuser[0];

if($checkuser[0] == 0) {
    $newuser = createNewUser($firstname, $lname, $dob, $email, $city, $zip);
    echo "<br></br>";
    echo $newuser;
}
else {
    echo "<br></br>";
    echo "Sorry....you cannot insert as there is already existing user.";
    echo "<br></br>";
}


/**
$newuser = createNewUser($firstname, $lname, $dob, $email, $city, $zip);
echo $newuser;

*/



?>
