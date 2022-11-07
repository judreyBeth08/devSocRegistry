<?php 
//connect to db
require ('connect-mysql.php');  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['fname'])) {
		$errors[] = 'You forgot to enter your First Name';
	} else {
		$lname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
	}

	//check for a last name
	if (empty($_POST['lname'])) {
		$errors[] = 'You forgot to enter your Last Name.';
	} else {
		$lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
	}

	// Check for course
	if (empty($_POST['course'])) {
		$errors[] = 'You forgot to enter your Course.';
	} else {
		$lname = mysqli_real_escape_string($dbcon, trim($_POST['course']));
	}
	
	// Check for phone number
	if (empty($_POST['phone'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$phone = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
	}
	
	// Check for an email address
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbcon, trim($_POST['email']));
	}
	
	if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO `registration`.`user` (`regid`, `firstname`, `lastname`, `course`, `phone`, `email`, `registration_date`) VALUES (NULL, '$fname', '$lname', '$course', '$phone', '$email', NOW() )";
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it runs
			header ("location: thankyou.php");
			exit();
		} 
	} else { // Report the errors.
		echo '<h2 class="error">Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
			echo "<p class='error'> - $msg<br></p>\n";
		}
		echo '</p><h3 class="error">Please try again.</h3><p><br></p>';
	}// End of if (empty($errors))
}
?>

<html> <!-- ate beth eto lang i-edit. ok na yung nasa taas. salamat! pa design narin nung index.php at yung thankyou.php. salamat! -->
<head>
	<title> template </title>
	<meta name="author" content="ubdevsoc">
	<meta name="viewport" content="width: device-width; initial-scale: 1.0">
	<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body>
<div class="content">

<form class="fStyle shadow" action="registration.php" method="post" id="form">
<div class="col-10 register">
<h2 class="toptext"> Welcome to SIT </h2>

<p><label class="label" for="fname">First Name:</label> 
<input id="fname" type="text" name="fname" size="30" maxlength="30" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>

<p><label class="label" for="lname">Last Name:</label> 
<input id="lname" type="text" name="lname" size="30" maxlength="30" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>

<p><label class="label" for="course">School:</label> 
<input id="course" type="text" name="course" size="30" maxlength="30" value="<?php if (isset($_POST['course'])) echo $_POST['course']; ?>"></p>

<p><label class="label" for="course">Grade level:</label> 
<input id="course" type="text" name="course" size="30" maxlength="30" value="<?php if (isset($_POST['course'])) echo $_POST['course']; ?>"></p>

<p><label class="label" for="phone">Contact Number:</label>
<input id="phone" type="number" name="phone" size="30" maxlength="30" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>"></p>

<p><label class="label" for="email">Email Address:</label>
<input id="email" type="email" name="email" size="30" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>

<p><input id="submit" type="submit" name="submit" value="Register"></p>
	</div>
</form>
</div>
</body>
</html>