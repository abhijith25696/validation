<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) 
{
    require "../config.php";
    require "../common.php";
    $fname="";
	$lname="";
	$age="";
	$email="";
	$loc=""; 
	
	$fname_e="";
	$lname_e="";
	$age_e="";
	$email_e="";
	$loc_e="";
	if(empty($_POST["firstname"]))
	{
		$fname_e="firstname can't be null";
	}
	else
	{
		$fname=$_POST["firstname"];
	}
	if(empty($_POST["lastname"]))
	{
		$lname_e="lastname cant be null";
	}
	else
	{
		$lname=$_POST["age"];
	}
	if(empty($_POST["email"]))
	{
		$email_e="email can't be null";
	}
	else
	{
		$fname=$_POST["email"];
	}
	
	if(empty($_POST["age"]))
	{
		$age_e="age can't be null";
	}
	else
	{
		$age=$_POST["age"];
	}
	if(empty($_POST["locatin"]))
	{
		$loc_e="location can't be null";
	}
	else
	{
		$loc=$_POST["location"];
	}
	
	
	if($fname!="" and $lname!="" and $age!="" and $email="" and loc!="")
	{
	
    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname"  => $_POST['lastname'],
            "email"     => $_POST['email'],
            "age"       => $_POST['age'],
            "location"  => $_POST['location']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
	}
}
?>

<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>
<script>
function validate()
{
	
	var fname=document.forms["reg"]["firstname"].value;
	var lname=document.forms["reg"]["lastname"].value;
	var email=document.forms["reg"]["email"].value;
	var age=document.forms["reg"]["age"].value;
	var loc=document.forms["reg"]["location"].value;
	if(fname=="")
	{
		alert("enter a valid name");
		document.forms["reg"]["name"].focus();
		return false;
	}
	else if(lname=="")
	{
		alert("enter a valid lastname");
		document.forms["reg"]["email"].focus();
		return false;
	}
	else if(email=="")
	{
		alert("enter a valid email");
		document.forms["reg"]["password"].focus();
		return false;
	}
	else if(age=="")
	{
		alert("enter age");
		document.forms["reg"]["age"].focus();
		return false;
	}
	else if(location=="")
	{
		alert("enter locatin");
		document.forms["reg"]["location"].focus();
		return false;
	}
	else
	{
		alert("Dear "+fname.value);
	}
		
		
}
	

</script>

<h2>Add a user</h2>

<form method="post"onsubmit="return validate()" name="reg">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="email" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
