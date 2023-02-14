<?php

//INSERT INTO `notes` (`Sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy book', 'please buy book from store.', current_timestamp());
$insert = false;
$update = false;
$delete = false;

// connect to the databse
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $database = "notes";
 
    // create a connecton object
    $conn = mysqli_connect($serverName,$username,$password,$database);
 
    //Die if check Server  connection  succesfull or not
    if(!$conn){
    die("sorry we failed to connect ". mysqli_connect_error());
    }
    
    
    // exit();

    if(isset($_GET['delete'])){
      $Sno = $_GET['delete'];
     $delete = true;
      $sql = "DELETE FROM `notes` WHERE `notes`.`Sno` ='$Sno'";
      $result = mysqli_query($conn,$sql);
    }
   

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['SnoEdit'])){
        //update the record
        $Sno = $_POST["SnoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
  
  
        //create a record in table on DB in php
  
      $sql ="UPDATE `notes` SET `title` = '$title' ,   `description` = '$description' WHERE `notes`.`Sno` = $Sno";
      $result = mysqli_query($conn, $sql);
      if($result){
       $update = true;
    }
    else{
        echo "the record was not inserted successfully". mysqli_error($conn);
    }
        
      }
      else{

   
      $title = $_POST["title"];
      $description = $_POST["description"];


      //create a record in table on DB in php

    $sql ="INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);

    //Add a new record to the php_my table in the database
    if($result){
    // echo "the record has been inserted  successfully";
    $insert = true;
    }
    else{
        echo "the record was not inserted successfully". mysqli_error($conn);
    }
    }


     }
   

       

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
   
  

    <title>iNotes - Notes taking made easy</title>
  </head>
  <body>
    <!-- Edit modal -->


<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Notes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="/CRUD/index.php/" method="post">
      <div class="modal-body">
        <input type="hidden" name="SnoEdit" id="SnoEdit">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input
            type="text"
            class="form-control"
            name="titleEdit"
            id="titleEdit"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>

          <textarea
            class="form-control"
            name="descriptionEdit"
            placeholder="Given some Description"
            id="descriptionEdit"
          ></textarea>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1"
            >Check me out</label
          >
        </div>
        
     
        
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="/CRUD/PHP.png" height="26px" alt=""></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Conatct us</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a
                class="nav-link disabled"
                href="#"
                tabindex="-1"
                aria-disabled="true"
                >Disabled</a
              >
            </li>
          </ul>
          <form class="d-flex">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>


    <?php
    if($insert){
      echo "<div class='alert alert-success alert-success fade show' role='alert'>
      <strong>Success!</strong> Your record has been inserted successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }

    ?>

    <?php
    if($delete){
      echo "<div class='alert alert-success alert-success fade show' role='alert'>
      <strong>Success!</strong> Your record has been deleted successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }

    ?>

   <?php
    if($update){
      echo "<div class='alert alert-success alert-success fade show' role='alert'>
      <strong>Success!</strong> Your record has been ]updated successfully.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }

    ?>


    <div class="container my-4">
      <h2>Add a Note to iNotes</h2>
      <form action="/CRUD/index.php/" method="post">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input
            type="text"
            class="form-control"
            name="title"
            id="title"
            aria-describedby="emailHelp"
          />
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>

          <textarea
            class="form-control"
            name="description"
            placeholder="Given some Description"
            id="description"
          ></textarea>
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1"
            >Check me out</label
          >
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="container my-5">
     
        
   
      <table class="table" id = "myTable">
        <thead>
          <tr>
            <th scope="col">S.no</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn,$sql);
        $Sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $Sno = $Sno + 1;
        echo "<tr>
        <th scope='row'>" . $Sno . "</th>
        <td>" . $row['title'] . "</td>
        <td>" . $row['description'] . "</td>
        <td>  <button class='edit btn btn-sm btn-primary' id=".$row['Sno'].">Edit</button>  <button class='delete btn btn-sm btn-primary'  id=".$row['Sno'].">Delete</button> </td>
      </tr>";
            
  }
        
    ?>

         
          
        </tbody>
       
      </table>
    </div>
    <hr>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
        } );
      </script>
        <script>
          edits = document.getElementsByClassName('edit');
          Array.from(edits).forEach((element)=>{
          element.addEventListener("click",(e)=>{
          console.log("edit ");
          tr = e.target.parentNode.parentNode;
          title = tr.getElementsByTagName("td")[0].innerText;
          description =  tr.getElementsByTagName("td")[1].innerText;
          console.log(title,description);
          descriptionEdit.value = description;
          titleEdit.value = title;
          SnoEdit.value = e.target.id;
          console.log(e.target.id);
          $('#editModal').modal('toggle'); //modal ko open karne ke liye hai
          
        })
      })

      deletes = document.getElementsByClassName('delete');
          Array.from(deletes).forEach((element)=>{
          element.addEventListener("click",(e)=>{
          console.log("edit",);
          Sno = e.target.id.substr();
          
          if(confirm("Are you sure  you want to delete this note!")){
            console.log("yes");
            window.location = `/CRUD/index.php?delete=${Sno}`;
            // create a form and use post request to submit a form
          
          }

          else{
            console.log("no");
          }
          
        })
      })
      </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
