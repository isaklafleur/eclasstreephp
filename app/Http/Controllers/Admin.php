<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Admin extends Controller
{
    //
	public function index(){
		if(isset($_GET["template"])){
		session(['template' => $_GET["template"]]);	
		}
		if(session('template')==null){
			redirect()->route('template');
		}
		if(isset($_GET["values"])){
			$template=session('template');
			$values=explode(',',$_GET["values"]);
			$ar="";
			foreach($values as $value){
				$ar=$ar.trim($value).",";
			}
			DB::table('company_template_tree_atlas_copco')
            ->where('template', $template)
            ->update(["CodedName"=>$ar]);
		}
	$l1x = DB::table('eclass9_1_cc_en')->where('CodedName', 'like','%000000%')->get();
	
	$str="<ul>";
	$img="";
	$l1=0;
	$l2=0;
	$l3=0;
	$l4=0;
	if(isset($_GET["id"])){
		$id=$_GET["id"];
		$l1=substr($id,0,2);
		$l1r=substr($id,-6);
		$l2i=substr($id,0,4);
		$l2r=substr($id,-4);
		$l3=substr($id,0,6);
		$l3r=substr($id,-2);
		$l4=substr($id,0,8);
		//$l4=substr($id,0,8);
	}
	$str1="";
	if(substr($l4,-2)!="00"){
		$CodedName=$_GET["id"];
		$l2=$this->getLevel5($CodedName);
		$str1=$str1."<table cellpadding='5' cellspacing='1' class='cart' style='font-size:12px;' summary='Results'>
	<tbody>
<tr>";
		foreach($l2 as $val2){
			
			$cl=chunk_split($val2->CodedName,2,'-');
			
			$def=str_replace('"','',$val2->Definition);
			if($def==""){
			$def="-";	
			}
			$IdCC=$val2->IdCC;
			$keyword=$this->getKeywords($IdCC);
			$keyword=substr($keyword,0,strlen($keyword)-1);
		$str1=$str1."	<th scope='row'>Classification:</th><td> $cl $val2->PreferredName [$val2->IdCC] </td>
	</tr>
	<tr>
	<th scope='row'>Preferred name:</th><td> $val2->PreferredName </td>
	</tr>
	<tr>
	<th scope='row'>Definition:</th><td>$def</td>
	</tr>
	<tr>
	<th scope='row'>Keywords:</th><td>$keyword</td>
	</tr>";
		}
		$str1=$str1."<tr>
   <th scope='col' colspan='2'>Properties:</th>
</tr><tr>
   <td colspan='2'>
      <ul class='classic'>";
$irdicc = $val2->IrdiCC;
$irdipr = $this->getIrdiPR($irdicc);
 if (!empty($irdicc)) {
	  if (count($irdipr) > 0) {  
foreach ($irdipr as $val4) {
                             
                $irdiprid = $this->getIrdiPRID(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $val4->IrdiPR));
             $name=$this->getIrdiPRName($irdiprid);
			 $str1=$str1."
			   
         <li><label onclick='openValue($irdiprid)' style='color:#014188;text-decoration:underline;cursor:pointer;'>$val4->IrdiPR</label> - $name
         </li>
         
     ";
}
  $str1=$str1."   
      </ul>
   </td>
<td><div class='imageCategory bold'><p class='center'>Exemplary representation</p><a href='http://www.eclass-pictures.com' target='_blank'><img alt='class image' src='http://www.eclass-pictures.com/eimage.php?coded=15110101&amp;size=300' class='imageCategory'></a></div>";        
  $str1=$str1."</td></tr>";  
}
            }
		$str1=$str1."</tr>
	</tbody>
	</table>";
	}
		foreach($l1x as $val1){
			$img="";
			if($val1->MKKeyword!='0'){
				
				$IdCC=$val1->IdCC;
				$keys=$this->getKeywords($IdCC);
				$kval="";
				if(is_array($keys)){
				foreach($keys as $key){
					$kval=$kval.$key->KeywordValue;
				} }
				$img="<img src='img/s.png'  title='Keywords: ".$kval."'/>";
			}
			$class="";
			if($val1->CodedName==$l1."000000"){
				$class="expanded";
			}
			$str=$str."<li class='$class folder selected' id='$val1->CodedName'><span><a href='?id=$val1->CodedName'>".substr($val1->CodedName,0,2)." ".$val1->PreferredName." ".$img."</a></span><ul>";
		//if(substr($l2,-2)=="00" || $l1){
		$l2x=$this->getLevel2(substr($val1->CodedName,0,2));
		
		foreach($l2x as $val2){
			$img="";
			if($l1!=substr($val2->CodedName,0,2)){
				continue;
			}else{
			//dd($l2);	
			$img="";
			if($val2->MKKeyword!='0'){
				
				$IdCC=$val2->IdCC;
				$keys=$this->getKeywords($IdCC);
				$kval="";
				if(is_array($keys)){
				foreach($keys as $key){
					$kval=$kval.$key->KeywordValue;
				}}
				$img="<img src='img/s.png' data-toggle='tooltip' title='Keywords: ".$kval."'/>";
			}
			$class="";
			if($val2->CodedName==$l2i."0000"){
				$class="expanded";
			}
			
			$str=$str."<li class='$class folder' id='$val2->CodedName'><span><a href='?id=$val2->CodedName'>".substr(chunk_split(substr($val2->CodedName,0,4),2,'-'),0,-1)." ".$val2->PreferredName." ".$img."</a></span><ul>";
if(substr($l2i,-2)!="00")	{
	
	$l3x=$this->getLevel3(substr($val2->CodedName,0,4));
	
		foreach($l3x as $val3){
			$img="";
			if($l2i!=substr($val3->CodedName,0,4)){
				//dd($l2);
				continue;
			}else{
				
				$img="";
			if($val3->MKKeyword!='0'){
				
				$IdCC=$val3->IdCC;
				$keys3=$this->getKeywords($IdCC);
				$kval="";
				//dd($keys3);
				if(is_array($keys3)){
				foreach($keys3 as $key3){
					$kval=$kval.$key3->KeywordValue;
				}
				}
				$img="<img src='img/s.png' data-toggle='tooltip' title='Keywords: ".$kval."'/>";
			}
			$class="";
			if($val3->CodedName==$l3."00"){
				$class="expanded";
			}
				$str=$str."<li class='$class folder' id='$val3->CodedName'><span><a href='?id=$val3->CodedName'>".substr(chunk_split(substr($val3->CodedName,0,6),2,'-'),0,-1)." ".$val3->PreferredName." ".$img."</a></span><ul>";
if(substr($l3,-2)!="00")	{
				$l4x=$this->getLevel4(substr($val3->CodedName,0,6));
				//dd($l4x);
		foreach($l4x as $val4){
			$img="";
			if($l3!=substr($val4->CodedName,0,6)){
				//dd($l2);
				continue;
			}else{
				
			if($val3->MKKeyword!='0'){
				
				$IdCC=$val4->IdCC;
				$keys3=$this->getKeywords($IdCC);
				$kval="";
				//dd($keys3);
				if(is_array($keys3)){
				foreach($keys3 as $key3){
					$kval=$kval.$key3->KeywordValue;
				}
				}
				$img="<img src='img/s.png' data-toggle='tooltip' title='Keywords: ".$kval."'/>";
			}
			$class="";
			if($val3->CodedName==$l3."00"){
				$class="expanded";
			}
				$str=$str."<li data-icon='img/bsp.png' id='$val4->CodedName'><span><a href='?id=$val4->CodedName'>".substr(chunk_split(substr($val4->CodedName,0,8),2,'-'),0,-1)." ".$val4->PreferredName." ".$img."</a></span></li>";
	
			}}}
		$str=$str."</ul></li>";
		}}
		}
		$str=$str."</ul></li>";
		} }//}
		$str=$str."</ul></li>";
		}
		$str=$str."</ul>";
	$listx = DB::table('company_template_tree_atlas_copco')->where('template', '=',session("template"))->get();
	//dd($list);
	foreach($listx as $li){
		$strx=$li->CodedName;
		$strx=explode(',',$strx);
		foreach($strx as $val){
			$str1=$str1.$val."<br>";
		}
	}
	return view("admin",["str"=>$str],["str1"=>$str1]);
		
	}
	private function getVA($IrdiVA){

		$l1 = DB::table('eclass9_1_va')->where('IrdiVA', '=',$IrdiVA)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->PreferredName;
}	
return $str;		
}
private function getPRVAIDVal($id){

		$l1 = DB::table('eclass9_1_cc_pr_va_suggested_incl_constraints_en')->where('id', '=',$id)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->IrdiVA;
}	
return $str;
	
}
	private function getPRVA($IrdiPR){
		
		$l1 = DB::table('eclass9_1_cc_pr_va_suggested_incl_constraints_en')->where('IrdiPR', '=', $IrdiPR)->limit(205)->get();
	
	return $l1;	
	}
	private function getUNM($IrdiUN){
		$l1 = DB::table('eclass9_1_un_en')->where('IrdiUN', '=',$IrdiUN)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->SINotation;
}	
return $str;	
	}
	private function getIrdiPR($irdicc){
		$l1 = DB::table('eclass9_1_cc_pr_en')->where('IrdiCC', '=',$irdicc)->get();
	return $l1;
	}
	private function getIrdiPRID($IrdiPR){
		$l1 = DB::table('eclass9_1_pr_en')->where('IrdiPR', '=',$IrdiPR)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->id;
}	
return $str;
}	
	private function getIrdiPRName($irdiprid){
		$l1 = DB::table('eclass9_1_pr_en')->where('id', '=',$irdiprid)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->PreferredName;
}	
return $str;
}	

	private function getLevel4($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%'],['CodedName', '!=',$CodedName.'00']])->get();
	return $l1;
	}
	private function getLevel2($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%0000%'],['CodedName', '!=',$CodedName.'000000']])->get();
	return $l1;
	}
	private function getLevel3($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%00%'],['CodedName', '!=',$CodedName.'0000']])->get();
	return $l1;
	}
	private function getLevel5($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where('CodedName', '=',$CodedName)->get();
	return $l1;
	}

	private function getKeywords($IdCC){
		$l1 = DB::table('eclass9_1_kwsy_en')->select("KeywordValue")->where('IdCC', '=',$IdCC)->get();
	$str="";
foreach($l1 as $val){
	$str=$str.$val->KeywordValue.",";
}	
return $str;
	}
	public function template(){
		$msg="";
		$l2 = DB::table('company_template_tree_atlas_copco')->get();
		if(isset($_GET['template'])){
			$template=$_GET['template'];
			$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
			if(count($l1)==0){
				$msg="Template name created.";
				DB::table('company_template_tree_atlas_copco')->insert(['template' => $template,"CodedName"=>""]);
				session(['template' => $template]);
			}
			else{
				$msg="Template name already exist.";
			}
		}
	
	return view("template",["msg"=>$msg],["list"=>$l2]);
	}
}