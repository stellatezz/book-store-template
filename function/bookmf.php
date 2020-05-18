<?php
function addbook()
{
  global $conn;
  echo "
  <div class=''>
    <h2 style='align: center;'>Add New Book</h2>
    <form method='post'>
      <div class='form-group'>
        <label for='isbn'>ISBN</label>
        <input type='text' class='form-control' id='isbn' name='add_isbn' placeholder='isbn..'>
      </div>
      <div class='form-group'>
        <label for='title'>Title</label>
        <input type='text' class='form-control' id='title' name='add_title' placeholder='title..'>
      </div>
      <div class='form-group'>
        <label for='author'>Author</label>
        <input type='text' class='form-control' id='author' name='add_author' placeholder='author..'>
      </div>
      <div class='form-group'>
        <label for='publisher'>Publisher ID</label>
        <input type='text' class='form-control' id='publisher' name='add_publisher' placeholder='publisher id..'>
      </div>
      <div class='form-group'>
        <label for='publishdate'>Publishdate</label>
        <input type='text' class='form-control' id='publishdate' name='add_publishdate' placeholder='yyyy-mm-dd..'>
      </div>
      <div class='form-group'>
        <label for='caterory'>Caterory ID</label>
        <input type='text' class='form-control' id='caterory' name='add_caterory' placeholder='caterory ID..'>
      </div>
      <div class='form-group'>
        <label for='language'>Language</label>
        <input type='text' class='form-control' id='language' name='add_language' placeholder='language..'>
      </div>
      <div class='form-group'>
        <label for='price'>Price</label>
        <input type='text' class='form-control' id='price' name='add_price' placeholder='price..'>
      </div>
      <div class='form-group'>
        <label for='description'>Description</label>
        <input type='text' class='form-control' id='description' name='add_description' placeholder='description..'>
      </div>
      <button type='submit' name='sumbit_add' class='btn btn-warning btn-block'>Add</button>
      </form>
    </div>";
    if (isset($_POST['sumbit_add'])) {
      $isbn = $_POST['add_isbn'];
      $title = $_POST['add_title'];
      $author = $_POST['add_author'];
      $publisher = $_POST['add_publisher'];
      $publishdate = $_POST['add_publishdate'];
      $language = $_POST['add_language'];
      $price = $_POST['add_price'];
      $description = $_POST['add_description'];
      $caterory = $_POST['add_caterory'];

      global $conn;
      $sql = "SELECT * FROM book WHERE isbn = $isbn";
      $result = $conn->query($sql);

      if($result->num_rows > 0) {

      }
      else {
        $sql = "INSERT INTO book
        (isbn, title, author, publisherid, publishdate, price, language, categoryid, description)
        VALUES('$isbn', '$title', '$author', '$publisher', '$publishdate', '$price', '$language','$caterory', '$description');";
        $result = $conn->query($sql);
        if($conn->query($sql) == true) {
          echo "Add Sucessful!";
        }
        else {
          echo "Add Failed!".$conn->error;
        }
      }
    }
}

