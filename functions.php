<?php
require 'includes/dbh.inc.php';


function getbookinfo()
{
  global $conn;

  if(isset($_GET['isbn'])) {

    $isbn_id= $_GET['isbn'];

    $sql = "SELECT * FROM book, category , publisher
    where book.categoryid=category.categoryID
    and book.publisherid=publisher.publisherID
    and book.isbn = $isbn_id;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $isbn = $row['isbn'];
    echo "<img src='bookimg/$isbn.gif' alt='bookimg' style='width:50%'>
          <p>ISBN: ".$row['isbn']."</p>
          <p>Title: ".$row['title']."</p>
          <p>Author: ".$row['author']."</p>
          <p>Caterory: ".$row['name']."</p>
          <p>Publisher: ".$row['publishername']."</p>
          <p>Price: ".$row['price']."</p>
          <p>Language: ".$row['language']."</p>
          <p>Description: ".$row['description']."</p>
    ";

  }
  else {
    echo "<p> No such book </p>";
  }
}

function topsales()
{
  global $conn;

  $sql = "SELECT book.isbn, title, price, author, count(*) as salesnum
  FROM book, salesbook
  where book.isbn=salesbook.ISBN
  group by salesbook.ISBN
  order by 3; ";

  $result = $conn->query($sql);


  if($result->num_rows > 0) {
    $i = 0;
    while (($row = $result->fetch_assoc())&&$i<5) {
      $isbn = $row['isbn'];
      echo "<div class='topcolumn'>
          <div class='card'>
            <img src='bookimg/$isbn.gif' alt='bookimg' style='width:100%'>
            <div class='container'>
              <p>".$row['title']."</p>
              <p>".$row['author']."</p>
              <p>$".$row['price']."</p>
            </div>
          </div>
        </div>";
        $i++;
    }
  }
}

function showcat()
{
  global $conn;
  $sql = "SELECT name FROM category";
  $result = $conn->query($sql);

  echo "<li><a href='main.php'>ALL BOOK</a></li>";
  if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<li><a href='main.php?category=".$row['name']."'>".$row['name']."</a></li>";
    }
  }
}

function adminbar() {
  if ($_SESSION['userId'] == '1')
  {
    echo "<li class='dropdown'>
      <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Admin
      <span class='caret'></span></a>
      <ul class='dropdown-menu '>
        <li><a href='admin.book.php'>Book Management</a></li>
        <li><a href='admin.staff.php'>Staff Management</a></li>
        <li><a href='admin.member.php'>Member Management</a></li>
        <li><a href='admin.sales.php'>Sales Management</a></li>
      </ul>
    </li>";
  }
}

function getbook()
{
  global $conn;
  if(!isset($_GET['category'])){
    if (!isset($_GET['isbn'])) {
      echo "<form method='post'>
        <div class='input-group' style='margin-bottom: 20px; margin-top: 10px; margin-right: 15%; margin-left: 5px;'>
          <input type='text' class='form-control' name='searchitem' placeholder='Search'>
          <div class='input-group-btn'>
            <button class='btn btn-default' type='submit' name='sumbitbnt'>
              <i class='glyphicon glyphicon-search'></i>
            </button>
          </div>
        </div>
      </form>";
      if (isset($_POST['sumbitbnt'])) {
        $search = $_POST['searchitem'];
        $sql = "SELECT * FROM book
        WHERE isbn LIKE'%$search%' or author LIKE'%$search%' or title LIKE'%$search%'; ";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $isbn = $row['isbn'];
            echo "<div class='column' stype='margin-bottom: 15px'>
                <div class='card'>
                 <img src='bookimg/$isbn.gif' alt='bookimg' style='width:100%; height:250px'>
                  <div class='container'>
                    <p>".$row['title']."</p>
                    <p>".$row['author']."</p>
                    <p>$".$row['price']."</p>
                    <a href='bookdetail.php?isbn=".$row['isbn']."'>detail</a>
                  </div>
                </div>
              </div>";
          }
        }
      }
      else {
        $sql = "SELECT * FROM book; ";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $isbn = $row['isbn'];
            echo "<div class='column' stype='margin-bottom: 15px'>
                <div class='card'>
                  <img src='bookimg/$isbn.gif' alt='bookimg' style='width:100%; height:300px'>
                  <div class='container'>
                    <p>".$row['title']."</p>
                    <p>".$row['author']."</p>
                    <p>$".$row['price']."</p>
                    <a href='bookdetail.php?isbn=".$row['isbn']."'>detail</a>
                  </div>
                </div>
              </div>";
          }
        }
      }
    }

  }
}

function getbookbycat()
{
  global $conn;
  if(isset($_GET['category'])){

    $cat_id= $_GET['category'];

    $sql = "SELECT * FROM book, category
    WHERE book.categoryid = category.categoryID
    AND category.name LIKE '$cat_id%';";

    $result = $conn->query($sql);
    if($result->num_rows==0) {
      echo "<h2>No books found $cat_id</h2>";
    }
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $isbn = $row['isbn'];
        echo "<div class='column'>
            <div class='card'>
             <img src='bookimg/$isbn.gif' alt='bookimg' style='width:100%; height:300px'>
              <div class='container'>
                <p>".$row['title']."</p>
                <p>".$row['author']."</p>
                <p>$".$row['price']."</p>
              </div>
            </div>
          </div>";
      }
    }
  }
}

function showorder() {
  global $conn;
  $memberid = $_SESSION['userId'];
  echo "<form method='post'>
    <div class='input-group' style='margin-bottom: 10px; margin-top: 10px;'>
      <input type='text' class='form-control' name='searchitem' placeholder='Search'>
      <div class='input-group-btn'>
        <button class='btn btn-default' type='submit' name='sumbitbnt'>
          <i class='glyphicon glyphicon-search'></i>
        </button>
      </div>
    </div>
  </form>";
  if (isset($_POST['sumbitbnt'])) {
    $search = $_POST['searchitem'];
    $sql = "SELECT * FROM preorder
    WHERE preorderID LIKE'%$search%'
    and memberID = $memberid;";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>MemberID: ".$row['memberID']."</p>
                <p>PreorderID: ".$row['preorderID']."</p>
                <p>Status: ".$row['status']."</p>
              </div>
            </div>
          </div>";
      }
    }
  }
  else {
    $sql = "SELECT * FROM preorder
    WHERE memberID = $memberid;";
    echo $conn->error;
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>MemberID: ".$row['memberID']."</p>
                <p>PreorderID: ".$row['preorderID']."</p>
                <p>Status: ".$row['status']."</p>
              </div>
            </div>
          </div>";
      }
    }
  }
}

function preorder() {

  echo "<form method='post'>
  <a href='bookdetail.php?isbn=9780759640917'><button name='preorder'>Preorder</button></a>
  </form>";
  if (isset($_POST['preorder'])) {
    global $conn;
    $memberid = $_SESSION['userId'];
    $currentdate = date("m/d/Y");
    $sql = "INSERT INTO preorder
    ( memberID, preorderdate, preordernum, status)
    VALUES('$memberid', '$currentdate', '1', 'N')";
    if($conn->query($sql) == true) {
      echo "Add Sucessful!";
    }
    else {
      echo "Add Failed!".$conn->error;
    }
  }
}
