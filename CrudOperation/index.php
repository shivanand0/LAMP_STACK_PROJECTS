<?php
require '$con.php';
$Insert = 0;
$Update = 0;
$Delete = 0;
// echo var_dump($_POST);

// Delete script
if(isset($_GET['delete']))
{
    $sNo = $_GET['delete'];
    $Delete = 1;

    $delete_query = "DELETE FROM `notes` WHERE `notes`.`id` = $sNo";
    $delete_query_result = mysqli_query($con, $delete_query) or die(mysqli_error($con));

    // header('Location: index.php');
}

//   Edit script
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['sNoEdit']))
    {
        //update the record
        $sNo = $_POST['sNoEdit'];

        $title = $_POST['titleEdit'];
        $title = mysqli_real_escape_string($con, $title);

        $description = $_POST['descriptionEdit'];
        $description = mysqli_real_escape_string($con, $description);
    
        $update_query = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`id` = $sNo;";
        $update_query_result = mysqli_query($con, $update_query) or die(mysqli_error($con));

        if($update_query_result)
        {
            $Update = 1;
        }
        
    }
    else
    {
        
        //Insert record
        $title = $_POST['title'];
        $title = mysqli_real_escape_string($con, $title);

        $description = $_POST['description'];
        $description = mysqli_real_escape_string($con, $description);

        $insert_query = "INSERT INTO notes (title, description) VALUES ('$title', '$description')";
        $insert_query_result = mysqli_query($con, $insert_query) or die(mysqli_error($con));
        
        if($insert_query_result)
        {
            $Insert = 1;
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Datatables.net -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <title>My Notes || Taking Notes made easy ;)</title>

    <style>

    </style>
</head>

<body>
    <!-- NavbarS -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            My Notes <i class="fa fa-pen-fancy"></i>
        </a>
        <span class="navbar-text">
            <?php 
          date_default_timezone_set("Asia/Calcutta");
          echo '<i class="fa fa-calendar-day"></i> '.date("d/m/Y")."<br>"; 
          echo '<i class="fa fa-clock"></i> '.date("h:ia");
      ?>
        </span>
    </nav>
    <!-- NavbarE -->
    <?php
      //if record is inserted then show this alert
      if($Insert)
      {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your note has been inserted successfully ^_^.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>';
      }

      if($Update)
      {
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your note has been updated successfully ^_^.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>';
      }

      if($Delete)
      {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your note has been deleted successfully ^_^.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>';
      }
    ?>

    <!-- Dismissible alert -->
    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hello User ^_^</strong> Create your notes, update it , read it, delete it all in one WebApp ;)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->

    <div class="container">
        <div class="jumbotron">
            <!-- Button trigger modal -->
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addNoteModal">
                    Add note
                </button>
            </div>

            <!-- Add note Modal -->
            <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addNoteModalLabel">Add new note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="index.php">
                                <div class="form-group">
                                    <label for="title">Note title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Note description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        aria-label="With textarea" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Add</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <table class="table table-bordered table-striped" id="myTable">
            <thead class="thead-dark ">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Created on</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $select_query = "SELECT * FROM `notes`";
                $run_query = mysqli_query($con, $select_query)
                    or die(mysqli_error($con));
                $sNo = 0;

              while($row = mysqli_fetch_assoc($run_query))
              {
                $sNo = $sNo + 1;
                ?>
                <tr>
                    <th scope="row"><?php echo $sNo; ?></th>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['time_stamp']; ?></td>
                    <td>
                        <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#editModal" id="edit">Edit</button> -->
                        <button type="button" class="edit btn btn-outline-primary"
                            id="<?php echo $row['id']; ?>">Edit</button> <!-- in script e.target.id = $row['id']; -->
                        <button type="button" class="delete btn btn-outline-danger"
                            id="d<?php echo $row['id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Edit modal -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add new note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php">

                        <input type="hidden" name="sNoEdit" id="sNoEdit">
                        <!-- hidden input type for getting id of clicked rows button -->

                        <div class="form-group">
                            <label for="title">Note title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                        </div>
                        <div class="form-group">
                            <label for="description">Note description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                aria-label="With textarea"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>


    <!-- Datables: jquery & script -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"> //2nd jquery
        </script> -->
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <!-- JS -->
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", e.target.parentNode.parentNode);

                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText; //0th index title 
                description = tr.getElementsByTagName("td")[1].innerText; //1st indec description
                //got title & description of clicked button
                console.log(title);
                console.log(description);

                titleEdit.value = title;
                descriptionEdit.value = description;

                sNoEdit.value = e.target.id; //name = sNoEdit; e.target.id = $row[id] on line 156; line 179: hidden input for sNoEdit
                console.log(e.target.id);

                $('#editModal').modal();
            })
        })

        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete ", e.target.parentNode.parentNode);

                sNo = e.target.id.substr(1,);
                console.log(sNo);
                //The substr() method extracts parts of a string, beginning at the character at the specified position, and returns the specified number of characters.
                //var str = "Hello world!";
                // var res = str.substr(1, 4); op: ello

                if (confirm("Are you sure you want to delete this note?")) {
                    console.log("yes");
                    window.location = "index.php?delete=" + sNo;
                    //create form and use post req to submit to aavoid hacking attacks
                }
                else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>