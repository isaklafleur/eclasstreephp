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
	

	
<style>
img[title]:hover:after {
  content: attr(title);
  padding: 4px 8px;
  color: #333;
  position: absolute;
  left: 0;
  top: 100%;
  white-space: nowrap;
  z-index: 20px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow: 0px 0px 4px #222;
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #eeeeee),color-stop(1, #cccccc));
  background-image: -webkit-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -ms-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -o-linear-gradient(top, #eeeeee, #cccccc);
}
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
<style>
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    
    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 105%;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}</style>
	</head>
	<body>
	
	
<div id="mainright" class="rightFloat">
<form method="get" name="searchform" action="/index.php">

<table cellpadding="0" cellspacing="2" class="full colorfull" summary="Search options" border="0">
  <tbody><tr>
    <th> Search in: </th> 
    <td align="left">
      <select name="options" id="options" class="input">
      <option value="class">Classification</option>
      <option value="prop">Property</option>
      <option value="value">Value</option>
      </select>
    </td>
    <th> for: </th>
    <td width="20%"><input type="text" name="searchtxt" size="30" value="" maxlength="50" placeholder="start typing min 3 char" class="input" id="stxt"></td>
       
  </tr>
</tbody></table>
</form>

<!--div class="imgBanner"><a href="http://www.eclass-kongress.de" target="_blank" title="eclass-kongress website"><img src="img/banner_eclass_468x60_2.gif" /></a></div-->
</div>
<div id="main">

</div>
	
	<div class="container">
	<div class="row">
	<div style="float:left;width:49%;padding-left:10px;">
	<div id='tree'>
	<?php echo $str;?>
	</div>
	</div>
	<div style="float:right;width:50%;padding-left:10px;" >
	<img src="img/loading.gif" id="ihide" style="display:none" />
	<div id="data">
	
	<div>Values: <span id="echoSelection3"><?php echo $str1; ?></span></div>
	<form method="get">
	<input type="hidden" id="echoSelection3v" value="<?php echo $str1; ?>" name="values" />
	<input type="submit" class="btn btn-info" value="Add" >
	</form>
	</div>
	</div>
	</div>
	<input type="hidden" id="xhide" value="">
	<input type="hidden" id="xhidex" value="">
	<script type="text/javascript">
	function openValue1(data){
		var str="?data2="+data;
		document.getElementById("ihide").style.display="block";
		document.getElementById("data").innerHTML="";
		              var xmlhttp=new XMLHttpRequest();
		                xmlhttp.onreadystatechange=function() {
		                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		                        var x=xmlhttp.responseText;
									document.getElementById("ihide").style.display="none";
		                 document.getElementById("data").innerHTML=x;
					
		                    }
		                }
		                xmlhttp.open("GET","api"+str,true);
		                xmlhttp.send(); 
	  }		
	  function openValue(data){
		
		 	var str="?data1="+data;
		document.getElementById("ihide").style.display="block";
		document.getElementById("data").innerHTML="";
		              var xmlhttp=new XMLHttpRequest();
		                xmlhttp.onreadystatechange=function() {
		                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		                        var x=xmlhttp.responseText;
									document.getElementById("ihide").style.display="none";
		                 document.getElementById("data").innerHTML=x;
					
		                    }
		                }
		                xmlhttp.open("GET","api"+str,true);
		                xmlhttp.send(); 
	  }	
	  
	</script>
		<script type="text/javascript">
	$('#stxt').on('keyup',function(){
		var select = document.getElementById("options");
var typex = select.options[select.selectedIndex].value;
	
		var value=$(this).val();
		if(value.length>=3){
		$.ajax({
			type:'get',
			url:'search',
			data:{'search':value,'type':typex},
			success:function(data){
				document.getElementById("data").innerHTML=data;
			}
		});
		}
	})
	</script>
<script type="text/javascript">
		$(function(){
			$("#tree").fancytree({
			checkbox: true,
			selectMode: 3,
		
			lazyLoad: function(event, ctx) {
				ctx.result = {url: "ajax-sub2.json", debugDelay: 1000};
			},
			loadChildren: function(event, ctx) {
				ctx.node.fixSelection3AfterClick();
			},
			select: function(event, data) {
				// Get a list of all selected nodes, and convert to a key array:
				var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
					return node.key;
				});
				$("#echoSelection3").append(selKeys.join(", "));
				$("#echoSelection3v").append(selKeys.join(", "));

				// Get a list of all selected TOP nodes
				var selRootNodes = data.tree.getSelectedNodes(true);
				// ... and convert to a key array:
				var selRootKeys = $.map(selRootNodes, function(node){
					return node.key;
				});
				$("#echoSelectionRootKeys3").text(selRootKeys.join(","));
				$("#echoSelectionRoots3").text(selRootNodes.join(","));
			},
			dblclick: function(event, data) {
				data.node.toggleSelected();
			},
			keydown: function(event, data) {
				if( event.which === 32 ) {
					data.node.toggleSelected();
					return false;
				}
			},
			// The following options are only required, if we have more than one tree on one page:
//				initId: "treeData",
			cookieId: "fancytree-Cb3",
			idPrefix: "fancytree-Cb3-"
		});
		});

	</script>

	</body>
	</html>