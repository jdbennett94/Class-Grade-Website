<!-- This is the php script to keep track of user # -->
<?php 

#Checks if file exists, increments if yes, creates & begins if no
if(file_exists('userCount.txt')) {	
	$txtFile = fopen('userCount.txt',r);  
	$txtValue = fread($txtFile, filesize('userCount.txt'));
	
	echo ($txtValue+1);
		
	fclose($txtFile);

	$txtFile = fopen('userCount.txt',w);
	fwrite($txtFile, $txtValue+1); 
}
else {
	$txtFile = fopen('userCount.txt', w);
	fwrite($txtFile,1);
	echo '1'; 
	fclose($txtFile);
}

?>
