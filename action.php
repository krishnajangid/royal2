<?php  
include("config.php");
$input = filter_input_array(INPUT_POST);

$desc = mysqli_real_escape_string($connect, $input["desc"]);

if($input["action"] === 'edit')
{
 $query = " UPDATE gallary SET  description = '".$desc."' WHERE id = '".$input["id"]."' ";

 mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{

	$sql=mysqli_query($connect,"select * from gallary where id='".$input["id"]."'");

 	$row=mysqli_fetch_array($sql);
 
	unlink("upload_images/$row[photo_name]");

 	$query = "delete from gallary WHERE id = '".$input["id"]."' ";
 	mysqli_query($connect, $query);
} 
echo json_encode($input);

?>
