<?php
  require "main.header.php";
  include("function/bookmf.php");
 ?>


  <div class="container" style="margin-top: 30px;">
    <div class="row">
      <div class="col-sm-2">
       <h5>Book Management!</h5>
       <?php
         echo "<p>".$_SESSION['userUid']."</p>";
        ?>
       <ul class="nav nav-pills nav-stacked">
         <li><a href='admin.book.php?pages=addbook'>ADD BOOK</a></li>
         <li><a href='admin.book.php?pages=editbook'>EDIT BOOK</a></li>
         <li><a href='admin.book.php?pages=delbook'>DELETE BOOK</a></li>
       </ul>
       <hr class="hidden-sm hidden-md hidden-lg">
       </div>
       <div class="col-sm-8" style="background-color: #f2f2f2;">

       <?php
          bookmanagement();
        ?>
       </div>
    </div>
  </div>
  <hr>

<?php
  require "footer.php"
?>
