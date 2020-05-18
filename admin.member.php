<?php
  require "main.header.php";
  include("function/membermf.php");
 ?>


  <div class="container" style="margin-top: 30px;">
    <div class="row">
      <div class="col-sm-2">
       <h5>Member Management!</h5>
       <?php
         echo "<p>".$_SESSION['userUid']."</p>";
        ?>
       <ul class="nav nav-pills nav-stacked">
         <li><a href='admin.member.php?pages=addmember'>ADD Member</a></li>
         <li><a href='admin.member.php?pages=editmember'>EDIT Member</a></li>
         <li><a href='admin.member.php?pages=delmember'>Delete Member</a></li>
       </ul>
       <hr class="hidden-sm hidden-md hidden-lg">
       </div>
       <div class="col-sm-8" style="background-color: #f2f2f2;">
       <?php
          membermanagement();
        ?>
       </div>
    </div>
  </div>
  <hr>

<?php
  require "footer.php"
?>
