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
	<a href="?language=en&amp;version=9.1" class="info top" style="text-decoration:none; color:#000; font-weight:bold;font-size:12px;"><img src="img/icon_eclass.png" alt="eCl@ss"> eCl@ss Version 9.1 (en)	</a>
	<div id='tree'>
	<?php echo $str;?>
	</div>
	</div>
	<div style="float:right;width:50%;padding-left:10px;" >
	<img src="img/loading.gif" id="ihide" style="display:none" />
	<div class="col-md-6">
	<h2>Template Name: <?php echo session('template'); ?></h2>
	Selected Values: <div id="echoSelection3"></div></div>
	<div id="data"></div>
	</div>
	</div>
	<input type="hidden" id="xhide" value="">
	<input type="hidden" id="xhidex" value="">
	<script type="text/javascript">
function logEvent(event, data, msg){
//        var args = $.isArray(args) ? args.join(", ") :
		msg = msg ? ": " + msg : "";
		$.ui.fancytree.info("Event('" + event.type + "', node=" + data.node + ")" + msg);
	}

		$(function(){
			
			var tree=$("#tree").fancytree({
				checkbox: true,
			selectMode: 3,
				dblclick: function(event, data) {
				data.node.toggleSelected();
			},
			select: function(event, data) {
				// Get a list of all selected nodes, and convert to a key array:
				var selKeys = $.map(data.tree.getSelectedNodes(), function(node){
					return node.key;
				});
				var selval=selKeys.join(",");
				$("#echoSelection3").text(selval);
				

				// Get a list of all selected TOP nodes
				var selRootNodes = data.tree.getSelectedNodes(true);
				// ... and convert to a key array:
				var selRootKeys = $.map(selRootNodes, function(node){
					return node.key;
				});
			//	var selval=selRootKeys.join(",");
				//$("#echoSelectionRootKeys3").text(selval);
				//var selvalx=document.getElementById("echoSelectionRootKeys3").innerHTML;
				//alert(selval);
				var str="?values="+selval;
		
		              var xmlhttp=new XMLHttpRequest();
		                xmlhttp.onreadystatechange=function() {
		                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		                        var x=xmlhttp.responseText;
								
					
		                    }
		                }
		                xmlhttp.open("GET","update"+str,true);
		                xmlhttp.send(); 
				
			},
				focus: function(event, data) {
		       
	  
					document.getElementById("data").innerHTML="";
				var id=String(data.node);
			
				
				var xid=id.split(',')[1];
				var xid1=id.split(' ')[1].substr(1);
				xid1=xid1.split('-').join('');
				var level=0;
				if(xid1.length==2){
					level=2;
				}
				if(xid1.length==4){
					level=3;
				}
				if(xid1.length==6){
					level=4;
				}
				if(xid1.length==8){
					level=5;
				}
			
				if(level<=4){
				var xhide=document.getElementById("xhide").value;
				var xhide1=xhide.split(',');
				var status=xhide1.indexOf(xid1);
				//alert(status);
				if(status==-1){
			document.getElementById("xhide").value=xhide+","+xid1;
			var str="?data="+xid1+"&level="+level;
			//alert(id);
		              var xmlhttp=new XMLHttpRequest();
		                xmlhttp.onreadystatechange=function() {
		                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		                        var x=xmlhttp.responseText;
		                currentObject = JSON.parse(x);
						var count=0;
						 for(var key in currentObject){
							
        if(currentObject.hasOwnProperty(key)) {
			if(level<4){
						data.node.addChildren({
				title: currentObject[key].name,
				key: currentObject[key].CodedName,
				selected: currentObject[key].selected,
				 folder: true
				
				//icon: "img/bsp.png",
				//node=currentObject[key].CodedName
			});
			}else{
						data.node.addChildren({
				title: currentObject[key].name,
				key: currentObject[key].CodedName,
				selected: currentObject[key].selected,
				icon: "img/bsp.png"
				
			});
			}
					count++;	 }}
					data.node.setExpanded(true);
		                    }
		                }
		                xmlhttp.open("GET","adminapi"+str,true);
		                xmlhttp.send(); 
				}
				}
				
			}
			});
				
		});
		
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
	$( "a" ).unbind();
$( "a" ).click(function( event ) {
  event.preventDefault();
 // return false;
});
</script>
	</body>
	</html>