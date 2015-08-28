<div class="dashtitle">
	<h2>Report</h2>
</div><br/>
	<?php require_once('../../core/init.php');?>
<div class="row">
	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$booksget = mysqli_query($connection,"SELECT id FROM books");

				$booksgetter = mysqli_fetch_assoc($booksget);
				$numbk = mysqli_num_rows($booksget);
				echo $numbk;

				?>
			</h1>
			<h4 class="blue">Total Book Titles</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$copiesget = mysqli_query($connection,"SELECT id FROM copies");

				$copiesgetter = mysqli_fetch_assoc($copiesget);
				$numcp = mysqli_num_rows($copiesget);
				echo $numcp;

				?>
			</h1>
			<h4 class="blue">Total Copies</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$userget = mysqli_query($connection,"SELECT id FROM user");

				$usergetter = mysqli_fetch_assoc($userget);
				$numuser = mysqli_num_rows($userget);
				echo $numuser;

				?>
			</h1>
			<h4 class="blue">Total Members</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$autget = mysqli_query($connection,"SELECT id FROM authors");

				$autgetter = mysqli_fetch_assoc($autget);
				$numaut = mysqli_num_rows($autget);
				echo $numaut;

				?>
			</h1>
			<h4 class="blue">Total Authors</h4>
		</div>
	</div>

		<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$pubget = mysqli_query($connection,"SELECT id FROM publishers");

				$pubgetter = mysqli_fetch_assoc($pubget);
				$numpub = mysqli_num_rows($pubget);
				echo $numpub;

				?>
			</h1>
			<h4 class="blue">Total Publishers</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$totalget = mysqli_query($connection,"SELECT SUM(penalty) AS total FROM payments");

				$totalgetter = mysqli_fetch_assoc($totalget);
				$numtotal = mysqli_num_rows($totalget);
				echo $totalgetter['total'];

				?>
			</h1>
			<h4 class="blue">Rupees of Total Earnings</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$monthlyget = mysqli_query($connection,"SELECT * FROM user_lends_copies WHERE date_lend > (NOW() - INTERVAL 1 MONTH)");

				$monthlygetter = mysqli_fetch_assoc($monthlyget);
				$nummonthly = mysqli_num_rows($monthlyget);
				echo $nummonthly;
				?>
			</h1>
			<h4 class="blue">Total Borrows Last Month</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$monthlyget = mysqli_query($connection,"SELECT * FROM user WHERE date_added > (NOW() - INTERVAL 1 MONTH)");

				$monthlygetter = mysqli_fetch_assoc($monthlyget);
				$nummonthly = mysqli_num_rows($monthlyget);
				echo $nummonthly;

				?>
			</h1>
			<h4 class="blue">New members Last Month</h4>
		</div>
	</div>

	<div class="col-md-4">
		<div class="cardslot">
			<h1 class="heading2 oranger">
				<?php
				$monthlyget = mysqli_query($connection,"SELECT * FROM books WHERE date_released > (NOW() - INTERVAL 1 MONTH)");

				$monthlygetter = mysqli_fetch_assoc($monthlyget);
				$nummonthly = mysqli_num_rows($monthlyget);
				echo $nummonthly;

				?>
			</h1>
			<h4 class="blue">New books Last Month</h4>
		</div>
	</div>

</div>