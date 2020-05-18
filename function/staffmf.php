<?php
function addstaff()
{
  global $conn;
  echo "
  <div class=''>
    <h2 style='align: center;'>Add New Staff</h2>
    <form method='post'>
      <div class='form-group'>
        <label for='staffid'>StaffID</label>
        <input type='text' class='form-control' id='staffid' name='add_sstaffid' placeholder='staffid..'>
      </div>
      <div class='form-group'>
        <label for='firstname'>Firstname</label>
        <input type='text' class='form-control' id='firstname' name='add_sfirstname' placeholder='firstname..'>
      </div>
      <div class='form-group'>
        <label for='lastname'>Lastname</label>
        <input type='text' class='form-control' id='lastname' name='add_slastname' placeholder='lastname..'>
      </div>
      <div class='form-group'>
        <label for='jobtitle'>Jobtitle</label>
        <input type='text' class='form-control' id='jobtitle' name='add_sjobtitle' placeholder='jobtitle..'>
      </div>
      <div class='form-group'>
        <label for='econtact'>Emergency Contact</label>
        <input type='text' class='form-control' id='contact' name='add_secontact' placeholder='emergency contact..'>
      </div>
      <div class='form-group'>
        <label for='contact'>Contact</label>
        <input type='text' class='form-control' id='contact' name='add_scontact' placeholder='contact..'>
      </div>
      <div class='form-group'>
        <label for='branchid'>BranchID</label>
        <input type='text' class='form-control' id='branchid' name='add_sbranchid' placeholder='branchid..'>
      </div>
      <button type='submit' name='add_sumbit' class='btn btn-warning btn-block'>Add</button>
      </form>
    </div>";
    if (isset($_POST['add_sumbit'])) {
      $firstname = $_POST['add_sfirstname'];
      $lastname = $_POST['add_slastname'];
      $contact = $_POST['add_scontact'];
      $econtact = $_POST['add_secontact'];
      $jobtitle = $_POST['add_sjobtitle'];
      $staffid = $_POST['add_sstaffid'];
      $branchid = $_POST['add_sbranchid'];

      $sql = "INSERT INTO staff
      (staffID, firstname, lastname, jobtitle, emergencycontact, contact, branchID)
      VALUES('$staffid', '$firstname', '$lastname', '$jobtitle', '$econtact', '$contact', '$branchid')";
      if($conn->query($sql) == true) {
        echo "Add Sucessful!";
      }
      else {
        echo "Add Failed!".$conn->error;
      }

    }
}

