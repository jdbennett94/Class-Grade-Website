<!DOCTYPE HTML>
<html><head>
        <title> Loyola Grade Portal </title>
        <link rel="stylesheet" type="text/css" href = "http://jbennett.cs.loyola.edu/projects/projectFinal/css/layout.css" title = "standard">
        <link rel="alternate stylesheet" type="text/css" href = "http://jbennett.cs.loyola.edu/projects/projectFinal/css/alt_layout.css" title = "darker">
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


<div class = "separator">
<?php

$htmlUsername = $_POST['username'];
$htmlPassword = $_POST['password']; 

$servername = "cs-database.cs.loyola.edu";
$username = "jbennett";
$password = "1670682";
$dbName = "jbennett";
$mysqli = new mysqli($servername, $username, $password, $dbName);

#Connects 
if($mysqli->connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
}


#Verify user
#Verifies user data
$queryU = "Select * from CS456Roster WHERE username='$htmlUsername' Limit 1";
$resultU = $mysqli->query($queryU);
if(!$resultU) die($mysqli->error);
$rowU = $resultU->fetch_assoc();
if ($resultU->num_rows === 0) {
        echo "Your account has not been registered for this class";
        goto a;
}

if (!password_verify("$htmlPassword", $rowU['password'])){
	echo "Your username and password do not match"; 
	echo nl2br ("\n");
	echo nl2br ("\n");
	echo "Click <a href = 'home.html'>here</a> to submit the correct info";
	goto a; 
} 


#Classmates query Statement
$sql1 = "select * from CS456Roster";
$result1 = $mysqli->query($sql1);


##### JQuery Button for class list ####
echo ("<div id = jbutton1>"); 
#Iterates through selection of classmates
echo ("A list of your classmates and their submitted emails");
echo nl2br ("\n");
echo nl2br ("\n"); 
while ($row = $result1->fetch_assoc()){
	echo  "Lastname: ", $row['lastname'], "<br>", "Email: ", $row['email'], "<br><br>"; 
}
echo ("</div>"); 


#### JQuery Button for grades ####
echo nl2br ("\n");
echo ("These are your grades, so far: ");
echo nl2br ("\n");

#Outputs 
$queryGrades = "Select lastname,a1,a2,a3,a4,a5 from CS456Grades WHERE username='$htmlUsername' Limit 1";
$resultG = $mysqli->query($queryGrades);
if(!$resultG) die($mysqli->error);

$rowG = $resultG->fetch_assoc();

#Output to user 
echo "<div style = 'font-family: Courier New'>";
echo "Assignment1 1: | ", $rowG['a1'], " |", "<br>"; 
echo "Assignment1 2: | ", $rowG['a2'], " |", "<br>";
echo "Assignment1 3: | ", $rowG['a3'], " |", "<br>";
echo "Assignment1 4: | ", $rowG['a4'], " |", "<br>";
echo "Assignment1 5: | ", $rowG['a5'], " |", "<br>";
echo "</div>";

#echo nl2br ("\n");




a:
$mysqli->close();

?>
<br>
<div style = "position: relative"><p>
	<div style = "position:absolute;bottom:0;right:0;font-size:10pt;">Site Visitors: <?php include "userCounter.php";?></p></div></div>  
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
