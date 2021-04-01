<!-- expense distribution modal -->
    
<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header" style="background-color: yellow;">
            <h5 class="modal-title" id="expenseModalLabel">
              <i class="far fa-dot-circle"></i><?php echo $row['title']; ?>
              <i class="fa fa-user" style="margin-left: 5rem;"><?php echo $row['people']; ?></i>
            </h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>

          <div class="modal-body">
          
          <?php
            // check if expenses are added in plan or not
            $select_ex = "SELECT pid FROM expenses WHERE pid=$_POST[pid]";
            $select_ex_run = mysqli_query($con, $select_ex);
            $rows_ex = mysqli_num_rows($select_ex_run);//if $rows_ex==0 then there are no expenses of plan id of tht user

          ?>

            <p><strong>Initial Budget: </strong>
              <i style="float: right;"><strong>₹</strong> <?php echo $row['budget']; ?></i>
            </p>

            <?php
              
              $select_peo = "SELECT persons FROM people_in_plan WHERE pd_id=$_POST[pid]";
              $select_peo_r = mysqli_query($con, $select_peo) or die(mysqli_error($con));
              
              while($row_peo = mysqli_fetch_array($select_peo_r))
              { 
                  $person = $row_peo['persons'];
                  $select_s = "SELECT SUM(amount_spent) AS amount_spent_sum FROM expenses WHERE spent_by='$person' && pid=$_POST[pid]";
                  $select_s_run = mysqli_query($con, $select_s) or die(mysqli_error($con));
                  $row_sum = mysqli_fetch_array($select_s_run);
                  $spent_sum = $row_sum['amount_spent_sum'];

                  if($rows_ex==0)
                    { ?>
                      <strong><?php echo $person; ?>: </strong><i style="float: right;"><strong>₹</strong>0</i><br><br>
              <?php }
                  else
                  { ?>
                    <p>
                      <strong><?php echo $person; ?>: </strong>
                      <i style="float: right;"><strong>₹</strong><?php echo $spent_sum; ?></i>
                    </p>
            <?php } 
              }
            ?>

            <?php
             $select_total = "SELECT SUM(amount_spent) AS total_spent FROM expenses WHERE pid=$_POST[pid]";
             $select_total_run = mysqli_query($con, $select_total) or die(mysqli_query($con));
             $row_total = mysqli_fetch_array($select_total_run);
            

            if($rows_ex==0)
                { ?>
                    <strong>Total Amount Spent: ₹</strong>0<br><br>
          <?php }
                  else
                { ?>
                    <p><strong>Total Amount Spent: </strong>
                      <i style="float: right;"><strong>₹</strong><?php echo $row_total['total_spent']; ?></i>
                    </p>
          <?php }

              $remaining_amnt = $row['budget'] - $row_total['total_spent'];

               if ($remaining_amnt>0) 
                { ?>
                  <p class="card-text"><strong>Remaining Amount: </strong>
                    <i style="color: green; float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?></i>
                  </p>
          <?php }
              elseif ($remaining_amnt<0) 
                { ?>
                  <p class="card-text"><strong>Remaining Amount: </strong><i style="color: red; float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?></i>
                  </p>
          <?php }
                else
                {
              ?>
            <p class="card-text"><strong>Remaining Amount: </strong>
              <i style="float: right;"><strong>₹</strong><?php echo $remaining_amnt; ?></i>
            </p>
          <?php } ?>
                
            

            <?php
              $ishares = $row_total['total_spent'] / $npeo;
            ?>
            <p class="card-text"><strong>Indivisual Share: </strong>
              <i style="float: right;"><strong>₹</strong><?php echo $ishares; ?></i>
            </p>
            
            

            <?php 
              $np = $row['people'];
              $select_peo = "SELECT persons FROM people_in_plan WHERE pd_id=$_POST[pid]";
              $select_peo_r = mysqli_query($con, $select_peo) or die(mysqli_error($con));


              while($row_peo = mysqli_fetch_array($select_peo_r))
                { 
                  $personn = $row_peo['persons'];
                  
                  $select_share = "SELECT SUM(amount_spent) AS spent FROM expenses WHERE spent_by='$personn' AND pid='$_POST[pid]'";
                  $select_share_run = mysqli_query($con, $select_share) or die(mysqli_error($con));
                  $row_spent = mysqli_fetch_array($select_share_run);
                  $spent = $row_spent['spent'] - $ishares;

            

                  if ($spent>0) 
                  { ?>
                    <p><strong><?php echo $personn ?>: </strong>
                      <i style="color: green; float: right;">Gets back <bold>₹</bold><?php echo $spent; ?></i>
                    </p>
            <?php }

                  elseif ($spent<0) 
                  { ?>
                    <p><strong><?php echo $personn ?>: </strong>
                      <i style="color: red; float: right;">
                        Owes <bold>₹</bold><?php echo $spent; ?>
                    </i>
                    </p>
            <?php }

                  else
                  { ?>
                    <p><strong><?php echo $personn ?>: </strong>
                      <i style="float: right;">All Settled Up</i>
                    </p>
            <?php } ?>

          <?php } ?>
            
            
          


