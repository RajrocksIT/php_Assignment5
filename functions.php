<?php
/**
 * Rajesh Chinni
 */





//Create a new user

/**
 * @param $fname
 * @param $lname
 * @param $dob
 * @param $email
 * @param $city
 * @param $zip
 *
 * @return bool
 */
function createNewUser($fname, $lname, $dob, $email, $city, $zip)
{
    global $mysqli;
    //Generate A random userid
    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }
    // echo $rand_string;
    // echo $fname;
    // echo $lname;
    // echo $dob;
    // echo $email;
    // echo $city;
    //echo $zip;
    $stmt = $mysqli->prepare(
        "INSERT INTO user (
		userid,
		FirstName,
		LastName,
		City,
		Zip,
		DateOfBirth,
		EmailAddress,
		MemberSince,
		active
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        1
		)"
    );
    $stmt->bind_param("ssssss", $fname, $lname, $city, $zip, $dob, $email);
    $result = $stmt->execute();
    $stmt->close();
    return $result;

}


//Retrieve information for all users
/**
 * @return array
 */

function fetchAllUsers() {
  global $mysqli, $db_table_prefix;
  $stmt = $mysqli->prepare(
    "SELECT
		id,
		userid,
		FirstName,
		LastName,
		City,
		Zip,
		DateOfBirth,
		EmailAddress,
		MemberSince,
		active

		FROM user"
  );
  $stmt->execute();
  $stmt->bind_result(
    $id,
    $userid,
    $FirstName,
    $LastName,
    $City,
    $Zip,
    $DateOfBirth,
    $EmailAddress,
    $MemberSince,
    $active
  );

  while ($stmt->fetch()) {
    $row[] = array(
      'id'                      => $id,
      'userid'                  => $userid,
      'firstname'               => $FirstName,
      'lastname'                => $LastName,
      'city'                    => $City,
      'zip'                     => $Zip,
      'dateofbirth'             => $DateOfBirth,
      'email'                   => $EmailAddress,
      'membersince'             => $MemberSince,
      'active'                  => $active
    );
  }
  $stmt->close();
  return ($row);
}



//fetch particular users record

/**
 * @param $userid
 *
 * @return array
 */
function fetchThisUser($userid)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
      "
    SELECT
    id,
    userid,
    FirstName,
    LastName,
    DateOfBirth,
    EmailAddress,
    City,
    Zip,
    MemberSince,
    active

    FROM user
    WHERE
    userid = ?
    LIMIT 1"
    );
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $stmt->bind_result($id, $userid, $FirstName, $LastName, $DateOfBirth, $EmailAddress, $City, $Zip, $MemberSince, $active);

  while ($stmt->fetch()) {
    $row[] = array(
      'id'                      => $id,
      'userid'                  => $userid,
      'firstname'               => $FirstName,
      'lastname'                => $LastName,
      'city'                    => $City,
      'zip'                     => $Zip,
      'dateofbirth'             => $DateOfBirth,
      'email'                   => $EmailAddress,
      'membersince'             => $MemberSince,
      'active'                  => $active

    );
  }
  $stmt->close();
  return ($row);
}


//Update selected users record.
/**
 * @param $fname
 * @param $lname
 * @param $city
 * @param $zip
 * @param $dob
 * @param $email
 * @param $userid
 *
 * @return bool
 */
function updateThisRecord($fname, $lname, $city, $zip, $dob, $email, $userid)
{
    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare(
      "UPDATE " . $db_table_prefix . "user
		SET
		FirstName = ?,
		LastName = ?,
		City = ?,
		Zip = ?,
		DateOfBirth = ?,
		EmailAddress = ?
		WHERE
		userid = ?
		LIMIT 1"
    );
    $stmt->bind_param("sssssss", $fname, $lname, $city, $zip, $dob, $email, $userid);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}



//Checks if an email is valid
function isValidEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    else {
        return false;
    }
}


//Completely sanitizes text
function sanitize($str)
{
    return strtolower(strip_tags(trim(($str))));
}

//Checks if first name, last name, email id and date of birth already exists

function user_already_exists($firstname, $lname, $emailid, $dob )
{
    global $mysqli, $db_table_prefix;
    $fname = $firstname;
    $lname = $lname;
    $emailaddress = $emailid;
    $dateofbirth = $dob;
    $result = mysqli_query($mysqli, "SELECT count(userid) FROM user WHERE FirstName='$fname' AND LastName = '$lname'
 AND EmailAddress = '$emailaddress' AND DateOfBirth = '$dateofbirth' ");
    $result = mysqli_fetch_row($result);
    return $result;
}


function delete_a_particular_user($thisuserid )
{
    global $mysqli, $db_table_prefix;
    $userid = $thisuserid;
    $result = mysqli_query($mysqli, "DELETE FROM user WHERE userid='$userid' ");
    //$result = mysqli_fetch_row($result);
    if ($result === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: ";
    }
    return $result;
}

function deactivate_an_account($thisuserid )
{
    global $mysqli, $db_table_prefix;
    $userid = $thisuserid;
    $result = mysqli_query($mysqli, " UPDATE user SET Active = '0'  WHERE userid='$userid' ");
    //$result = mysqli_fetch_row($result);
    if ($result === TRUE) {
        echo "sadly the account is no more active";
    } else {
        echo "active status could not be changed ";
    }
    return $result;
}












