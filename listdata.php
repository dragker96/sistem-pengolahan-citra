<?php 
$path  = 'image';
$files = array_diff(scandir($path), array('..', '.'));
$no=0;
foreach($files as $value){
	$no++;
	?>
	<tr>
		<td><?php echo $no;?></td>
		<td><img src="image/<?php echo $value;?>" width="50%" height=""></img></td>
		<td><img src="grayscale/<?php echo $value;?>" width="50%" height=""></img></td>
		<td><img src="citra/<?php echo $value;?>" width="50%" height=""></img></td>
	</tr>
	<?php 
}
?>