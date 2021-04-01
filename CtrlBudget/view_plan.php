<?php
require '$con.php';
include 'boot-links.php';
include 'cpw-modal.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>View Plan | CT₹L Budget</title>



  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap');

    body,
    html {
      background-color: lightblue;
    }

    .card1 {
      margin-top: 100px;
      margin-left: 40px;
      width: 45%;
    }

    .excard {
      width: 18rem;
      margin: 10px 0 50px 50px;
    }

    .select {

      width: 200px;
      padding: 8px 12px;
      margin-bottom: 10px;
      color: #333;
      background-color: #eee;
      border: 1px solid #ddd;
      cursor: pointer;
      border-radius: 5px;
    }

    .jumbotron {
      width: 600px !important;
      float: right !important;
      margin: 120px 50px 0 0;
    }

    .ex {
      float: right !important;
      margin-top: 0;
    }

    .modal-header {
      margin-top: 60px !important;
      /*margin-bottom: 60px;*/
    }

    .yex {
      padding: 20px;
      font-family: 'Quicksand', sans-serif;
      border-bottom: 3px solid #fff;
      border-top: 3px solid #fff;
    }

    /*Media Queries*/
    @media(max-width: 1200px) {
      .jumbotron {
        width: 500px !important;
        float: right !important;
        margin: 100px 50px 50px 0;
      }

      .excard {
        width: 18rem;
        margin: 10px 0 80px 70px;
      }
    }

    @media(max-width: 1000px) {
      .jumbotron {
        width: 100% !important;
        display: block;
        margin: 100px 0px 20px 50px !important;
      }

      .card1 {
        margin-top: 100px;
        margin-left: 10%;
        margin-right: 0px;
        width: 80%;
      }

      .excard {
        width: 18rem;
        margin: 10px 0 80px 40px;
      }
    }

    @media(max-width: 955px) {
      .excard {
        width: 20rem;
        margin: 10px 0 80px 110px;
      }
    }

    @media(max-width: 830px) {
      .excard {
        width: 18rem;
        margin: 10px 0 80px 60px;
      }
    }

    @media(max-width: 550px) {
      .jumbotron {
        width: 100% !important;
        display: block;
        margin: 100px 0px 20px 50px !important;
      }

      .card1 {
        margin-top: 100px;
        margin-left: 0;

        width: 100%;
      }

      .excard {
        width: 15rem;
        margin: 10px 0 80px 40px;
      }
    }

    @media(max-width: 450px) {
      .excard {
        width: 80%;
        margin: 20px 0 80px 40px;
      }

    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>

  <!-- after clicking view plan of a plan on home.php page this card will show summary of plan in view_plan.php page including budget, date & remaning amount i.e total-expenses-budget -->

  <?php

  if (isset($_POST['vp-btn'])) {
    $select = "SELECT title, people, budget, start_date, end_date FROM plan_details WHERE pd_id=$_POST[pid]";
    $selectrun = mysqli_query($con, $select) or die(mysqli_error($con));
    $row = mysqli_fetch_array($selectrun);

    $npeo = $row['people']; //no. of people in plan

  ?>
    <?php

    $today = date("Y-m-d"); //todays date
    $today_time = strtotime($today);

    $end_bud = $row['end_date']; //budget end date
    $end_bud_time = strtotime($end_bud);
    //compare todays time-date and budget ends time-date if today>end then we can't add new expenses

    ?>
    <div style="background-color: pink; padding: 2rem;">

      <!-- Add Expenses -->
      <div class="jumbotron">


        <div class="text-center">
          <?php
          if ($today_time > $end_bud_time) //if plans budget is expired then can't add expenses
          { ?>

            <h5>Your plan is expired on <?php echo $row['end_date']; ?></h5>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addEx" aria-expanded="false" aria-controls="collapseExample" disabled>
              <h6>Add New Expense</h6>
            </button>
          <?php } else { ?>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addEx" aria-expanded="false" aria-controls="collapseExample">
              <h6>Add New Expense</h6>
            </button>
          <?php } ?>
        </div>
        <!-- Add expenses form -->
        <div class="collapse" id="addEx">
          <div class="card card-body">
            <form action="addex.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="extitle">Title</label>
                <input type="text" name="extitle" class="form-control" id="extitle" placeholder="Ex.Food" required>
              </div>

              <div class="form-group">
                <label for="exdate">Date</label>
                <input type="date" min="<?php echo $row['start_date']; ?>" max="<?php echo $row['end_date']; ?>" name="exdate" class="form-control" id="exdate" required>
              </div>

              <div class="form-group">
                <label for="amount">Amount Spent</label>
                <input type="number" name="amnt" class="form-control" id="amount" placeholder="Ex.200" required>
              </div>


              <div class="form-group">
                <select class="select" name="person" required>

                  <!-- <option disabled selected>choose</option> -->
                  <?php
                  // select query for selecting from dropdown who spent 
                  $selectp = "SELECT persons FROM people_in_plan WHERE pd_id=$_POST[pid]";
                  $selectp_run = mysqli_query($con, $selectp);

                  for ($i = 0; $npeo > $i; $i++) {
                    while ($rowp = mysqli_fetch_assoc($selectp_run)) {
                      $person = $rowp['persons'];
                  ?>

                      <option value="<?php echo $person; ?>"><?php echo $person; ?></option>

                  <?php }
                  }
                  ?>
                  <!-- input hidden method to pass plan id -->
                  <input type=hidden name=pid value="<?php echo $_POST['pid']; ?>">
                </select>
              </div>

              <!-- Bill upload -->
              <div class="form-group">
                <label id="bill">Upload Bill(optional)</label><br> <!-- this field is optional -->
                <input type="file" name="bill" id="bill">
              </div>

              <button type="submit" class="btn btn-primary btn-block">Add</button>

            </form>
          </div>
        </div>
      </div>
    <?php } ?>


    <!-- Plans Budget Summary -->
    <div class="card card1">
      <div class="card-header text-center" style="background-color: #00b3b3;">
        <h5><?php echo $row['title']; ?><i class="fa fa-user" style="margin-left: 8rem;"><?php echo $row['people']; ?></i></h5>
      </div>

      <div class="card-body">

        <p class="card-text"><strong>Budget: </strong>
          <i style="float: right;"><strong>₹</strong><?php echo $row['budget']; ?></i>
        </p>

        <?php
        $select_total = "SELECT SUM(amount_spent) AS total_spent FROM expenses WHERE pid=$_POST[pid]";
        $select_total_run = mysqli_query($con, $select_total) or die(mysqli_query($con));
        $row_total = mysqli_fetch_array($select_total_run);
        $remaining_amnt = $row['budget'] - $row_total['total_spent'];

        if ($remaining_amnt > 0) { ?>
          <p class="card-text"><strong>Remaining Amount: </strong>
            <i style="color: green; float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?></i>
          </p>
        <?php } elseif ($remaining_amnt < 0) { ?>
          <p class="card-text"><strong>Remaining Amount: </strong>
            <i style="color: red; float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?></i>
          </p>
        <?php } else { ?>

          <p class="card-text"><strong>Remaining Amount: </strong>
            <i style="float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?>
          </p>
        <?php } ?>

        <p class="card-text"><strong>Date: </strong>
          <i style="float: right;"><?php echo $row['start_date']; ?> to <?php echo $row['end_date']; ?></i>
        </p>

        <!-- Button to trigger expense distribution modal -->
        <button type="button" class="btn btn-block btn-warning" style="background-color: ; color:;" data-toggle="modal" data-target="#expenseModal">
          Expense Distribution
        </button>
      </div>
    </div>

    </div>



    <!-- Show expenses summary bill -->
    <div class="container text-center yex" style="background-color: #078282FF;">
      <h5 style="color: #fff;">Your Expenses</h5>
    </div>

    <div class="row">
      <?php
      $selectex = "SELECT extitle, exdate, amount_spent, spent_by, bill FROM expenses WHERE pid=$_POST[pid]";

      $selectex_run = mysqli_query($con, $selectex) or die(mysqli_error($con));

      while ($rowex = mysqli_fetch_array($selectex_run)) { ?>
        <div class="card excard">

          <h5 class="card-header text-center" style="background-color: #00e6e6;"><?php echo $rowex['extitle']; ?></h5>

          <div class="card-body">
            <p class="card-text"><strong>Amount: </strong>
              <i style="float: right;"><strong>₹</strong><?php echo $rowex['amount_spent']; ?> </i>
            </p>

            <p class="card-text"><strong>Paid By: </strong>
              <i style="float: right;"><?php echo $rowex['spent_by']; ?></i>
            </p>

            <p class="card-text"><strong>Paid On: </strong>
              <i style="float: right;"><strong>₹</strong><?php echo $rowex['exdate']; ?></i>
            </p>

          </div>

          <div class="card-footer text-center">

            <!-- uploaded bill  -->
            <?php
            if ($rowex['bill']) //if bill is uploaded then execute this 
            { ?>
              <button type="button" class="btn" data-toggle="collapse" href="#showBill" role="button" aria-expanded="false" aria-controls="collapseExample">
                Show Bill
              </button>
              <div class="collapse" id="showBill" data-toggle="modal" data-target="#zoomBill">
                <img height="auto" width="200px" src="bills/<?php echo $rowex['bill'];  ?>">
              </div>

              <!-- zoom bill modal -->
              <div class="modal fade mt-0" id="zoomBill" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">

                    <img height="auto" width="300px" src="bills/<?php echo $rowex['bill'];  ?>">
                       
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } else { ?>
                <p class="card-text">You Don't have bill!</p>
              <?php } ?>

              </div>
          </div>
        <?php } ?>

        </div>




        <!-- expense distribution modal -->
        <?php include 'expense_modal.php'; ?>



    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>

    </div>
    </div>
    </div>


    <?php include 'footer.php'; ?>


</body>

</html>