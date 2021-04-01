
<?php 
	require '$con.php';
	include 'boot-links.php';
    include 'cpw-modal.php';
    include 'newP-modal.php';
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

		
		@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap');


		body, html{
			background-color: transparent !important;
		}
		.navbar-text{
			margin-left: 20rem;
		}
		footer{
			/*margin-top: 20% !important;*/
			/*padding: 2rem 0 1rem 0; !important;*/
			  /*position: fixed;*/
			  left: 0;
			  bottom: 0;
			  width: 100%;
			  padding-top: 8px;
		}
		.jumbotron{
			margin-top: 7% !important;
			/*background-color: lightblue !important;*/
		}
		.plus{
			
			font-size: 70px;
			
			position:fixed;
			bottom:10%;
			right:10px;
			margin:0;
			padding:10px 3px;
			z-index: 2;
		    }
		.plus a{
			color: royalblue;
		}
		.pl{
			padding-top: 100px !important;
			color: white;
			font-family: 'Quicksand', sans-serif;
			border-bottom: 2px solid #66b3ff;
		}
		.card-header i{
			margin-left: 2rem;
		}
		body{
		background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url("img/backM6.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: repeat-y;
        background-size: cover;
        border-bottom: 3px solid #ccff33;
		}

		@media(max-width: 1000px)
		{
			.navbar-text
			{
				margin-left: 0;
			}
			.card
			{
				margin-left: 8rem !important;
			}
		}
		@media(max-width: 830px)
		{
			.card
			{
				margin-left: 6rem !important;
			}
		}
		@media(max-width: 400px)
		{
			.card
			{
				margin: 2rem 2rem 5rem 3rem !important;
			}
		}
	</style>

	<title>Home | CT₹L Budget</title>
</head>
<body>

	<?php include 'header.php'; ?>


	
	<?php
		$user_id=$_SESSION['user_id'];
		$query = "SELECT * FROM plan_details WHERE duser_id='$user_id'";
		$query_run = mysqli_query($con, $query) or die(mysqli_error($con));
		$rows_fetched = mysqli_num_rows($query_run);

		// get user
		$select="SELECT * FROM users WHERE uid='$user_id'";
		$select_run=mysqli_query($con, $select) or die(mysqli_error($con));
		$rowu=mysqli_fetch_array($select_run);
		if($rows_fetched == 0) //if there are no plans created by user then only show jumbotron with create new plan link
		{
	?>     <div class="container">
			  <div class="jumbotron">
			    <div class="text-center">
			    <h3>Hello <?php echo $rowu['email']; ?></h3>
				  <h1 class="display-4">You don't have any active plans</h1>
				  
				  <hr class="my-4">
				    <p>"I am indeed rich, since my income is superior to my expenses, and my expense is equal to my wishes." - Edward Gibbon
				  .</p>
				  
			     <a class="btn btn-link btn-lg"data-toggle="modal"  data-target="#newP" role="button" style="font-family: 'Recursive', sans-serif;"><i class="fa fa-plus-circle"></i>Create a new plan</a>
		        </div>
	          </div>
	        </div>

<?php   }


		else //if there are plan then show plus sign at right bottom which links to create new plan and also display your plans summary
	    { ?>
		    <div class="fluid-container">
		    	<div class="plus">
		    		<a  data-toggle="modal" data-target="#newP" type="button"><i class="fa fa-plus-circle"></i></a>
			    </div>
			</div>


			<!-- View plan -->
			<div class="container">
				<div class="text-center pl">
					<h3>Hello <?php echo $rowu['email']; ?></h3>
					<h1>Your Plans</h1>
				</div>
			</div>
	<div class="row">
		<?php 
			
			$selec1="SELECT pd_id,title, budget, people, start_date, end_date FROM plan_details WHERE duser_id='$user_id'";
			$selec1_run=mysqli_query($con, $selec1) or die(mysqli_error($con));
			
			
		?>			
	            <?php
	            	while($row1 = mysqli_fetch_array($selec1_run))
	            	{ ?>

						<div class="card" style="width: 18rem;margin: 10px 0 80px 50px;">
							<form method="post" action="view_plan.php">
								<h5 class="card-header text-center" style="background-color: #00b3b3;"><?php echo $row1['title']; ?><i class="fa fa-user"><span class="badge"><?php echo $row1['people']; ?></span></i></h5>
									
								<div class="card-body">
								    <p class="card-text"><strong>Budget: ₹ </strong><?php echo $row1['budget']; ?> </p>

								    <p class="card-text"><strong>Date:  </strong><?php echo $row1['start_date']; ?> to <?php echo $row1['end_date']; ?></p>
								    <?php
								      echo "<input type=hidden name=pid value='".$row1['pd_id']."'>";
								    ?> <!-- hidden input field to pass plan id -->
								    	<button type="submit" name="vp-btn" class="btn btn-block" style="background-color: #ccff33;">View Plan</button>
								</div>
							</form>
						</div>

			  <?php } ?>
	</div>

<?php } ?>

		 <div class="fluidcontainer">
			<?php include 'footer.php'; ?>
		</div>
		
 </body>
</html>
