 <?php include 'connection.php';?>
            
           
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="../css/display.css">
 </head>
 <body>
    <section class="icon">
    <button type="button"><img src="../Images/icons8-menu-50.png" alt="" width="35px" height="35px" id="btn"></button>
    </section>
    
    <nav id="menu-bar">
    <ul class="side-bar">
			<li><a href="#">Download</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="#" target="_blank">Home</a></li>
			<li><a href="#">Contact</a></li>
		</ul>
</nav>

    <div class="main">
    <table class="table">
         <caption>User Data</caption>
        <thead>
        <tr><th>S.no</th><th>Name</th><th>Address</th><th>Date</th><th>Image</th><th>Download</th></tr>
        </thead> 
        <tbody>
        <?php
 $sql="SELECT * FROM records";
 $result=mysqli_query($conn,$sql);
 $nums=mysqli_num_rows($result);
 if($nums>0)
 while($row=mysqli_fetch_assoc($result)){  ?>
 <tr>
 <td> <?php echo $row['s_no']; ?> </td>
 <td> <?php echo $row['name']; ?> </td>
 <td> <?php echo $row['date']; ?> </td>
 <td> <?php echo $row['address']; ?></td>
 <td><img src='../php/uploads/<?php echo $row['image'];?>' width='100px' height='60px' alt='uploads'></td><td><a href='../php/certificate.php?s_no=<?php echo $row['s_no'];?>'id='certificate' target='_blank' rel='noopener noreferrer'>Click here</a></td></tr>
<?php }?>
         </tbody>
    </table>
   </div>
   <script>
      let btn=document.getElementById("btn").addEventListener("click",showsidebar());
     function showsidebar(){
      let bar= document.getElementById("menu-bar");
      bar.classList.toggle('show');
     }
     function hidesidebar(){
      let bar= document.getElementById("menu-bar");
      bar.classList.toggle('hide');
     }
   </script>
 </body>
 </html>


 