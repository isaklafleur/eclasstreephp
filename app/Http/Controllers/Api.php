<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Api extends Controller
{
    //
	public function index(){
		if(isset($_GET["data2"])){
		$id=$_GET["data2"];
		$IrdiVA1=$this->getPRVAIDVal($id);
		$l1 = DB::table('eclass9_1_va')->where('IrdiVA', '=',$IrdiVA1)->get();
			echo "<table cellpadding='5' cellspacing='1' class='cart' style='font-size:12px;' summary='Results'>
	<tbody>
<tr>";
		foreach($l1 as $val){
			$def=str_replace('"','',$val->Definition);
			echo "<tr>
	
	<th scope='row'>Value:</th><td> $IrdiVA1 </td>
	</tr>
	<tr>
	<th scope='row'>Classification:</th><td> $val->PreferredName</td>
	</tr>
	<tr>
	<th scope='row'>Short Name:</th><td> $val->ShortName</td>
	</tr>
	<tr>
	<th scope='row'>Definition:</th><td> $def</td>
	</tr>
	<tr>
	<th scope='row'>Properties:</th><td></td>
	</tr>";
		}
		}
		if(isset($_GET["data1"])){
			$id=$_GET["data1"];
		echo "<table cellpadding='5' cellspacing='1' class='cart' style='font-size:12px;' summary='Results'>
	<tbody>
<tr>";
	$l1 = DB::table('eclass9_1_pr_en')->where('id', '=',$id)->get();
	foreach($l1 as $val){
		$prop=explode('#',$val->IrdiPR)[1].' '.$val->PreferredName;
		$def=str_replace('"','',$val->Definition);
		$unit=$this->getUNM($val->IrdiUN);
		$IrdiVA=$this->getPRVA($val->IrdiPR);

		echo "<tr>
	
	<th scope='row'>Property:</th><td> $prop  </td>
	</tr>
	<tr>
	<th scope='row'>Short name:</th><td> $val->ShortName</td>
	</tr>
	<tr>
	<th scope='row'>Format:</th><td> $val->DataType</td>
	</tr>
	<tr>
	<th scope='row'>Unit of measure:</th><td> $unit</td>
	</tr>
	<tr>
	<th scope='row'>Definition:</th><td>$def</td>
	</tr>
	
	<tr>
	<th scope='row'>Values:</th><td></td>
	</tr> 
    <tr>
   <td colspan='2'>
      <ul class='classic'>";
	
	
	   if (!empty($IrdiVA)) {
        
         
            
            $count=0;
            foreach ($IrdiVA as $val5) {
				$count++;
				if($count>=176){
					break;
				}else{
          $name=$this->getVA($val5->IrdiVA); 
			 echo "  
         <li><label onclick='openValue1($val5->id)' style='color:#014188;text-decoration:underline;cursor:pointer;'>$val5->IrdiVA - 
            </label>$name
         </li>
      ";
				}  
            }
             
     echo "   
      </ul>
   </td>
<td><div class='imageCategory bold'><p class='center'>Exemplary representation</p><a href='http://www.eclass-pictures.com' target='_blank'><img alt='class image' src='http://www.eclass-pictures.com/eimage.php?coded=15110101&amp;size=300' class='imageCategory'></a></div>";        
  echo "</td></tr>";    
    }
	}
		}
	if(isset($_GET["data"])){
		$CodedName=$_GET["data"];
		$level=$_GET["level"];
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
			$ar[]=["name"=>substr(chunk_split(substr($val2->CodedName,0,4),2,'-'),0,-1)." ".$val2->PreferredName." ".$img,"CodedName"=>$val2->CodedName];
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
			$ar[]=["name"=>"<a href='?id=$val2->CodedName'>".substr(chunk_split(substr($val2->CodedName,0,6),2,'-'),0,-1)." ".$val2->PreferredName." ".$img."</a>","CodedName"=>$val2->CodedName];
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
			$ar[]=["name"=>"<a href='?id=$val2->CodedName'>".substr(chunk_split(substr($val2->CodedName,0,8),2,'-'),0,-1)." ".$val2->PreferredName." ".$img."</a>","CodedName"=>$val2->CodedName];
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
			   
         <li><label onclick='openValue($irdiprid)' style='color:#014188;text-decoration:underline;cursor:pointer;'>$val4->IrdiPR</label> - $name
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
	
}
