<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-upload']))
{    
    for($i=0; $i<count($file = $_FILES['file']['name']); $i++) {
    
    $file = $_FILES['file']['name'][$i];
    $file_loc = $_FILES['file']['tmp_name'][$i];
	$file_size = $_FILES['file']['size'][$i];
	$file_type = $_FILES['file']['type'][$i];
	
	$folder="uploads/";
	
	if ($file_loc == "") {
		 ?>
		<script>
		alert('Please select files!');
		window.location.href='index.php?fail';
        </script>
		<?php
	}else{
		if ($file_size > 41943040) {
			 ?>
		<script>
		alert('File size exceed 40MB!');
		window.location.href='index.php?fail';
        </script>
		<?php
		}
		else{
					$new_size = $file_size/1024;  
	
	$new_file_name = strtolower($file);
	
	$final_file=str_replace('','',$new_file_name);
	
	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
		mysql_query($sql);
		?>
		<script>
		alert('successfully uploaded');
        window.location.href='index.php?success';
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert('error while uploading file');
        window.location.href='index.php?fail';
        </script>
		<?php
	}
	}
	
    }

	}
	}

?>