<!DOCTYPE HTML>
<html><head>
        <title> Loyola Grade Portal </title>
        <link rel="stylesheet" type="text/css" href = "http://jbennett.cs.loyola.edu/projects/projectFinal/css/layout.css" title = "standard">
        <link rel="alternate stylesheet" type="text/css" href = "http://jbennett.cs.loyola.edu/projects/projectFinal/css/alt_layout.css" title = "darker">
	<script type = "text/javascript" src = "http://code.jquery.com/jquery-latest.min.js">           </script>
        <script language = "javascript" src = "project10.js"></script>
                <link rel = "stylesheet" href = "http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
        <script type = "text/javascript" src = "http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <link rel = "stylesheet" href = "http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
        <script type = "text/javascript" src = "http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head><body>

<div class = "header">
        <div class = "dropdown">
        <button class = "dropbtn">User</button>
        <div class = "dcon">
                <a href = "home.html">Log In/Log Out</a>
                <a href = "forgotMyPassword.html">Forgot Password</a>
                <a href = "newStudent.html">Create New Account</a>
        </div></div>
<h1>Loyola University Grade Portal </h1>
<p style = "font-style:italic"> Strong Truths Well Lived </p>
</div>


<div class = "separator" style = "text-align: center">
<?php
$htmlUsername = $_POST['username'];
$htmlPassword = $_POST['password'];
$htmlLast = $_POST['lastname'];
$htmlEmail = $_POST['email'];
$htmlColor = $_POST['color']; 


$servername = "cs-database.cs.loyola.edu";
$username = "******";
$password = "******";
$dbName = "******";
$mysqli = new mysqli($servername, $username, $password, $dbName);
if($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
}

#Checks to see if username exists
$query = "select username from CS456Roster"; 
$result = $mysqli->query($query);
if(!$result) die($mysqli->error); 

$rows = $result->num_rows; 
$check = false; 

#Iterates through searching for $username rows
for ($j = 0; $j < $rows ; ++$j)
{
	$result -> data_seek($j);
	$row = $result-> fetch_array(MYSQLI_ASSOC);
	
	if($row['username'] == $htmlUsername){	
		#username exists

		 echo ("<SCRIPT LANGUAGE='JavaScript'>; 
			window.alert('That username already exists, please try again with a different one'); 
			window.location.href='http://jbennett.cs.loyola.edu/projects/projectFinal/html/newStudent.html'; 
			</SCRIPT>");    
	}
}

#Password hashing
$cost = [
    'cost' => 12,
];
$hashPswd =  password_hash($htmlPassword, PASSWORD_BCRYPT, $cost);

#Inserts user values, you need the single apostrophies
$query2 = "insert into CS456Roster(username, lastname, password, email, color) values('$htmlUsername', '$htmlLast', '$hashPswd', '$htmlEmail', '$htmlColor')"; 
if($mysqli->query($query2) === true) {
	echo "Congratulations, you have been added to the course properly.";
	echo nl2br ("\n");
	echo nl2br ("\n");
	echo "You may now log in with the credentials you have provided.";
	echo nl2br ("\n");
}
else {
	echo "Error: ", $query2, "<br>", $mysqli->error; 
}


#### Create grade roster ####
$queryDG = "insert into CS456Grades(username,lastname,a1,a2,a3,a4,a5) values('$htmlUsername', '$htmlLast', '', '', '', '', '')";

if ($mysqli->query($queryDG) === true) {
	echo "Good";	
}
else {
	echo "Error: ", $queryDG, "<br>", $mysqli->error;
}


#closes out of database connections
$mysqli->close(); 

?><br> 
<div style = "text-align:center">Click <a href = "home.html">Here</a> To Go To Log-In Page</div> 
</div>


<div class = "footer">
<h3> Contact Us </h3>
<p>Main Campus<br>
4501 N. Charles Street<br>
Baltimore, MD 21210<br>
410-617-2000 or 1-800-221-9107<br>
<br>
Timonium Graduate Center<br>
2034 Greenspring Drive<br>
Timonium, MD 21093<br>
410-617-1903<br>
<br>
Columbia Graduate Center<br>
8890 McGaw Road<br>
Columbia, MD 21045<br>
410-617-7600</p>
</div>

</body></html>


