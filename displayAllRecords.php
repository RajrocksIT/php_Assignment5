<?php
/**
 *  Rajesh Chinni
 */

?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>
    FIRST CRUD
  </title>
  <!-- Style -- Can also be included as a file usually style.css -->
  <style type="text/css">
	table.table-style-three {
      font-family: verdana, arial, sans-serif;
      font-size: 11px;
      color: #333333;
      border-width: 1px;
      border-color: #3A3A3A;
      border-collapse: collapse;
    }
    table.table-style-three th {
      border-width: 1px;
      padding: 8px;
      border-style: solid;
      border-color: #FFA6A6;
      background-color: #D56A6A;
      color: #ffffff;
    }
    table.table-style-three a {
      color: blue;
      text-decoration: none;
    }

    table.table-style-three tr:hover td {
      cursor: pointer;
    }
    table.table-style-three tr:nth-child(even) td{
      background-color: #F7CFCF;
    }
    table.table-style-three td {
      border-width: 1px;
      padding: 8px;
      border-style: solid;
      border-color: #FFA6A6;
      background-color: #ffffff;
    }
</style>

</head>
<body>

  <?php require_once("config.php");

  $allrecords = fetchAllUsers();


  ?>

  <!-- Table goes in the document BODY -->
  <table class="table-style-three">
      <thead>
        <!-- display user details header  -->
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>City</th>
        <th>Zip</th>
        <th>DateOfBirth</th>
        <th>EmailAddress</th>
        <th>MemberSince</th>
        <th>Active</th>
      </thead>
      <tbody>
      <?php
      foreach($allrecords as $displayRecords) { ?>
      <tr>
        <td><a href="updateThisUser.php?userid=<?php print $displayRecords['userid']; ?>"><?php print $displayRecords['userid']; ?></a></td>
        <td><?php print $displayRecords['firstname']; ?></td>
        <td><?php print $displayRecords['lastname']; ?></td>
        <td><?php print $displayRecords['city']; ?></td>
        <td><?php print $displayRecords['zip']; ?></td>
        <td><?php print date("Y-m-d", $displayRecords['dateofbirth']); ?></td>
        <td><?php print $displayRecords['email']; ?></td>
        <td><?php print date("Y-m-d", $displayRecords['membersince']); ?></td>
        <td><?php print $displayRecords['active']; ?></td>
      </tr>
      <?php } ?>
      </tbody>
  </table>

</body>
</html>
