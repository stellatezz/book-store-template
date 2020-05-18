<?php
  require "header.php";
 ?>

 <main>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="img/cover.jpg" alt="New York" width="1200" height="700">
            <div class="carousel-caption">
                <a href="login.php"><button type="sumbit" name="sumbit_login">LOGIN !</button></a>
                <a href="signup.php"><button type="sumbit" name="sumbit_signup">SIGNUP!</button></a>
              <h3>BOOK STORE</h3>
              <p>database system assignment</p>
            </div>
          </div>
        </div>
    </div>
  </main>

  <?php
    require 'footer.php';
  ?>
