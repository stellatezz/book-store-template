<?php
  require "header.php";
 ?>

 <main>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="img/cover.jpg" alt="New York" width="1200" height="700">
            <div class="carousel-caption">
              <form  action="includes/login.inc.php" method="post">
                <div class="main_cover">
                    <div class="signup_box">
                      <section class="default_section">
                        <input type="text" name="uid" placeholder="Username">
                        <input type="password" name="pwd" placeholder="Password">
                    </section>
                  </div>
                </div>
                <a href="login.php"><button type="sumbit" name="sumbit_login">LOGIN !</button></a>
              </form>
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
