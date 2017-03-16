<html>
   <head>
      <title>Tree Stuture</title>

<script src="lib/jquery.js"></script>
	<script src="lib/jquery-ui.custom.js"></script>

	<link href="src/skin-win8/ui.fancytree.css" rel="stylesheet">
	<script src="src/jquery.fancytree.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="src/screen.css">
     
     

     
	<!-- Start_Exclude: This block is not part of the sample code -->
	<link href="lib/prettify.css" rel="stylesheet">
	<script src="lib/prettify.js"></script>
<script type="text/javascript">
		$(function(){
			//event.preventDefault();
			// using default options
			$("#tree").fancytree();
			$("#tree span.fancytree-title").tooltip();
		});
	</script>
	
<style>
.container{
	    width: 100% !important;
   // padding-top: 20px;
}
ul.fancytree-container:focus{
		border:0px !important;
}
ul.fancytree-container{
	border:0px !important;
	//border-right: 1px solid gray !important;
}
.fancytree-treefocus{
	border-width:0px !important;	
}
</style>

	</head>
	<body>
	
	
<div id="mainright" class="rightFloat">




<!--div class="imgBanner"><a href="http://www.eclass-kongress.de" target="_blank" title="eclass-kongress website"><img src="img/banner_eclass_468x60_2.gif" /></a></div-->
</div>
<div id="main">
</div>
	
	<div class="container">
	<div class="row">
	<div style="float:left;width:49%;padding-left:10px;">
	<div id='tree'><br></br>
	<label>Enter Template name</label><br>
	<form method="get">
	<?php

	$data=""; if(isset($_GET["value"])){

$data=$_GET["value"];}?>
	<input type="text" name="template" required size="30" value="<?php echo $data; ?>" maxlength="50" placeholder="Template name" style="width:45%;float:left;margin-right:10px;" class="form-control" id="template">
	
	<?php if(isset($_GET["value"])){ ?>
	<input type="hidden" class="btn btn-info" name="value" value="<?php echo $data; ?>" />
	<input type="submit" class="btn btn-info" name="rename" value="Rename Now" /><br><br>
	<?php }else{ ?>
	<input type="submit" name="create" class="btn btn-info" value="Create New" /><br><br>
	<?php } ?>
	<label class="label label-success"><?php echo $msg; ?></label>
	</form>
	</div>
	</div>
	<div style="float:right;width:50%;padding-left:10px;" >
	<h2>All Template</h2>
	 <table id="datatable" class="table table-striped table-bordered" style="width:40%;">
	  <tbody>
	<?php $count=0; foreach($list as $template){ $count++;?>
	<tr>
	<td><?php echo $count; ?></td>
	<td>
	<a href="./?template=<?php echo $template->template; ?>" target="_blank" class="col-md-3"><?php echo $template->template; ?></a></td>
	<td><a href="company?template=<?php echo $template->template; ?>" target="_blank" class="btn btn-success">View Template</a></td>
	<td><a href="?value=<?php echo $template->template; ?>" class="btn btn-info">Rename</a></td>
	<td><a href="?del=<?php echo $template->template; ?>" class="btn btn-danger">Delete</a></td>
	</tr>
	<br>
	<?php } ?>
	 </tbody>
	</table>
	</div>
	</div>
	<input type="hidden" id="xhide" value="">
	<input type="hidden" id="xhidex" value="">

	</body>
	</html>