<?php $l1 = DB::table('eclass9_1_cc_en')->where('CodedName', 'like','%000000%')->get();
			//echo dd($l1);
		$l2=array();
		$l2id=array();
		foreach($l1 as $val1){
			$id=substr($val1->CodedName,0,2);
			$l2id[]=$id;
		$l2[$id]=DB::table('eclass9_1_cc_en')->where('CodedName', 'like',$id.'%0000%')->where('CodedName', '!=',$id.'%000000%')->get();	
		
		}
		$l3=array();
	
		//echo dd($l2);
		$str="";
		$x="";
		foreach($l2 as $val2){
			$str="";
			foreach($val2 as $val21){
		
		$id=substr($val21->CodedName,0,4);
	
		$l3[$id]= DB::table('eclass9_1_cc_en')->where('CodedName', 'like',$id.'%00%')->where('CodedName', '!=',$id.'%0000%')->get();
			}
		
		}
			//echo $x;

	
			//echo dd($l3);
		$l4=array();
	
	
		foreach($l3 as $val3){
			foreach($val3 as $val31){
						$str=$str.$val31->CodedName."\n";
				$x=$x.$str;
$myfile = fopen(substr($val31->CodedName,0,2).".txt", "w") or die("Unable to open file!");
fwrite($myfile, $str);
fclose($myfile);
	/*	$id=substr($val31->CodedName,0,6);
	
		$l4[$id]= DB::table('eclass9_1_cc_en')->where('CodedName', 'like',$id.'%')->where('CodedName', '!=',$id.'%00%')->get();*/
			}
			
		}
	echo dd($l4);
	?>