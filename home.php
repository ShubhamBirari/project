<!DOCTYPE>
<!DOCTYPE html>
<?php
$connect=mysqli_connect("localhost","root","","demousers");
$query1="SELECT * FROM course_master";
$result1=mysqli_query($connect,$query1);
?>
<html>
    <head>
        <style>
                
            h3 {
                text-align: center;
            }
            p {
                text-align-last: right;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <br><br>
        <div class="container" style="width:700px;">
            <div style="text-align: center;">
                <button class="btn btn-info btn-xs" type="button"  onclick="showDiv2()">Course Details</button>
                <button class="btn btn-info btn-xs" type="button"  onclick="showDiv()" >Student Details</button>
                <button class="btn btn-info btn-xs" type="button"  onclick="reset()" >Reset</button>
            </div>
            
<!-- Display Student details -->
        <div id="StudentDetails"   class="answer_list" >
            <h3 align="center" size="20px">Student Information</h3>
            <p> 
                <button class="btn btn-info btn-xs add_student" value="add Student" 
                onclick="window.location.href='\add_student.php'">ADD STUDENT</button></p>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="25%">Student ID</th>
                        <th width="25%">Student Name</th>
                        <th width="25%">View</th>
                        <th width="25%">Delete</th>
                    </tr>
                    <?php
                        //$query="SELECT * FROM studentdetails";
                        //$result=mysqli_query($connect,$query);

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

                        foreach($response as $value)
                        {
                        	foreach ($value as $row) {
                    ?>
                    <tr>
                        <td><?php   echo $row["id"]; ?></td>  
                        <td><?php   echo $row["name"]; ?></td>    
                        <td><input type="button" name="view" value="view" id="<?php   echo $row["id"]; ?>" class="btn btn-info btn-xs view_data"/></td>    
                        <td><input type="button" name="Delete" value="Delete" id="<?php   echo $row["id"]; ?>" class="btn btn-info btn-xs delete_data"/></td>
                    </tr>
                     <?php   
                     } 
                        }
                    ?>
                </table>
            </div>
            </div>
            
<!-- Display Course details -->
            <div id="CourseDetails"  style="display:none;" class="answer_list" >
            <h3 align="center" size="20px">Course Details</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="50%">Course Name</th>
                        <th width="50%">Duration</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($result1))
                        {
                    ?>
                    <tr>
                        <td><?php   echo $row["cname"]; ?></td>    
                        <td><?php   echo $row["cduration"]; ?></td>
                    </tr>
                     <?php    
                        }
                    ?>
                </table>
            </div>
            </div>
            
        </div>
    </body>
</html>

<!-- Display Pop-Up on View Button -->
    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4>Student Details</h4>
                </div>
                <div class="modal-body" id="student_details">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!-- Display Pop-Up on Delete Button -->
    <div id="dataModal1" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4>Student Details</h4>
                </div>
  <!--             
                    <div class="modal-body" id="delete_details">
                </div>
-->
                   <h3> Do you want to Delete Selected Student Details?</h3>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="showDiv3()" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

<!-- Display Pop-Up on Add Student Button -->
<!-- <div id="dataModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4>Add Student</h4>
                </div>
                <div class="modal-body" id="student_details">

                    <div class='center'>
                        <form method="post" id="insert_form">
                            <label>Name :</label><input type="text" name="name"><br><br>
                            <label>Course :</label><br>
                            <div id='checkboxes'>
                                <input type="checkbox" name="course[]" value="PHP">PHP<br>
                                    <input type="checkbox" name="course[]" value="JS"> JS<br>
                                    <input type="checkbox" name="course[]" value="CSS"> CSS<br>
                                    <input type="checkbox" name="course[]" value="PYTHON"> PYTHON<br>
                            </div>
                            <br>
                            <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
                        </form> 
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="showDiv3()" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>-->
<script>
    //onclick() show student details
function showDiv() {

   document.getElementById('CourseDetails').style.display = "none";
  document.getElementById('StudentDetails').style.display = "block";
}

function showDiv3() {
    //document.getElementById('StudentDetails').style.display = "none";
    //window.location.reload(true)
    document.getElementById('StudentDetails').style.display = "block";
    window.location.reload(true);
    //var button = document.getElementById('StudentDetails');
    //button.form.submit();
}
     
    //onclick() show Course details
function showDiv2() {
    
   document.getElementById('StudentDetails').style.display = "none";
   document.getElementById('CourseDetails').style.display = "block";
}   
    //onclick() Reset Page
function reset() {
    
   document.getElementById('StudentDetails').style.display = "none";
   document.getElementById('CourseDetails').style.display = "none";
}

     //Pop-up Studentdetails
$(document).ready(function(){
    $('.view_data').click(function(){
        var student_id = $(this).attr("id");
        
        $.ajax({
            url : "select.php",
            method : "post",
            data : {student_id:student_id},
            success: function(data){
                $('#student_details').html(data);
                $('#dataModal').modal("show");
            }
        }); 
        
    });
    
});
    
    //Delete Student details
$(document).ready(function(data){
    $('.delete_data').click(function(){
        var delete_data = $(this).attr("id");
        
        $.ajax({
            url : "select.php",
            method : "post",
            data : {delete_data:delete_data},
            success: function(){
                $('#delete_details').html(data);
                $('#dataModal1').modal("show");
        } 
        
        });
    
    });
});
    

//Pop-up Add student details
/*$(document).ready(function(){
    $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
    /*$('.add_student').click(function(){
        var student_add = $(this).attr("id");
        
        $.ajax({
            url : "select.php",
            method : "post",
            data : {student_add:student_add},
            success: function(data){
                $('#student_details').html(data);
                $('#dataModal2').modal("show");
            }
        }); 
        
    });

    $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
             
            $.ajax({  
                 url:"select.php",  
                 method:"post",  
                 data:$('#insert_form').serialize(),  
                 beforeSend:function(){  
                      $('#insert').val("Inserting");  
                 },  
                 success:function(data){  
                      $('#insert_form')[0].reset();  
                      $('#dataModal2').modal('hide');  
                      $('#employee_table').html(data);  
                 }  
            });  
             
      });
    
});*/

</script>