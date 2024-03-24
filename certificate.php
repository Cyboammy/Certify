<?php 
include 'connection.php';
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/certificate.css">  
 <style>

.box{
    width:700px;
    height:420px;
    border: 2px solid transparent;
    margin-top: 70px;
    margin-left: -610px;
    border-radius:5px;
    box-shadow: 20px 20px 60px #000000b3,inset -20px -20px 60px #7272723c;
    background-image: url("../Images/Template.jpg"); 
    background-size: cover;
}
#complete h1 {
    font-family: "Playfair Display", serif;
    font-optical-sizing: auto;
    font-weight:weight;
    font-style:normal;
  }

  #complete{
    margin-left: 295px;
    width: 220px;
    height: 40px;
    margin-top: 71px;
}

#complete h1{
    text-transform:uppercase;
    font-weight: bolder;
    font-size: xx-large;
    color: lightseagreen;
}

.info {
    text-transform: capitalize;
    color: lightseagreen;
    font-weight: bolder;
    margin-left:-135px;
    font-size: x-large;
    position:absolute;
}
#name,#address,#date,#img{
    border:2px solid transparent;
    height: 10px;
}
#name{
    height: 20px;
    width:220px; 
    margin-top:40px;
    font-size:x-large;
    font-weight: bolder;
    color:lightseagreen;
}

#address{margin-top:40px;width:220px; height:20px;color:lightseagreen;font-weight:bolder;font-size:large;}

#date{
    height: 20px;
    width:100px; 
    margin-top:40px;
    color:lightseagreen;
    font-weight: bolder;
    font-size:large;
}
#img{height:160px;width:160px;}
#sec1,#sec4{margin-left: 350px;}
#sec1{margin-top: -85px;}
#sec3{margin-left:350px;}
#sec2{
    margin-left: 30px;
    margin-top: -10px;
    position:relative;
    width: 160px;
    height: 160px;
}
</style>
</head>
 <body>
     <div class="box">
        <form action="#" method="post">
        <section id="complete">
            <h1>certificate of completion</h1>
         </section>
         <div class="content">
               <?php 
                $s_no=$_GET['s_no'];
                $sql="SELECT * FROM records WHERE s_no='$s_no'";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
               ?>
              <section id="sec2">
                <img src="../php/uploads/<?php echo $row['image']; ?>" id="img">
              </section>
               
              <section id="sec1">
              <label for="name" class="info">name :</label>   
                <h3 id="name">
                 <?php echo $name=$row['name']; ?>
                </h3>
              </section>
               
              <section id="sec3">
              <label for="date" class="info">date :</label>  
                <div id="date">
                <?php echo $date=$row['date']; ?>
              </div>
            </section>
             
            <section id="sec4">
            <label for="address" class="info">address :</label> 
                <p id="address">
                <?php  echo $address=$row["address"]; ?>
              </p>
            </section>  
           </form>
         </div>
     </div>
      <div class="download">
      <button type="button" id="btn">
      <a href="../php/certificate.php" download="certificate.pdf"  id="button" style="color:azure;">Download</a>
      <button>
     </div>
     <script src="../Nodejs/Text_extract.js"></script>
 </body>
 </html>

 <?php

 //pdf conversion by dompdf
require_once 'dompdf/autoload.inc.php';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="certificate.pdf"');
use Dompdf\Dompdf;
$dompdf=new Dompdf();
$html = file_get_contents('../php/certificate.php');
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("certificate.pdf", array("Attachment" => false));
?>
