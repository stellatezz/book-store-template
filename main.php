<?php
  require "main.header.php";
 ?>

  <div class='row'>
  <?php
      topsales();
  ?>
  </div>

  <div class="">
    <div class="row">
      <div class="col-sm-2">
        <h5>Wellcome Back!</h5>
          <?php
            echo "<p>".$_SESSION['userUid']."</p>";
           ?>
        <ul class="nav nav-pills nav-stacked">
          <?php
            showcat();
           ?>
        </ul>
        <hr class="hidden-sm hidden-md hidden-lg">
      </div>

      <div class="col-sm-10">
        <?php
          getbook();
          getbookbycat();
        ?>
      </div>
    </div>
  </div>
  <hr>

<?php
  require "footer.php"
 ?>
