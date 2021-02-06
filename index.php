<?php 
error_reporting(E_ALL & ~E_NOTICE);
$dir = "image";
if(!empty($_POST)){
	$image_name = $_FILES["image"]["name"];
	$image = $_FILES["image"]["tmp_name"];
	$image_info = getimagesize($image); 
	$imageSaved= $dir."/".$image_name; 
	if(move_uploaded_file($_FILES["image"]["tmp_name"], $imageSaved)){
		$image = ImageCreateFromJpeg($imageSaved);
		imagejpeg($image, "citra/".$image_name);
		grayscale($image, $image_name);
		citraBiner($image, $image_name);
	}
}
?>
<html>
	<head>
		<title>Pengolah Citra Digital</title>
			<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
			<link href="css/style.css" rel="stylesheet" />
			<script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
	<body>
   
	<?php 
	include "menu.php";
	?>
    <br><br><br>
		<div class="container">
			<div class="row">
				<form method="POST" class="form-inline" action="" enctype="multipart/form-data">
					<div class="form-group">
						<label for="email">Image:</label>
						<input type="file" name="image" accept="image/jpg">
            
					</div>
						<button class="btn btn-info" type="submit" name="simpan">Simpan</button>
				</form>
				<table class="table table-bordered">
					<tr>
						<td>No</td>
						<td>File Asli</td>
						<td>Grayscale</td>
						<td>Citra Biner</td>
					</tr>
                   	<?php 
					include "listdata.php";
					?>
				</table>
			</div>
		</div>
        <br>

	<footer class="bottom bg-info">
    	<div class="panel-footer text-center">
        	<span>
            	<a>
              		<em>&copy; UIGM2020</em>
            	</a>
          	</span>
          </div>
  	</footer>

	</body>
</html>

<?php 
function grayscale($img, $name){
	$imgWidth = imagesx($img);
	$imgHeight = imagesy($img);
	for($i=0; $i<$imgWidth; $i++){
		for($j=0; $j<$imgHeight; $j++){
			$rgb = ImageColorAt($img, $i, $j); 
			$rr = ($rgb >> 16) & 0xFF;
			$gg = ($rgb >> 8) & 0xFF;
			$bb = $rgb & 0xFF;

			$g = round(($rr + $gg + $bb) / 3);

			$val = imagecolorallocate($img, $g, $g, $g);
            imagesetpixel ($img, $i, $j, $val);
		}
	}
	imagejpeg($img, "grayscale/".$name);
}
function citraBiner($img, $name){
	$imgWidth = imagesx($img);
	$imgHeight = imagesy($img);
	for($i=0; $i<$imgWidth; $i++){
		for($j=0; $j<$imgHeight; $j++){
			$rgb = ImageColorAt($img, $i, $j); 
			$rr = ($rgb >> 16) & 0xFF;
			$gg = ($rgb >> 8) & 0xFF;
			$bb = $rgb & 0xFF;

			$g = round(($rr + $gg + $bb) / 3);
			if($g<=128){
				$hasil = 0;
			}else{
				$hasil= 255;
			}
			$val = imagecolorallocate($img, $hasil, $hasil, $hasil);
            imagesetpixel ($img, $i, $j, $val);
		}
	}
	imagejpeg($img, "citra/".$name);
}
?>