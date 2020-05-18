<?php
  require "main.header.php";
 ?>

<hr>
<hr>
 <div class="card" style="margin: 10% 20% 15% 15%; background-color: white;">
   <h2 style="text-align:center">Book Profile</h2>
   <div class="container" style="margin: auto;margin-bottom: 10%;width:90%;">
     <?php
        getbookinfo();
      ?>
   </div>
     <?php
        preorder();
      ?>
 </div>

 <?php
   require "footer.php";
  ?>