function editstaff()
{

  global $conn;
  if (!isset($_GET['staffID'])) {
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
      $sql = "SELECT * FROM staff
      WHERE firstname LIKE'%$search%' or lastname LIKE'%$search%'
      or memberID LIKE'%$search%' or jobtitle LIKE'%$search%' or branchID LIKE'%$search%'; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>StaffID: ".$row['StaffID']."</p>
                  <p>Jobtitle: ".$row['JobTitle']."</p>
                  <p>Name: ".$row['FirstName']." ".$row['LastName']."</p>
                  <a href='admin.staff.php?pages=editstaff&staffID=".$row['StaffID']."'>
                  Edit
                  </a>
                </div>
              </div>
            </div>";
        }
      }
    }
    else {
      $sql = "SELECT * FROM staff; ";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='reccolumn' stype='margin-bottom: 10px'>
              <div class='card'>
                <div class='container'>
                  <p>StaffID: ".$row['StaffID']."</p>
                  <p>Jobtitle: ".$row['JobTitle']."</p>
                  <p>Name: ".$row['FirstName']." ".$row['LastName']."</p>
                  <a href='admin.staff.php?pages=editstaff&staffID=".$row['StaffID']."'>
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
    $staffid = $_GET['staffID'];
    $sql = "SELECT * FROM staff WHERE staffID = $staffid; ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $contact = $row['Contact'];
    $jobtitle = $row['JobTitle'];
    $econtact = $row['EmergencyContact'];
    $branchid = $row['BranchID'];
    $staffid = $row['StaffID'];
    echo "
    <div class=''>
      <h2 style='align: center;'>Edit Staff</h2>
      <form method='post'>
        <div class='form-group'>
          <label for='staffid'>StaffID</label>
          <input type='text' class='form-control' id='staffid' name='edit_sstaffid' value='$staffid'
          placeholder='staffid..'>
        </div>
        <div class='form-group'>
          <label for='firstname'>Firstname</label>
          <input type='text' class='form-control' id='firstname' name='edit_sfirstname' value='$firstname'
          placeholder='firstname..'>
        </div>
        <div class='form-group'>
          <label for='lastname'>Lastname</label>
          <input type='text' class='form-control' id='lastname' name='edit_slastname' value='$lastname'
          placeholder='lastname..'>
        </div>
        <div class='form-group'>
          <label for='jobtitle'>Jobtitle</label>
          <input type='text' class='form-control' id='jobtitle' name='edit_sjobtitle' value='$jobtitle'
          placeholder='jobtitle..'>
        </div>
        <div class='form-group'>
          <label for='econtact'>Emergency Contact</label>
          <input type='text' class='form-control' id='contact' name='edit_secontact' value='$econtact'
          placeholder='emergency contact..'>
        </div>
        <div class='form-group'>
          <label for='contact'>Contact</label>
          <input type='text' class='form-control' id='contact' name='edit_scontact' value='$contact'
          placeholder='contact..'>
        </div>
        <div class='form-group'>
          <label for='branchid'>BranchID</label>
          <input type='text' class='form-control' id='branchid' name='edit_sbranchid' value='$branchid'
          placeholder='branchid..'>
        </div>
        <button type='submit' name='sumbit_edit' class='btn btn-warning btn-block'>Edit</button>
      </form>
      </div>";
      if (isset($_POST['sumbit_edit'])) {
        $firstname = $_POST['edit_sfirstname'];
        $lastname = $_POST['edit_slastname'];
        $contact = $_POST['edit_secontact'];
        $econtact = $_POST['edit_scontact'];
        $branchid = $_POST['edit_sbranchid'];
        $jobtitle = $_POST['edit_sjobtitle'];
        $staffid = $_POST['edit_sstaffid'];


        $sql = "UPDATE staff
        set
        firstname = '$firstname',
        lastname = '$lastname',
        contact = '$contact',
        emergencycontact = '$econtact',
        jobtitle = '$jobtitle',
        branchID = '$branchid',
        staffID = '$staffid'
        where staffID = $staffid";

        if($conn->query($sql) == true) {
          echo "Edit Sucessful!";
        }
        else {
          echo "Edit Failed!".$conn->error;
        }
      }
  }
}
//******************
function delstaff()
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
    $sql = "SELECT * FROM staff
    WHERE firstname LIKE'%$search%' or lastname LIKE'%$search%'
    or memberID LIKE'%$search%' or jobtitle LIKE'%$search%' or branchID LIKE'%$search%'; ";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>StaffID: ".$row['StaffID']."</p>
                <p>Jobtitle: ".$row['JobTitle']."</p>
                <p>Name: ".$row['FirstName']." ".$row['LastName']."</p>
                <a href='admin.staff.php?pages=delstaff&staffID=".$row['StaffID']."'>
                Delete
                </a>
              </div>
            </div>
          </div>";
      }
    }
  }
  else {
    $sql = "SELECT * FROM staff; ";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<div class='reccolumn' stype='margin-bottom: 10px'>
            <div class='card'>
              <div class='container'>
                <p>StaffID: ".$row['StaffID']."</p>
                <p>Jobtitle: ".$row['JobTitle']."</p>
                <p>Name: ".$row['FirstName']." ".$row['LastName']."</p>
                <a href='admin.staff.php?pages=delstaff&staffID=".$row['StaffID']."'>
                Delete
                </a>
              </div>
            </div>
          </div>";
      }
    }
  }
  if (isset($_GET['staffID']))
  {
    $staffid = $_GET['staffID'];
    $sql = "DELETE from staff
    where staffID = $staffid;";

    if($conn->query($sql) == true) {
      echo "Delete Sucessful!";
    }
    else {
      echo "Delete Failed!";
    }
  }
}

function staffmanagement()
{
  global $conn;
  if(isset($_GET['pages'])) {
    $page = $_GET['pages'];
    if ($page == 'addstaff') {
      addstaff();
    }
    else if ($page == 'editstaff') {
      editstaff();
    }
    else if ($page == 'delstaff') {
      delstaff();
    }
  }
  else {
    addstaff();
  }
}