function editbook()
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
      $sql = "SELECT * FROM book
      WHERE isbn LIKE'%$search%' or author LIKE'%$search%' or title LIKE'%$search%'; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>Author: ".$row['author']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <a href='admin.book.php?pages=editbook&isbn=".$row['isbn']."'>
                  Edit
                  </a>
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
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>Title: ".$row['title']."</p>
                  <p>Author: ".$row['author']."</p>
                  <p>ISBN: ".$row['isbn']."</p>
                  <a href='admin.book.php?pages=editbook&isbn=".$row['isbn']."'>
                  Edit
                  </a>
                </div>
              </div>
            </div>";
        }
      }
    }
  }
  else {
    $isbn = $_GET['isbn'];
    $sql = "SELECT * FROM book WHERE isbn = $isbn; ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $isbn = $row['isbn'];
    $title = $row['title'];
    $author = $row['author'];
    $publishdate = $row['publishdate'];
    $language = $row['language'];
    $price = $row['price'];
    $description = $row['description'];
    echo "
    <div class=''>
      <h2 style='align: center;'>Edit Book</h2>
      <form method='post'>
        <div class='form-group'>
          <label for='isbn'>ISBN</label>
          <input type='text' class='form-control' id='isbn' name='edit_isbn' value='$isbn' placeholder='isbn..' disabled>
        </div>
        <div class='form-group'>
          <label for='title'>Title</label>
          <input type='text' class='form-control' id='title' name='edit_title' value='$title' placeholder='title..'>
        </div>
        <div class='form-group'>
          <label for='author'>Author</label>
          <input type='text' class='form-control' id='author' name='edit_author' value='$author' placeholder='author..'>
        </div>
        <div class='form-group'>
          <label for='publishdate'>Publishdate</label>
          <input type='text' class='form-control' id='publishdate' name='edit_publishdate' value='$publishdate' placeholder='yyyy-mm-dd..'>
        </div>
        <div class='form-group'>
          <label for='language'>Language</label>
          <input type='text' class='form-control' id='language' name='edit_language' value='$language' placeholder='language..'>
        </div>
        <div class='form-group'>
          <label for='price'>Price</label>
          <input type='text' class='form-control' id='price' name='edit_price' value='$price' placeholder='price..'>
        </div>
        <div class='form-group'>
          <label for='description'>Description</label>
          <input type='text' class='form-control' id='description' name='edit_description' value='$description' placeholder='description..'>
        </div>
        <button type='submit' name='sumbit_edit' class='btn btn-warning btn-block'>Edit</button>
        </form>
      </div>";
      if (isset($_POST['sumbit_edit'])) {
        $isbn = $_GET['isbn'];
        $title = $_POST['edit_title'];
        $author = $_POST['edit_author'];
        $publishdate = $_POST['edit_publishdate'];
        $language = $_POST['edit_language'];
        $price = $_POST['edit_price'];
        $description = $_POST['edit_description'];

        $sql = "UPDATE book
        set
        title = '$title',
        author = '$author',
        publishdate = '$publishdate',
        language = '$language',
        price = '$price',
        description = '$description'
        where isbn = $isbn";

        if($conn->query($sql) == true) {
          echo "edit sucessful!";
        }
        else {
          echo "edit failed!";
        }

      }
  }
}
//******************
function delbook()
{
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

  global $conn;
  if (isset($_POST['sumbitbnt'])) {
    $search = $_POST['searchitem'];
    $sql = "SELECT * FROM book
    WHERE isbn LIKE'%$search%' or author LIKE'%$search%' or title LIKE'%$search%'; ";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>Title: ".$row['title']."</p>
                <p>Author: ".$row['author']."</p>
                <p>ISBN: ".$row['isbn']."</p>
                <a href='admin.book.php?pages=delbook&isbn=".$row['isbn']."'>
                Delete
                </a>
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
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>Title: ".$row['title']."</p>
                <p>Author: ".$row['author']."</p>
                <p>ISBN: ".$row['isbn']."</p>
                <a href='admin.book.php?pages=delbook&isbn=".$row['isbn']."'>
                Delete
                </a>
              </div>
            </div>
          </div>";
      }
    }
  }
  if (isset($_GET['isbn']))
  {
    $isbn = $_GET['isbn'];
    $sql = "DELETE from book
    where isbn = $isbn";

    if($conn->query($sql) == true) {
      echo "delete sucessful!";
    }
    else {
      echo "delete failed!";
    }
  }
}


function bookmanagement()
{
  global $conn;
  if(isset($_GET['pages'])) {
    $page = $_GET['pages'];
    if ($page == 'addbook') {
      addbook();
    }
    else if ($page == 'editbook') {
      editbook();
    }
    else if ($page == 'delbook') {
      delbook();
    }

  }
  else {
    addbook();
  }
}
