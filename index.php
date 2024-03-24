
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main">
    <div class="heading">
        <h1>Form</h1>
    </div>
     <div class="form">
     <h3>Enter The Details</h3>
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  class="box" autocomplete="off" enctype="multipart/form-data">
        <div class="input">
             <span> <p id="error_msg" style="text-transform:capitalize;display:none;"></p> </span>
            <label for="Name">Name</label><input type="text" name="Name" id="name">
            <label for="address">Address</label><input type="text"name="address" id="address">
            <label for="Name">Date</label><input type="date"name="date" id="date">
            <label for="Img">Image</label><input type="file"name="img" id="img">
        </div>
        <input type="submit" value="Submit" id="submit" name="submit">
        <div class="show">
        <a href="../php/display.php" target="_blank" rel="noopener noreferrer" style="color:azure;">Data</a>
       </div>
     </form>
    </div>
</div>
</body>
</html>

<?php
require_once 'connection.php';

   if(isset($_POST["submit"]) && $_FILES['img']){

    $name=$_POST["Name"];
    $address=$_POST["address"];
    $date=$_POST["date"];
     
    $img_name=$_FILES['img']['name'];
    $img_size=$_FILES['img']['size'];
    $tmp_name=$_FILES['img']['tmp_name'];
    $error=$_FILES['img']['error'];
    $img=$_FILES['img'];
    if(empty($name) || empty($address) || empty($date) || empty($img)){
      echo "<script>  
        document.getElementById('submit').addEventListener('click',errmsg());
        function errmsg(){
        document.getElementById('error_msg').innerHTML='all fields are required';
        document.getElementById('error_msg').style.display='flex';
        document.getElementById('error_msg').style.color='red';
        }
          </script>";
    }
    if($error===0){
       if($img_size>600000){
        echo "<script> alert('Sorry file size is too large'); </script>";
       }
       else{
        $img_ext=pathinfo($img_name,PATHINFO_EXTENSION);  //To check what is the extension of the image
        $img_ext=strtolower($img_ext);                    // To convert the charectors in the lower case
        $allowed_ext=array("jpg","jpeg","png");   //Only formats that can be inserted

          if(!in_array($img_ext,$allowed_ext)){
            echo "<script> alert('You cant upload files of this type'); </script>";
          }
          else{
            $new_img_name=uniqid("IMG-",true).'.'. $img_ext;  //provide an unique id to the image
            $img_upload_path="uploads/". $new_img_name;
            move_uploaded_file($tmp_name,$img_upload_path);

            //Insertion in datbase
            $sql="INSERT INTO records VALUES('','$name','$address','$date','$new_img_name')";
           if(mysqli_query($conn,$sql)){
            echo "<script> alert('Data inserted successfully'); </script>";
           }
           else{
            echo "<script> alert('Something went Wrong'); </script>";
           }
          }
       }

    }
    else{
        echo "";
    }
   }
?>
