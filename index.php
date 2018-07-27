<html>
    
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    
    
    
    <div class='center'>
    <form method='POST' action="">
    
        <p><label>Username : </label><input type="text" name="username" id="username"></p>
        <p><label>Password : </label><input type="password" name="passwd" id="passwd"></p>
        <p><button id="myBtn">LOGIN</button></p>
    </form>
    </div>
</body>
</html>
<?php
        $servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$username = "";
        $passwd = "";

		// Create connection
		$db = new mysqli($servername, $dbusername, $dbpassword,'demousers');

		// Check connection
		if (!$db) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		//echo "Connected successfully";
        
        //$result;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
            $username = $_POST['username'];
            $passwd = $_POST['passwd'];
        
            $username = stripcslashes($username);
            $passwd = stripcslashes($passwd);
            $username = mysqli_real_escape_string($db,$username);
            $passwd = mysqli_real_escape_string($db,$passwd);
        

            $sql = "select id from users where username = '$username' and passwd = '$passwd'";
            
            $result = mysqli_query($db, $sql)
            or die("failed to query database");
        
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        	//$active = $row['active'];
      
            $count = mysqli_num_rows($result);
        
            if($count == 1){
                $_SESSION['username'] = $username;
                $db->close();
                header("location: home.php");
            }else{

                echo '<script>alert("Invalid credentials!");</script>';    

            }   
        }  
?>