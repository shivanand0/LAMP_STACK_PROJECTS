<!-- This is plan details page budegt & no. of people field are taken from new plan page we'll fetch that using select query-->
<?php 
	require '$con.php';
	include 'boot-links.php';
	include 'cpw-modal.php';

	if(!isset($_POST['p-btn'])) //if we didn't fill budget and no. of people fields in newP.php page and do not clicked button then we can't access this page
	  {
	  	header('location: newP.php'); //we'll redirect to home.php
	  } 


?>

<!DOCTYPE html>
<html>
  <head>
	<title>Plan Details | CT₹L Budget</title>

	<style type="text/css">
		body,html{
			background-color: transparent;
		}
		.footer{
			  position: fixed;
			  left: 0;
			  bottom: 0;
			  width: 100%;
		}
		.card{
			
			margin-top: 15% !important;
			margin-left: 23%;
			max-width: 50%;
			height: auto;
			margin-bottom: 100px;
		
		}
		@media(max-width: 800px)
		{
			.card{
				max-width: 80% !important;
				height: auto;
				margin-left: 9%;
			}
		}
		@media(max-width: 550px)
		{
			.card{
				max-width: 90% !important;
				height: auto;
				margin-left: 5%;
				margin-top: 20% !important;
				
			}
		}

		
		
		

		@media(max-width: 1200px)
		{
				.to{
				margin-left: 4rem;
			}
			.npeo{
				margin-left: 0;
				display: block;
			}
		}
		@media(max-width: 1060px)
		{
			.to{
				display: inline-block;
				margin-left: 0;
			}
		}

		@media(max-width: 400px)
		{
			#dateT{
				display: block;
			}
			#dateF{
				display: block;
			}
		}

		

	</style>
  </head>

  <body>
 
		<?php include 'header.php'; ?>
		
    <div class="card">
		  <div class="card-header text-center" style="background-color: #ccffcc;">
		    <strong>Plan Details</strong>
		  </div>

		 <div class="card-body">
	       <form method="post" action="planD_script.php">
			  <div class="form-group">
			    <label for="titleB">Title</label>
			    <input type="text" class="form-control" id="titleB" name="title" placeholder="Enter Title Ex.Trip to Kedarnath" required>
			  </div>
			  
			  <div class="form-group">
			    <label for="dateF" class="fo">From:  </label>
			    <input type="date" id="dateF" name="dateF" required>
		      </div>
		      <div class="form-group">
		        <label for="dateT" class="to">To:  </label>
		        <input type="date" id="dateT" name="dateT" required>
		       </div>
	   
		  
		  	
		  	
			    <div class="form-group">

					
					 <?php
					 	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					 	{
					 		//store entered values in variable
							$budget = $_POST['ibudget'];

							$np = $_POST['np_peo'];

							// get user id from sessio
							$user_id = $_SESSION['user_id']; //puser_id: plan user id in new_plan table
					 	
					 ?>
			      		<label for="ibudget">Initial Budget:</label><br>
				        <input id="ibudget" name="budgetd" type="number" style="width: 300px;" value="<?php echo $budget; ?>">
			      	    </div>
			      	    <div class="form-group">
			      	    <label for="npeo" class="npeo">No. of people:</label><br>
				        <input id="npeo" name="peopled" type="number" name="npeo" style="width: 300px;" value="<?php echo $np; ?>">

                 <?php  } ?>
				</div>

				<div class="form-group">

				    <?php
				    if(isset($_POST['p-btn']))
				    {
				    	$np = $_POST['np_peo']; //got no. of people entered in newP.php ?>
				    	<input type="hidden" name="np" value="<?php echo $np ?>"> <!-- hidden input field to pass no. of people to planD_script.php -->
				    <?php
				    	$pip=1;
				    	while($np!=0) 
				    	{  ?>
				    		<label for="people<?php echo $pip; ?>">Person<?php echo $pip; ?>:</label>
				            <input id="people<?php echo $pip; ?>" type="text" class="form-control" name="people[]" required>

				    	<?php $np=$np-1; 
				    	      $pip=$pip+1;
				    	}
				    }
				    ?>
			    
			    </div>
			  
			  
			  
			  	<button type="submit" class="btn btn-warning btn-block">Save</button>
	      </form>
		</div>
	</div>
				
				<?php include 'footer.php'; ?>
	
	
  </body>
</html>


