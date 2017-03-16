<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Adminapi extends Controller
{
    //
	

	public function getParent($id){
		if(substr($id, -6)=='000000'){
return $id;
		}else if(substr($id, -4)=='0000'){
			return substr($id, 0,2).'000000';
		}else if(substr($id, -2)=='00'){
			return substr($id, 0,4).'0000';
		}else{
			return substr($id, 0,6).'00';
		}
	}

	public function getLev($id){
			if(substr($id, -6)=='000000'){
return 1;
		}else if(substr($id, -4)=='0000'){
			return 2;
		}else if(substr($id, -2)=='00'){
			return 3;
		}else{
			return 4;
		}	
	}
	public function update(){
			if(isset($_GET["values"])){
			$urlid=$_GET["urlid"];
			$urlid1=$_GET["urlid1"];
			$template=session('template');
			$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
$parent=$this->getParent($urlid);

			$skipid=substr($urlid,0,2);
			$ar=array();
			$str="";
			$ar1=array();
			$newstr="";
			foreach($l1 as $val){
				$newstr=$newstr.$val->CodedName.",";
				
			}
		
			$newstr=substr($newstr, 0,strlen($newstr)-1);
			$valuesd=explode(",", $newstr);
			$vd=array();
			foreach ($valuesd as  $value) {
				if($value!=$parent){
				$vd[]=$value;
$str=$str.$value.",";
			}
			}
			//dd($valuesd);
			$valuesd=$vd;
		//dd($valuesd);
			
			$getar=explode(',', $_GET['values']);
			$getar1=array();
			foreach ($getar as $value) {
				if($value!=$urlid){
					$getar1[]=$value;
				}
			}
			$ard=array_diff($getar1,$valuesd);
			$valuesd=array_merge($valuesd,$ard);
			
		
			if(in_array($urlid, $valuesd)){
				$str="";
foreach ($valuesd as $value) {
	
	if($value!=$urlid){
		$str=$str.$value.',';
//echo $value."<br>";
	}

	
}
			}else{
				if($urlid1=='1'){
		
					$str=$str.$urlid.",";
					//dd($str);
				}else{
					$id=$urlid;
					$l1=substr($id,0,2);
		$l1r=substr($id,-6);
		$l2i=substr($id,0,4);
		$l2r=substr($id,-4);
		$l3=substr($id,0,6);
		$l3r=substr($id,-2);
		$l4=substr($id,0,8);
foreach ($valuesd as $value) {
	if($l1r=="000000"){
if(substr($value, 0,2)!=substr($urlid, 0,2)){
$str=$str.','.$value;
}
	}
	else if($l2r=="0000"){
if(substr($value, 0,4)!=substr($urlid, 0,4)){
$str=$str.','.$value;
}
	}
		else if($l3r=="00"){
if(substr($value, 0,6)!=substr($urlid, 0,6)){
$str=$str.','.$value;
}
	}


}

foreach ($getar as $value) {

if(substr($value, 0,2)==substr($urlid, 0,2)){
					$str=$str.','.$value;
}
}
				}
			
			}
			$vlx=explode(',', $str);
	
			$vlx=array_unique($vlx);
			$nst='';
			foreach ($vlx as $value) {
				
				if($value!=''){
					if($this->getLev($urlid)==1 && $urlid1=='0' && substr($value, 0,2)==substr($urlid, 0,2)){

					}else{
					$nst=$nst.$value.",";
				}
			}
			}

			echo $nst;
			DB::table('company_template_tree_atlas_copco')
            ->where('template', $template)
            ->update(["CodedName"=>$nst]);
		}
	}
	public function index(){
		if(isset($_GET["data"])){
		$CodedName=$_GET["data"];
		$level=$_GET["level"];
		$template=session("template");
		if($level=='2'){
		$l2=$this->getLevel2($CodedName);
		$ar=array();
		
		foreach($l2 as $val2){
				$img="";
				//echo $val2->MKKeyword;
			if($val2->MKKeyword!='0'){
				
				$IdCC=$val2->IdCC;
				$keys=$this->getKeywords($IdCC);
				$kval="";
				if(is_array($keys)){
				foreach($keys as $key){
					$kval=$kval.$key->KeywordValue;
				} }
				$img="<img src='img/s.png'  title='Keywords: ".$kval."'/>";
			}
			$ar[]=["selected"=>$this->getSelectedTreeL2($template,$val2->CodedName),"name"=>substr(chunk_split(substr($val2->CodedName,0,4),2,'-'),0,-1)." ".$val2->PreferredName." ".$img,"CodedName"=>$val2->CodedName];
		}
		//$ar1=array("result"=>$ar);
		echo json_encode($ar);
		}
		if($level=='3'){
		$l2=$this->getLevel3($CodedName);
		$ar=array();
		foreach($l2 as $val2){
					$img="";
			if($val2->MKKeyword!='0'){
				
				$IdCC=$val2->IdCC;
				$keys=$this->getKeywords($IdCC);
				$kval="";
				if(is_array($keys)){
				foreach($keys as $key){
					$kval=$kval.$key->KeywordValue;
				} }
				$img="<img src='img/s.png'  title='Keywords: ".$kval."'/>";
			}
			//dd($this->getSelectedTreeL3x($template,$val2->CodedName));
			$ar[]=["selected"=>$this->getSelectedTreeL3x($template,$val2->CodedName),"name"=>substr(chunk_split(substr($val2->CodedName,0,6),2,'-'),0,-1)." ".$val2->PreferredName." ".$img,"CodedName"=>$val2->CodedName];
		}
		//$ar1=array("result"=>$ar);
		echo json_encode($ar);
		}
		if($level=='4'){
		$l2=$this->getLevel4($CodedName);
		$ar=array();
		foreach($l2 as $val2){
					$img="";
			if($val2->MKKeyword!='0'){
				
				$IdCC=$val2->IdCC;
				$keys=$this->getKeywords($IdCC);
				$kval="";
				if(is_array($keys)){
				foreach($keys as $key){
					$kval=$kval.$key->KeywordValue;
				} }
				$img="<img src='img/s.png'  title='Keywords: ".$kval."'/>";
			}
			//dd($this->getSelectedTreeL4x($template,$val2->CodedName));
			$ar[]=["selected"=>$this->getSelectedTreeL4x($template,$val2->CodedName),"name"=>substr(chunk_split(substr($val2->CodedName,0,8),2,'-'),0,-1)." ".$val2->PreferredName." ".$img,"CodedName"=>$val2->CodedName];
		}
		//$ar1=array("result"=>$ar);
		echo json_encode($ar);
		}
		if($level=='5'){
		$l2=$this->getLevel5($CodedName);
		echo "<table cellpadding='5' cellspacing='1' class='cart' style='font-size:12px;' summary='Results'>
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
		echo "	<th scope='row'>Classification:</th><td> $cl $val2->PreferredName [$val2->IdCC] </td>
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
		echo "<tr>
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
			 echo "
			   
         <li><label style='color:#014188;text-decoration:underline;cursor:pointer;'>$val4->IrdiPR</label> - $name
         </li>
         
     ";
}
  echo "   
      </ul>
   </td>
<td><div class='imageCategory bold'><p class='center'>Exemplary representation</p><a href='http://www.eclass-pictures.com' target='_blank'><img alt='class image' src='http://www.eclass-pictures.com/eimage.php?coded=15110101&amp;size=300' class='imageCategory'></a></div>";        
  echo "</td></tr>";  
}
            }
		echo "</tr>
	</tbody>
	</table>";
		}
	}
	

		
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
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%'],['CodedName', '!=',$CodedName.'00'],['Level','=','4']])->get();
	return $l1;
	}
	private function getLevel2($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%0000%'],['CodedName', '!=',$CodedName.'000000'],['Level','=','2']])->get();
	return $l1;
	}
	private function getLevel3($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%00%'],['CodedName', '!=',$CodedName.'0000'],['Level','=','3']])->get();
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
	
	

	private function isSelected($CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',session("template"))->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	$key=array_search($CodedName,$code);
	return $key;

	}
	private function getSelectedTreeL2($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	asort($code);
	$l1x=array();

	foreach($code as $val1){
		$l1x[]=substr($val1,0,4);
	}
	$l1v=array_unique($l1x);
	$l1vx=array();
	foreach($l1v as $val){
		if(substr($CodedName,0,2)==substr($val,0,2)){
			$l1vx[]=$val;
		}
	}
	//dd($l1vx);
	$cn=substr($CodedName,0,4);
	$ret=array_search($cn,$l1v);
	if(count($l1vx)<=1){
		return true;
	}
	else{
		return $ret;
	}
		}
		private function getSelectedTreeL3($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	asort($code);
	$l1x=array();

	foreach($code as $val1){
		$l1x[]=substr($val1,0,6);
	}
	$l1v=array_unique($l1x);
	$l1vx=array();
	foreach($l1v as $val){
		if(substr($CodedName,0,4)==substr($val,0,4)){
			$l1vx[]=$val;
		}
	}
	//dd($l1vx);
	$cn=substr($CodedName,0,6);
	$ret=array_search($cn,$l1v);
	if(count($l1vx)<=1){
		return true;
	}
	else{
		return $ret;
	}
		}
				private function getSelectedTreeL3x($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	asort($code);
	$l1x=array();

	foreach($code as $val1){
		$l1x[]=substr($val1,0,6);
	}
	$l1v=array_unique($l1x);
	$l1vx=array();
	foreach($l1v as $val){
		if(substr($CodedName,0,4)==substr($val,0,4)){
			$l1vx[]=$val;
		}
	}
	//dd($l1vx);
	$cn=substr($CodedName,0,6);
	$ret=array_search($cn,$l1v);
	
		return $ret;
	
		}
				private function getSelectedTreeL4x($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	asort($code);
	$l1x=array();

	foreach($code as $val1){
		$l1x[]=substr($val1,0,8);
	}
	$l1v=array_unique($l1x);
		$l1vx=array();
	foreach($l1v as $val){
		if(substr($CodedName,0,6)==substr($val,0,6)){
			$l1vx[]=$val;
		}
	}
	//dd($l1vx);
	$cn=substr($CodedName,0,8);
	$ret=array_search($cn,$l1v);
	
		return $ret;

		}
			private function getSelectedTreeL4($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	asort($code);
	$l1x=array();

	foreach($code as $val1){
		$l1x[]=substr($val1,0,8);
	}
	$l1v=array_unique($l1x);
		$l1vx=array();
	foreach($l1v as $val){
		if(substr($CodedName,0,6)==substr($val,0,6)){
			$l1vx[]=$val;
		}
	}
	//dd($l1vx);
	$cn=substr($CodedName,0,8);
	$ret=array_search($cn,$l1v);
	if(count($l1vx)<=1){
		return true;
	}
	else{
		return $ret;
	}
		}
	
}
