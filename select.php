<?php
    if(isset($_POST["student_id"]))
    {
        $output ='';
        //$connect=mysqli_connect("localhost","root","","testing");
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://localhost/api/students/read",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true); //because of true, it's in an array

        //$query="SELECT * FROM tbl_employee WHERE id='".$_POST["student_id"]."'" ;
        //$result=mysqli_query($connect,$query);
        $output .='
        <div class="table-responsive">.
        <table class="table table-bordered">';

        foreach($response as $value)
        {
            foreach ($value as $row) 
            {
                if ($row['id']==$_POST["student_id"]) 
                {
                   $output .= '
                    <tr>
                        <td width="30%"><label>Name</label></td>
                        <td width="70%">'.$row["name"].'</td>
                    </tr>
                    <tr>
                        <td width="30%"><label>Corses</label></td>
                        <td width="70%">'.$row["course"].'</td>
                    </tr>
                    
                    ';
                }
            }
        }
        $output .="</table></div>";
        echo $output;
    }

    if(isset($_POST["delete_data"]))
    {
        $output ='';
        //$connect=mysqli_connect("localhost","root","","testing");
        //$query="DELETE FROM tbl_employee WHERE id='".$_POST["delete_data"]."'" ;
        //$result=mysqli_query($connect,$query);

        //set POST variables
        $url = 'http://localhost/api/students/delete';
        $data = array(
            'id' => $_POST["delete_data"]
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
            
        $output .='
            <div class="table-responsive">.
            <table class="table table-bordered">';
        
        $output .="</table></div>";
        echo $output;
        
    } 


    /*if(isset($_POST["student_add"]))
    {

        $output ='';
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
            'course' => $Course

        );
        echo $Name;
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
            
        $output .='
            <div class="table-responsive">.
            <table class="table table-bordered">';
        
        $output .="</table></div>";
        echo $output;

    }*/
?>