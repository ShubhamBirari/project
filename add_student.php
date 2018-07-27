<html> 
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head> 
    
<head>
	<title>Add Student</title>
</head>
<body>
    <div class='center'>
	<form action="" method="post">
        <label>Name :</label><input type="text" name="name" id="name"><br><br>
    <label>Course :</label><br>
        <div id='checkboxes'>
            <input type="checkbox" name="course[]"  value="PHP">PHP<br>
		  		<input type="checkbox" name="course[]" value="JS"> JS<br>
		  		<input type="checkbox" name="course[]" value="CSS"> CSS<br>
		  		<input type="checkbox" name="course[]" value="PYTHON"> PYTHON<br>
        </div>
        <br>
		<input type="submit" value="Submit" name="submit">
	</form>	
    </div>
	
</body>
</html>
<?php
    if(isset($_POST['submit'])){
        $Name = $_POST['name'];
        $Course = $_POST['course'];
        $selected = "";
        foreach ($_POST['course'] as $service) 
        {
            $selected = $selected.$service." ";
        }

        $url = 'http://localhost/api/students/create';
        $data = array(
            'name' => $Name,
            'course' => $selected

        );
 
        //open connection
        $ch = curl_init($url);

        $json_data = json_encode($data);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($json_data))
        );

        // execute post
        $result = curl_exec($ch);

    echo $result;

    //close connection
    curl_close($ch);
}
            
?>