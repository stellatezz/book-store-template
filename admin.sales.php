<?php
  require "main.header.php";
  include("function/salesmf.php");
 ?>

 <div class="container" style="margin-top: 30px;">
   <div class="row">
     <div class="col-sm-2">
      <h5>Sales Management!</h5>
      <?php
        echo "<p>".$_SESSION['userUid']."</p>";
       ?>
      <ul class="nav nav-pills nav-stacked">
        <li><a href='admin.sales.php?pages=pbook'>Popular Books</a></li>
        <li><a href='admin.sales.php?pages=ubook'>Unwelcome Books</a></li>
        <li><a href='admin.sales.php?pages=cstorage'>Check Storage</a></li>
        <li><a href='admin.sales.php?pages=cpreorder'>Check Preorder</a></li>
        <li><a href='admin.sales.php?pages=sprofit'>Sales Profit</a></li>
        <li><a href='admin.sales.php?pages=bprofit'>Branch Profit</a></li>
      </ul>
      <hr class="hidden-sm hidden-md hidden-lg">
      </div>
      <div class="col-sm-8" style="background-color: #f2f2f2;">
      <?php
         salesmanagement();
       ?>
      </div>
   </div>
 </div>
 <hr>

<?php
 require "footer.php"
?>
