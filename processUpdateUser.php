<?php
/**
 * PraviinM
 */


require_once("config.php");

// print_r is to display the contents of an array() in PHP.
//print_r($_POST);

// Assigning $_POST values to individual variables for reuse.
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$dob = $_POST['dateofbirth'];
$email = $_POST['email'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$thisuserid = $_POST['userid'];

if ($_POST['submit'])
{
    $updatedRecord  = updateThisRecord($fname, $lname, $city, $zip, $dob, $email, $thisuserid);
    echo "<br>The record is updated.</br>";
}


if ($_POST['delete_record'])
{
    $deleteRecord  = delete_a_particular_user($thisuserid);
    echo "<br>The record is deleted.</br>";
}


if ($_POST['deactivate_user'])
{
    $deactivateuser = deactivate_an_account($thisuserid);
    echo "<br>The account is not active now.</br>";
}






