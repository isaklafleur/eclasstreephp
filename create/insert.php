<html>
<?php
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
?>
<?php
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
?>
	<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
<input type="text" placeholder="Supplier" name="Supplier" class="form-control">
</div>
</div>



<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="IDCC" name="IdCC" class="form-control">
</div>
</div>


<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Identifier" name="Identifier" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Version Number" name="VersionNumber" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Version Date" name="VersionDate" class="form-control">
</div>
</div>


<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Revision date" name="RevisionNumber" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Coded Name" name="CodedName" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Preferred Name" name="PreferredName" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Defination" name="Definition" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="ISO Language code" name="ISOLanguageCode" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Iso Country Code" name="ISOCountryCode" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Note" name="Note" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Remark" name="Remark" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="Level" name="Level" class="form-control">
</div>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="MK Subclass" name="MKSubclass" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12 col-md-12">
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="MK Keyword" name="MKKeyword" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="MK BSA" name="MKBSA" class="form-control">
</div>
</div>
<div class="col-sm-4 col-md-4">
<div class="form-group">
<input type="text" placeholder="IRDICC" name="IrdiCC" class="form-control">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-3 col-md-3">
<input type="submit" name="submit" value="submit" class="btn  btn-lg" style="margin-left:1020px; background-color:#f03; color:white">
</div>
</div>



</div>
</form>
</body>
</html>