<html>
<?php
//error_reporting(0);
//ini_set('display_errors', 0);
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<?php
$a="";
$b="";
$c="";
$d="";
$e="";
$f="";
$g="";
$h="";
$i="";
$j="";
$k="";
$l="";
$m="";
$n="";
$o="";
$p="";
$q="";
$r="";
if(isset($_POST['submit'])){
$servername="mysql.hostinger.in";
$username="u282969010_tree";
$password="sanjay4352";
$dbname="u282969010_tree";
$conn=new mysqli($servername,$username,$password,$dbname);

$Supplier=$_POST['Supplier'];
$IdCC=$_POST['IdCC'];
$Identifier=$_POST['Identifier'];
$VersionNumber=$_POST['VersionNumber'];
$VersionDate=$_POST['VersionDate'];
$RevisionNumber=$_POST['RevisionNumber'];
$CodedName=$_POST['CodedName'];
$PreferredName=$_POST['PreferredName'];
$Definition=$_POST['Definition'];
$ISOLanguageCode=$_POST['ISOLanguageCode'];
$ISOCountryCode=$_POST['ISOCountryCode'];
$Note=$_POST['Note'];
$Remark=$_POST['Remark'];
$Level=$_POST['Level'];
$MKSubclass=$_POST['MKSubclass'];
$MKKeyword=$_POST['MKKeyword'];
$MKBSA=$_POST['MKBSA'];
$IrdiCC=$_POST['IrdiCC'];

$str=substr($CodedName,0,2);
if($str==98||$str==99){
$sql="INSERT INTO eclass9_1_cc_en(Supplier,IdCC,Identifier,VersionNumber,VersionDate,RevisionNumber,CodedName,PreferredName,Definition,ISOLanguageCode,ISOCountryCode,Note,Remark,Level,MKSubclass,MKKeyword,MKBSA,IrdiCC)
values('$Supplier','$IdCC','$Identifier','$VersionNumber','$VersionDate','$RevisionNumber','$CodedName','$PreferredName','$Definition','$ISOLanguageCode','$ISOCountryCode','$Note','$Remark','$Level','$MKSubclass','$MKKeyword','$MKBSA','$IrdiCC')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}else{
	phpAlert("Invalid Coded Name"); 
}
}
if(isset($_POST['submit2'])){
$servername="mysql.hostinger.in";
$username="u282969010_tree";
$password="sanjay4352";
$dbname="u282969010_tree";
$conn=new mysqli($servername,$username,$password,$dbname);
$CodedName=$_GET['CodedName'];
$results= $conn->query("delete from eclass9_1_cc_en where CodedName='$CodedName'");
	echo "Deleted Successfully";
	    echo "<script>window.location.href='http://mentorxo.in/lv1/?id=".$_GET['CodedName']."'</script>";

}
if(isset($_POST['submit1'])){
$servername="mysql.hostinger.in";
$username="u282969010_tree";
$password="sanjay4352";
$dbname="u282969010_tree";
$conn=new mysqli($servername,$username,$password,$dbname);

$Supplier=$_POST['Supplier'];
$IdCC=$_POST['IdCC'];
$Identifier=$_POST['Identifier'];
$VersionNumber=$_POST['VersionNumber'];
$VersionDate=$_POST['VersionDate'];
$RevisionNumber=$_POST['RevisionNumber'];
$CodedName=$_POST['CodedName'];
$PreferredName=$_POST['PreferredName'];
$Definition=$_POST['Definition'];
$ISOLanguageCode=$_POST['ISOLanguageCode'];
$ISOCountryCode=$_POST['ISOCountryCode'];
$Note=$_POST['Note'];
$Remark=$_POST['Remark'];
$Level=$_POST['Level'];
$MKSubclass=$_POST['MKSubclass'];
$MKKeyword=$_POST['MKKeyword'];
$MKBSA=$_POST['MKBSA'];
$IrdiCC=$_POST['IrdiCC'];

$str=substr($CodedName,0,2);
if($str==98||$str==99){
$sql="update eclass9_1_cc_en set Supplier='$Supplier',IdCC='$IdCC',Identifier='$Identifier',VersionNumber='$VersionNumber',VersionDate='$VersionDate',RevisionNumber='$RevisionNumber',CodedName='$CodedName',PreferredName='$PreferredName',Definition='$Definition',ISOLanguageCode='$ISOLanguageCode',ISOCountryCode='$ISOCountryCode',Note='$Note',Remark='$Remark',Level='$Level',MKSubclass='$MKSubclass',MKKeyword='$MKKeyword',MKBSA='$MKBSA',IrdiCC='$IrdiCC' where CodedName=$CodedName";

if ($conn->query($sql) === TRUE) {
    echo "Updated successfully";
    echo "<script>window.location.href='http://mentorxo.in/lv1/?id=".$_GET['CodedName']."'</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}else{
	phpAlert("Invalid Coded Name"); 
}
}


if(isset($_GET['CodedName'])){
$servername="mysql.hostinger.in";
$username="u282969010_tree";
$password="sanjay4352";
$dbname="u282969010_tree";
$conn=new mysqli($servername,$username,$password,$dbname);
$CodedName=$_GET['CodedName'];

	$results= $conn->query("select * from eclass9_1_cc_en where CodedName='$CodedName'");
	while($row = $results->fetch_array()){
	$a=$row['Supplier'];
	$b=$row['IdCC'];
	$c=$row['Identifier'];
	$d=$row['VersionNumber'];
	$e=$row['VersionDate'];
	$f=$row['RevisionNumber'];
	$g=$row['CodedName'];
	$h=$row['PreferredName'];
	$i=$row['Definition'];
	$j=$row['ISOLanguageCode'];
	$k=$row['ISOCountryCode'];
	$l=$row['Note'];
	$m=$row['Remark'];
	$n=$row['Level'];
	$o=$row['MKSubclass'];
	$p=$row['MKKeyword'];
	$q=$row['MKBSA'];
	$r=$row['IrdiCC'];
	
	
}
}

?>
	<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
.form-group .required .control-label:after {
  content:"*";color:red;
}
</style>
</head>
<body>
<div class="container">

<div class="header" style="font-size:50px; text-align:center; font-family:comic; color:#f03;">Fill Data
</div>
</div>
<form method="post">

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">

<input type="text" value="<?php echo $a; ?>" placeholder="Supplier" name="Supplier" class="form-control">
</div>
</div>



<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $b; ?>" placeholder="IDCC" name="IdCC" class="form-control">
</div>
</div>


<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $c; ?>" placeholder="Identifier" name="Identifier" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $d; ?>" placeholder="Version Number" name="VersionNumber" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $e; ?>" placeholder="Version Date" name="VersionDate" class="form-control">
</div>
</div>


<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $f; ?>" placeholder="Revision date" name="RevisionNumber" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $g; ?>" placeholder="Coded Name*" name="CodedName" required class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $h; ?>" placeholder="Preferred Name*" name="PreferredName" required class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $i; ?>" placeholder="Defination" name="Definition" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $j; ?>" placeholder="ISO Language code" name="ISOLanguageCode" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $k; ?>" placeholder="Iso Country Code" name="ISOCountryCode" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $l; ?>" placeholder="Note" name="Note" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $m; ?>" placeholder="Remark" name="Remark" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $n; ?>" placeholder="Level*" name="Level" required class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $o; ?>" placeholder="MK Subclass" name="MKSubclass" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $p; ?>" placeholder="MK Keyword" name="MKKeyword" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" value="<?php echo $q; ?>" placeholder="MK BSA" name="MKBSA" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="IRDICC" name="IrdiCC" value="<?php echo $r; ?>" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-md-6 col-md-offset-6">
<?php if(!isset($_GET['CodedName'])){ ?>
<input type="submit" name="submit" value="submit" class="btn  btn-lg" style=" background-color:#f03; color:white">
<?php }else{ ?>

<input type="submit" name="submit2" value="Delete" class="btn  btn-lg" style=" background-color:red; color:white;float:right;  margin-left:20px">
<input type="submit" name="submit1" value="update" class="btn  btn-lg" style=" background-color:#f03; color:white;float:right">
<a href="http://mentorxo.in/lv1/?id=<?php echo $_GET['CodedName']; ?>" class="btn btn-lg btn-info">Back</a>
<?php } ?>
</div>
</div>



</div>
</form>
</body>
</html>