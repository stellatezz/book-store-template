<?php
  require "main.header.php";
  include("function/staffmf.php");
 ?>


  <div class="container" style="margin-top: 30px;">
    <div class="row">
      <div class="col-sm-2">
       <h5>Staff Management!</h5>
       <?php
         echo "<p>".$_SESSION['userUid']."</p>";
        ?>
       <ul class="nav nav-pills nav-stacked">
         <li><a href='admin.staff.php?pages=addstaff'>ADD Staff</a></li>
         <li><a href='admin.staff.php?pages=editstaff'>EDIT Staff</a></li>
         <li><a href='admin.staff.php?pages=delstaff'>Delete Staff</a></li>
       </ul>
       <hr class="hidden-sm hidden-md hidden-lg">
       </div>
       <div class="col-sm-8" style="background-color: #f2f2f2;">
       <?php
          staffmanagement();
        ?>
       </div>
    </div>
  </div>
  <hr>

<?php
  require "footer.php"
?>
