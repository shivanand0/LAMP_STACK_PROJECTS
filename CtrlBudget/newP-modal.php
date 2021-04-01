<div class="modal fade" id="newP" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color: #ccff33;">
        <!-- <h5 class="modal-title" id="staticBackdropLabel">Add New Plan</h5> -->
        <div class="modal-title tnew" id="staticBackdropLabel"> <h5 class="card-header" style="border-left: 2px solid #cc3399; border-bottom: 2px solid #603F83FF;">Create New Plan</h5> 
          </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="container">
      

            <form method="post" action="planD.php">

            <div class="form-group">
              <label for="inputBudget">Initial Budget</label>
              <input type="number" class="form-control" id="inputBudget" min="0" placeholder="Initial Budget Ex.5000" name="ibudget" required>
              </div>

            <div class="form-group">
              <label for="inpurPeo">How many people you want to add at your budget?</label>
              <input type="number" class="form-control" id="inputPeo" min="1" placeholder="No. of people" name="np_peo" required>
            </div>
            
            <button type="submit" class="btn btn-warning btn-block" name="p-btn">Next</button>

          </form>

          </div>
        </div>
   

      
    </div>
  </div>
</div>