<?php
include_once 'dbconfig.php';
if(isset($_GET['delete_id']))  /* for deleting the file */
{
  $sql_query="DELETE FROM tbl_uploads WHERE id=".$_GET['delete_id'];
  mysql_query($sql_query);
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>downup.ml</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="body">
    <h2>Upload New Files From Here</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file[]" multiple />
    <button class="button button2 type="submit" name="btn-upload" onclick="move()">Upload</button><br><br>

    <div id="myProgress">
    <div id="myBar"></div>
    </div>

    </form>
    
    
</div>
<div id="container">
<div id="myTable">
	<table width="80%" border="1">
  
    <h2>Uploaded Files</h2>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="  Search for files.." title="Type in a name">
    <tr>
    <tr class="header">
    <th>File Name</th>
    <th>File Type</th>
    <th>Upload Date</th>
    <th>File Size(KB)</th>
    <th>Delete</th>
    <th>View</th>
    </tr>
    <?php
	$sql="SELECT * FROM tbl_uploads ORDER BY id DESC";
	$result_set=mysql_query($sql);
	while($row=mysql_fetch_array($result_set))
	{
		?>
        <tr>
        <td style="text-align: left;"><?php echo $row['file'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td align="center"><a href="javascript:delete_id(<?php echo $row[0]; ?>)"><img src="images/b_drop.png" alt="Delete" /></a></td>
        <td><a href="uploads/<?php echo $row['file'] ?>" target= "_blank">view file</a></td>
        </tr>
        <?php
	}
	?>
    </table>

    
</div>
</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>
<script type="text/javascript">
  function delete_id(id)
{
  // if(confirm('Sure to delete this file?'))
  // {
  //   window.location.href='index.php?delete_id='+id;
  // }
  var sign = prompt("Enter password to delete this file.");
    if (sign.toLowerCase() == "anything") {
        if(confirm('This item will be permanently deleted and cannot be recovered. Are you sure?')) 
        {
        window.location.href='index.php?delete_id='+id;
        }
    }
}
</script>
</body>
</html>