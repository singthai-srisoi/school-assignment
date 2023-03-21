<?php 
include_once '../config.php';

$reg_no = $_POST['car'];
?>

<?php 
	//load image from file
	$file = $con->query("SELECT * FROM image WHERE reg_no='$reg_no'; ");
	if ($file->num_rows > 0){
		while ($image = $file->fetch_assoc()){
 ?>

 <div>
 	<img src="../img/<?php echo $image['file_name']; ?>">
 </div>
<?php }}else{ ?>
	<h5 class="card-title">No Image found</h5>
<?php } ?>