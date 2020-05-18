<?php
function addmember()
{
  global $conn;
  echo "
  <div class=''>
    <h2 style='align: center;'>Add New Member</h2>
    <form method='post'>
      <div class='form-group'>
        <label for='firstname'>Firstname</label>
        <input type='text' class='form-control' id='firstname' name='add_mfirstname' placeholder='firstname..'>
      </div>
      <div class='form-group'>
        <label for='lastname'>Lastname</label>
        <input type='text' class='form-control' id='lastname' name='add_mlastname' placeholder='lastname..'>
      </div>
      <div class='form-group'>
        <label for='contact'>Contact</label>
        <input type='text' class='form-control' id='contact' name='add_mcontact' placeholder='contact..'>
      </div>
      <div class='form-group'>
        <label for='email'>Email</label>
        <input type='text' class='form-control' id='email' name='add_memail' placeholder='email..'>
      </div>
      <div class='form-group'>
        <label for='address'>Address</label>
        <input type='text' class='form-control' id='address' name='add_maddress' placeholder='address..'>
      </div>
      <div class='form-group'>
        <label for='username'>Username</label>
        <input type='text' class='form-control' id='username' name='add_musername' placeholder='username..'>
      </div>
      <div class='form-group'>
        <label for='password'>Password</label>
        <input type='text' class='form-control' id='password' name='add_mpassword' placeholder='password..'>
      </div>
      <button type='submit' name='sumbit_add' class='btn btn-warning btn-block'>Add</button>
      </form>
    </div>";
    if (isset($_POST['sumbit_add'])) {
      $firstname = $_POST['add_mfirstname'];
      $lastname = $_POST['add_mlastname'];
      $contact = $_POST['add_mcontact'];
      $email = $_POST['add_memail'];
      $address = $_POST['add_maddress'];
      $username = $_POST['add_musername'];
      $password = $_POST['add_mpassword'];

      $sql = "INSERT INTO member
      (firstname, lastname, contact, email, address, username, password)
      VALUES('$firstname', '$lastname', '$contact', '$email', '$address', '$username', '$password')";
      if($conn->query($sql) == true) {
        echo "Add Sucessful!";
      }
      else {
        echo "Add Failed!".$conn->error;
      }

    }
}

function editmember()
{

  global $conn;
  if (!isset($_GET['memberID'])) {
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
      $sql = "SELECT * FROM member
      WHERE firstname LIKE'%$search%' or lastname LIKE'%$search%'
      or memberID LIKE'%$search%' or username LIKE'%$search%'; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>MemberID: ".$row['memberID']."</p>
                  <p>Username: ".$row['username']."</p>
                  <p>Name: ".$row['firstname']." ".$row['lastname']."</p>
                  <a href='admin.member.php?pages=editmember&memberID=".$row['memberID']."'>
                  Edit
                  </a>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {
      $sql = "SELECT * FROM member; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>MemberID: ".$row['memberID']."</p>
                  <p>Username: ".$row['username']."</p>
                  <p>Name: ".$row['firstname']." ".$row['lastname']."</p>
                  <a href='admin.member.php?pages=editmember&memberID=".$row['memberID']."'>
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
    $memberid = $_GET['memberID'];
    $sql = "SELECT * FROM member WHERE memberID = $memberid; ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $contact = $row['contact'];
    $email = $row['email'];
    $address = $row['address'];
    $username = $row['username'];
    $password = $row['password'];
    echo "
    <div class=''>
      <h2 style='align: center;'>Edit Member</h2>
      <form method='post'>
        <div class='form-group'>
          <label for='firstname'>Firstname</label>
          <input type='text' class='form-control' id='firstname' name='edit_mfirstname' value='$firstname'
           placeholder='firstname..'>
        </div>
        <div class='form-group'>
          <label for='lastname'>Lastname</label>
          <input type='text' class='form-control' id='lastname' name='edit_mlastname' value='$lastname'
           placeholder='lastname..'>
        </div>
        <div class='form-group'>
          <label for='contact'>Contact</label>
          <input type='text' class='form-control' id='contact' name='edit_mcontact' value='$contact'
           placeholder='contact..'>
        </div>
        <div class='form-group'>
          <label for='email'>Email</label>
          <input type='text' class='form-control' id='email' name='edit_memail' value='$email'
           placeholder='email..'>
        </div>
        <div class='form-group'>
          <label for='address'>Address</label>
          <input type='text' class='form-control' id='address' name='edit_maddress' value='$address'
           placeholder='address..'>
        </div>
        <div class='form-group'>
          <label for='username'>Username</label>
          <input type='text' class='form-control' id='username' name='edit_musername' value='$username'
           placeholder='username..'>
        </div>
        <div class='form-group'>
          <label for='password'>Password</label>
          <input type='text' class='form-control' id='password' name='edit_mpassword' value='$password'
           placeholder='password..'>
        </div>
        <button type='submit' name='sumbit_edit' class='btn btn-warning btn-block'>Edit</button>
      </form>
      </div>";
      if (isset($_POST['sumbit_edit'])) {
        $firstname = $_POST['edit_mfirstname'];
        $lastname = $_POST['edit_mlastname'];
        $contact = $_POST['edit_mcontact'];
        $email = $_POST['edit_memail'];
        $address = $_POST['edit_maddress'];
        $username = $_POST['edit_musername'];
        $password = $_POST['edit_mpassword'];

        $sql = "UPDATE member
        set
        firstname = '$firstname',
        lastname = '$lastname',
        contact = '$contact',
        email = '$email',
        address = '$address',
        username = '$username',
        password = '$password'
        where memberID = $memberid";

        if($conn->query($sql) == true) {
          echo "Edit Sucessful!";
        }
        else {
          echo "Edit Failed!";
        }
      }
  }
}
//******************
function delmember()
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
    $sql = "SELECT * FROM member
    WHERE firstname LIKE'%$search%' or lastname LIKE'%$search%'
    or memberID LIKE'%$search%' or username LIKE'%$search%'; ";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>MemberID: ".$row['memberID']."</p>
                <p>Username: ".$row['username']."</p>
                <p>Name: ".$row['firstname']." ".$row['lastname']."</p>
                <a href='admin.member.php?pages=delmember&memberID=".$row['memberID']."'>
                Delete
                </a>
              </div>
            </div>
          </div>";
      }
    }
  }
  else {
    $sql = "SELECT * FROM member; ";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>MemberID: ".$row['memberID']."</p>
                <p>Username: ".$row['username']."</p>
                <p>Name: ".$row['firstname']." ".$row['lastname']."</p>
                <a href='admin.member.php?pages=delmember&memberID=".$row['memberID']."'>
                Delete
                </a>
              </div>
            </div>
          </div>";
      }
    }
  }
  if (isset($_GET['memberID']))
  {
    $memberid = $_GET['memberID'];
    $sql = "DELETE from member
    where memberID = $memberid;";

    if($conn->query($sql) == true) {
      echo "Delete Sucessful!";
    }
    else {
      echo "Delete Failed!";
    }
  }
}

function membermanagement()
{
  global $conn;
  if(isset($_GET['pages'])) {
    $page = $_GET['pages'];
    if ($page == 'addmember') {
      addmember();
    }
    else if ($page == 'editmember') {
      editmember();
    }
    else if ($page == 'delmember') {
      delmember();
    }
  }
  else {
    addmember();
  }
}
