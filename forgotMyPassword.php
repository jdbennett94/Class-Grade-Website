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

#Takes in html values
$htmlUsername = $_POST['username'];
$htmlEmail = $_POST['email'];
$htmlColor = $_POST['color'];
$htmlNewPassword = $_POST['password'];

#Creates mysql connection
$servername = "cs-database.cs.loyola.edu";
$username = "*******";
$password = "******";
$dbName = "*****";
$mysqli = new mysqli($servername, $username, $password, $dbName);
if($mysqli -> connect_error) {
        die("Database connection failed: " . $mysqli->connect_error);
}

#Verifies user data
$query1 = "Select * from CS456Roster WHERE username='$htmlUsername' Limit 1";
$result = $mysqli->query($query1);
if(!$result) die($mysqli->error);
$row = $result->fetch_assoc();
if ($result->num_rows === 0) {
        echo "That username does not exist";
        goto a;
}
#Saves lastname
$htmlLastname = $row['lastname'];

#Verifies Security Questions
if ($htmlEmail != $row['email']) {
        echo "Your security information does not match our records";
        goto a;
}

if ($htmlColor != $row['color']) {
        echo "Your security information does not match our records";
        goto a;
}




#### Deleting and inserting new values ####
#Password hashing
$cost = [
    'cost' => 12,
];
$hashPswd =  password_hash($htmlNewPassword, PASSWORD_BCRYPT, $cost);


#Deletes original values
$queryDelete = "delete from CS456Roster where username='$htmlUsername'";
if ($mysqli->query($queryDelete)=== true ) {
        echo "Value successfully deleted";
}
else {
        echo "Error: ", $queryDelete, "<br>", $conn->error;
}

#Inserts user values, you need the single apostrophies
$query2 = "insert into CS456Roster(username, lastname, password, email, color) values('$htmlUsername', '$htmlLastname', '$hashPswd', '$htmlEmail', '$htmlColor')";

if($mysqli->query($query2) === true) {

        #Output success
        echo "<div style ='text-align:center'>";
        echo "Congrats!";
        echo nl2br ("\n");
        echo nl2br ("\n");
        echo "Your password has been successfully changed!";
        echo nl2br ("\n");
        echo nl2br ("\n");
        echo "You may now log into your account with your new password";
        echo nl2br ("\n");
        echo nl2br ("\n");
        echo "Click <a href = 'home.html'>Here</a> to return to log-in page";
        echo "</div>";

}
else {
        echo "Error: ", $query2, "<br>", $conn->error;
}


a:
$mysqli->close();

?>
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
