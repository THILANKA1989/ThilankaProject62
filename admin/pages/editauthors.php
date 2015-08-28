<h4>Edit Books and Delete</h4>

<div class="row">
	<div class="col-md-12">
		<div class="tableofpenalty">
			<?php
			require_once('../../core/init.php');

			$rs = mysqli_query(SELECT * FROM authors)
			$rows = mysqli_fetch_assoc($rs);
			$numrows = mysqli_num_rows($rs);


			?>
			<table class="table table-bordered table-responsive">
  				<th>
  					<td>Title</td>
  					<td>Book ID</td>
  					<td>Author</td>
  					<td>Category</td>
  					<td>Price</td>
  					<td>Added Time</td>
  					<td>Publisher</td>
  					<td>Published Year</td>
  					<td>Operations</td>
  				</th>
  				<?php if($numrows > 0){  ?>
                        <?php do { ?>
  				<tr>
  					<td><?php echo $rows['CopyID'];?></td>
  					<td><?php echo $rows['Title'];?></td>
  					<td><?php echo $rows['bookID'];?></td>
  					<td><?php echo $rows['Author'];?></td>
  					<td><?php echo $rows['Category'];?></td>
  					<td><?php echo $rows['Price'];?></td>
  					<td><?php echo $rows['DateAdded'];?></td>
  					<td><?php echo $rows['Publisher'];?></td>
  					<td><?php echo $rows['Year'];?></td>
  					<td>
  						<div class="row">
	  						<div class="col-lg-6"><a href="../editbook.php?username=<?php echo $rows['ISBN']; ?>" class="bkadd pull-left" style="zoom:0.75">Edit</a></div>
	  						<div class="col-lg-6"><a href="pages/processing/books/delete.php?delete=<?php echo $rows['CopyID']; ?>" class="bkedit pull-right" style="zoom:0.75">Delete</a></div>
  						</div>
  					</td>
  				</tr>

  				<?php } while($rows=mysqli_fetch_assoc($rs)); }else{ ?>
                            <?php echo 'No Books'; }?>

			</table>


		</div>
	</div>
</div>
