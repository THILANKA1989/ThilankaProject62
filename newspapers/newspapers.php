<?php include '../mainContent/head.php'; ?>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
<div class="card">
<?php
require_once '../core/database/connect.php'; 
include '../core/functions/dateformatting.php';
include '../core/functions/checknp.php';
$dt = time();
$mysql_date = strftime("%Y-%m-%d %H:%M:%S", $dt);
$query = mysqli_query($connection,"SELECT date_pub FROM newspaper_adds WHERE type='Daily' ORDER BY date_pub DESC");
$date2 = mysqli_fetch_assoc($query);

$queryw = mysqli_query($connection,"SELECT date_pub FROM newspaper_adds WHERE type='Weekly' ORDER BY date_pub DESC");
$datew = mysqli_fetch_assoc($queryw);

$dt = time();
$mysql_date = strftime("%Y-%m-%d", $dt);

$newspapers =mysqli_query($connection,"SELECT * FROM newspaper ORDER BY name ASC");
$np = mysqli_fetch_assoc($newspapers);
$numrows = mysqli_num_rows($newspapers);   //modify('+1 week');



?>
<?php if($numrows > 0){  ?>
    <?php do { ?>
	<div class="col-md-4">
	<div class="cardslot">
		<img src="<?php echo $np['cover'];?>">
		<?php $newspaper_idget = $np['id']; ?>
		<h4 class="blue"><?php echo $np['name']; ?></h4>
		<span class="small">Sunday Weekly</span>&nbsp;&nbsp;&nbsp;
		<?php
		$getdater = mysqli_query($connection,"SELECT nd.date_pub FROM newspaper_adds nd JOIN 
			newspaper np ON
			np.id = nd.newspaper_id
			WHERE nd.newspaper_id = '$newspaper_idget'
			ORDER BY nd.date_pub DESC LIMIT 1
			");
		$getdate = mysqli_fetch_assoc($getdater);
		$check =  datecheck($getdate['date_pub'],$mysql_date);
		echo $check;
		?>
		<!-- code for weekly -->
		</i><br/>
		<span class="small">Today Newspaper</span>&nbsp;&nbsp;&nbsp;
		<?php if($check > 0){ ?>
		<i class="fa fa-stop">
			<?php }else{ ?>
			<i class="fa fa-play">
		<?php  } ?>
		</i>
	</div>
	</div>
	<?php $check = 0; } while($np=mysqli_fetch_assoc($newspapers)); }else{ ?>
        <?php echo 'No Posts'; }?>

</div>