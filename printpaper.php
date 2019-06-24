<?php
include("php/dbconnect.php");
$examen= isset($_REQUEST['examen'])?mysqli_real_escape_string($conn,$_REQUEST['examen']):'' ;
$sets= isset($_REQUEST['sets'])?mysqli_real_escape_string($conn,$_REQUEST['sets']):'' ;
$title= isset($_REQUEST['title'])?mysqli_real_escape_string($conn,$_REQUEST['title']):'' ;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Examen USFX</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
<h3 class="text-center"><?php echo $title;?> </h3>

<?php
$sql = $conn->query("select q.id from pregunta as q,examen as p where p.id= q.examen and q.examen= '$examen' group by q.id");
$num = $sql->num_rows;
if($num>0)
{
for($char='A';$char<=$sets;$char++)
{
echo '<h4 class="text-center">Sets -'.$char.' </h4>';
$examen_array = array();
while($r = $sql->fetch_assoc())
{
$examen_array[] = $r['id'];
}

shuffle($examen_array);
mysqli_data_seek($sql,0);

for($i=0;$i<$num;$i++)
{

$query = $conn->query("select * from pregunta where id= '".$examen_array[$i]."'");
$row = $query->fetch_assoc();
echo '<div class="row"><p> <strong>pregunta '.($i+1).') </strong>'.$row['pregunta'].'</p>';

if($row['tipo']=="Multiple Choice")
{
echo '<div class="col-md-6">a) '.$row['obj1'].'</div> 
<div class="col-md-6">b) '.$row['obj2'].'</div>
<div class="col-md-6">c) '.$row['obj3'].'</div>
<div class="col-md-6">d) '.$row['obj4'].'</div>
';
}elseif($row['tipo']=="One Word")
{

echo 'One Word : __________________';


}elseif($row['tipo']=="True/False")
{
echo '<ul>
<li>True</li>
<li>False</li>
</ul>';
}
echo '

</div> <hr/>';
}


}
}
?>
</div>
</body>

</html>

