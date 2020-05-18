<?php

function unwelcomebook()
{
  global $conn;
  if (!isset($_GET['isbn'])) {
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
      $sql = "SELECT book.isbn, title, count(*) as salesnum
      FROM book, salesbook s
      where (book.isbn=s.ISBN)&&(s.isbn LIKE'%$search%' or book.title LIKE'%$search%')
      group by s.ISBN
      order by 3";
      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Sales Number: ".$row['salesnum']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {

      $sql = "SELECT book.isbn, title, count(*) as salesnum
      FROM book, salesbook
      where book.isbn=salesbook.ISBN
      group by salesbook.ISBN
      order by 3; ";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Sales Number: ".$row['salesnum']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
  }
}

function popularbook()
{
  global $conn;
  if (!isset($_GET['isbn'])) {
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
      $sql = "SELECT book.isbn, title, count(*) as salesnum
      FROM book, salesbook s
      where (book.isbn=s.ISBN)&&(s.isbn LIKE'%$search%' or book.title LIKE'%$search%')
      group by s.ISBN
      order by 3 desc";
      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Sales Number: ".$row['salesnum']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {

      $sql = "SELECT book.isbn, title, count(*) as salesnum
      FROM book, salesbook
      where book.isbn=salesbook.ISBN
      group by salesbook.ISBN
      order by 3 desc; ";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Sales Number: ".$row['salesnum']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
  }
}

function checkpreoder(){
  global $conn;

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
      WHERE preorderID LIKE'%$search%' or memberID LIKE'%$search%'; ";

      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>PreorderID: ".$row['preorderID']."</p>
                  <p>MemberID: ".$row['memberID']."</p>
                  <p>Preorder Number: ".$row['preordernum']."</p>
                  <p>Preorder Date: ".$row['preorderDate']."</p>
                  <p>Status: ".$row['status']."</p>
                  <a href='admin.sales.php?pages=cpreorder&preorderID=".$row['preorderID']."'>
                  Pass
                  </a>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {
      $sql = "SELECT * FROM preorder; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>PreorderID: ".$row['preorderID']."</p>
                  <p>MemberID: ".$row['memberID']."</p>
                  <p>Preorder Number: ".$row['preordernum']."</p>
                  <p>Preorder Date: ".$row['preorderDate']."</p>
                  <p>Status: ".$row['status']."</p>
                  <a href='admin.sales.php?pages=cpreorder&preorderID=".$row['preorderID']."'>
                  Pass
                  </a>
                </div>
              </div>
            </div>";
        }
      }
    }

  if (isset($_GET['preorderID'])) {
    $preorderid = $_GET['preorderID'];

    $sql = "UPDATE preorder
    set status = 'Y'
    where preorderID = $preorderid";

    if($conn->query($sql) == true) {
      echo "Edit Sucessful!";
    }
    else {
      echo "Edit Failed!";
    }
  }
}

function checkstorage(){
  global $conn;
  if (!isset($_GET['isbn'])) {
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
      $sql = "SELECT title, book.isbn, author, sum(Quantity) as qty FROM book, bookstorage
      WHERE (book.isbn=bookstorage.isbn)
      and (title LIKE'%$search%' or book.isbn LIKE'%$search%' or author LIKE'%$search%')
      group by book.isbn;
      ";
      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>isbn: ".$row['isbn']."</p>
                  <p>title: ".$row['title']."</p>
                  <p>author: ".$row['author']."</p>
                  <p>Quntiy: ".$row['qty']."</p>

                </div>
              </div>
            </div>";
        }
      }
    }
    else {

      $sql = "SELECT title, book.isbn, author, sum(quantity) as qty FROM book, bookstorage
      WHERE book.isbn=bookstorage.ISBN
      group by book.isbn; ";

      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Title: ".$row['title']."</p>
                  <p>Author: ".$row['author']."</p>
                  <p>Quantity: ".$row['qty']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
  }
  else {
    $preorderid = $_GET['preorderID'];

    $sql = "UPDATE preorder
    set status = 'y'
    where preorderID = $preorderid";

    if($conn->query($sql) == true) {
      echo "Pass Sucessful!";
    }
    else {
      echo "Pass Failed!";
    }
  }
}

function sprofit(){
  global $conn;
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

      $sql = "SELECT title, book.isbn, sum(price) as sumprice FROM book, salesbook, salesrecord
      WHERE (salesbook.SaleID=salesrecord.saleID
      and salesbook.ISBN=book.isbn)
      and (title LIKE'%$search%' or book.isbn LIKE'%$search%')
      group by book.isbn; ";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Title: ".$row['title']."</p>
                  <p>Sales Profit: $".$row['sumprice']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {

      $sql = "SELECT title, book.isbn, sum(price) as sumprice FROM book, salesbook, salesrecord
      WHERE salesbook.SaleID=salesrecord.saleID
      and salesbook.ISBN=book.isbn
      group by book.isbn; ";

      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>ISBN: ".$row['isbn']."</p>
                  <p>Title: ".$row['title']."</p>
                  <p>Sales Profit: $".$row['sumprice']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
}

function bprofit(){
  global $conn;
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

      $sql = "SELECT salesrecord.BranchID, branch.Address, branch.Contact, sum(price) as sumprice
      FROM book, branch, salesbook, salesrecord
      WHERE (salesbook.SaleID=salesrecord.saleID
      and salesbook.ISBN=book.isbn
      and branch.BranchID=salesrecord.BranchID)
      and (salesrecord.BranchID LIKE'%$search%')
      group by salesrecord.BranchID; ";

      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>BranchID: ".$row['BranchID']."</p>
                  <p>Address: ".$row['Address']."</p>
                  <p>Contact: ".$row['Contact']."</p>
                  <p>Branch Profit: $".$row['sumprice']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {

      $sql = "SELECT salesrecord.BranchID, branch.Address, branch.Contact, sum(price) as sumprice
      FROM book, branch, salesbook, salesrecord
      WHERE salesbook.SaleID=salesrecord.saleID
      and salesbook.ISBN=book.isbn
      and branch.BranchID=salesrecord.BranchID

      group by branch.BranchID; ";

      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>BranchID: ".$row['BranchID']."</p>
                  <p>Address: ".$row['Address']."</p>
                  <p>Contact: ".$row['Contact']."</p>
                  <p>Branch Profit: $".$row['sumprice']."</p>
                </div>
              </div>
            </div>";
        }
      }
    }
}


function salesmanagement()
{
  global $conn;
  if(isset($_GET['pages'])) {
    $page = $_GET['pages'];
    if ($page == 'pbook') {
      popularbook();
    }
    else if ($page == 'ubook') {
      unwelcomebook();
    }
    else if ($page == 'cstorage') {
      checkstorage();
    }
    else if ($page == 'cpreorder') {
      checkpreoder();
    }
    else if ($page == 'sprofit') {
      sprofit();
    }
    else if ($page == 'bprofit') {
      bprofit();
    }
  }
  else {
    popularbook();
  }
}
