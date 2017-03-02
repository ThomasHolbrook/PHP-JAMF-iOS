<!--Thomas Holbrook - Tom@Jigsaw24.com -->
<!--PoC JAMF CCE March 2017 -->

<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Tom</title>
</head>
<body>
<br>
<br>
<font size="10" color="blue">
<form action="update.php" method="post">
AD User Name: <input type="text" name="username"><br>
<input type="hidden" value="<?php echo $_GET['id'] ?>" name="id"><br>
<input type="submit" style="height:100px; width:200px" font-size="10">
</form>
</font>
</body>
</html>