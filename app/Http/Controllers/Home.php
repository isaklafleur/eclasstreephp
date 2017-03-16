<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Home extends Controller
{
    //
		public function template(){
		$msg="";
		
		if(isset($_GET['create'])){
			$template=$_GET['template'];
			$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
			if(count($l1)==0){
				$msg="Template name created.";
				DB::table('company_template_tree_atlas_copco')->insert(['template' => $template,"CodedName"=>""]);
				session(['template' => $template]);
				return redirect('');
			}
			else{
				$msg="Template name already exist.";
			}
		}
		if(isset($_GET['rename']) && isset($_GET['template'])){
			$x=DB::table('company_template_tree_atlas_copco')
            ->where('template', $_GET['value'])
            ->update(['template' => $_GET['template']]);
			//dd($x);
			$msg="Template name Updated. <a href='template'>Create New Template</a>";
		}
		if(isset($_GET['del'])){
		DB::table('company_template_tree_atlas_copco')->where('template', '=', $_GET['del'])->delete();
			//dd($x);
			$msg="Template Deleted. <a href='template'>Create New Template</a>";
		}
	$l2 = DB::table('company_template_tree_atlas_copco')->get();
	return view("template",["msg"=>$msg],["list"=>$l2]);
	}
	public function index(){
$c=0;
		if(isset($_POST['saveas'])){
	$c=1;
			$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',session('template'))->get();
			DB::table('company_template_tree_atlas_copco')->insert(['template' => $_POST["saveas"],"CodedName"=>$l1]);
		session(['template' => $_POST["saveas"]]);	
redirect("http://localhost/lv?template=".$_POST['saveas']);
		}
		if(isset($_GET["template"])){
		if($c==0){
		session(['template' => $_GET["template"]]);	
	}
		}
		if(session('template')==null){
			//redirect()->route('template');
			echo "<a href='template'>Create or select a template</a>";
			//header("Location:template");
			//$this->template();
		}
	else{
	$l1x = DB::table('eclass9_1_cc_en')->where('CodedName', 'like','%000000%')->get();
	$template=session("template");
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
			//dd($this->isSelected($val1->CodedName));
			if($this->isSelected($val1->CodedName)==true){
				$class=$class." selected";
							}
							$n98='';
								if(substr($val1->CodedName, 0,2)=='98' || substr($val1->CodedName, 0,2)=='99'){
					$n98="<a href='http://mentorxo.in/lv1/create/?CodedName=$val1->CodedName'  class='label label-danger'>Edit</a>";
				}
			$str=$str."<li class='$class folder' id='$val1->CodedName'><span><a href='?id=$val1->CodedName'>".substr($val1->CodedName,0,2)." ".$val1->PreferredName." ".$img."</a>".$n98."</span><ul>";
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
			//dd($this->getSelectedTreeL2x($template,$val2->CodedName));
			if($this->getSelectedTreeL2x_count($template,$val2->CodedName)==true){
				$class=$class." selected";
				//echo $val2->CodedName;
			}else{
			if($this->getSelectedTreeL2x($template,$val2->CodedName)!=false){
				$class=$class." selected";
				}			}
				$n98="";
				if(substr($val2->CodedName, 0,2)=='98' || substr($val2->CodedName, 0,2)=='99'){
					$n98="<a href='http://mentorxo.in/lv1/create/?CodedName=$val2->CodedName'  class='label label-danger'>Edit</a>";
				}
			$str=$str."<li class='$class folder' id='$val2->CodedName'><span><a href='?id=$val2->CodedName'>".substr(chunk_split(substr($val2->CodedName,0,4),2,'-'),0,-1)." ".$val2->PreferredName." ".$img."</a>".$n98."</span><ul>";
if(substr($l2i,-2)!="00")	{
	
	$l3x=$this->getLevel3(substr($val2->CodedName,0,4));
	//dd($l3x);
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
			if($this->getSelectedTreeL3x_count($template,$val3->CodedName)==true || $this->getSelectedTreeL2x_count($template,$val3->CodedName)==true){
				$class=$class." selected";
			}else{
				if($this->getSelectedTreeL3($template,$val3->CodedName)!=false){
				$class=$class." selected";
				}			}
				$n98="";
					if(substr($val3->CodedName, 0,2)=='98' || substr($val3->CodedName, 0,2)=='99'){
					$n98="<a href='http://mentorxo.in/lv1/create/?CodedName=$val3->CodedName'  class='label label-danger'>Edit</a>";
				}
				$str=$str."<li class='$class folder' id='$val3->CodedName'><span><a href='?id=$val3->CodedName'>".substr(chunk_split(substr($val3->CodedName,0,6),2,'-'),0,-1)." ".$val3->PreferredName." ".$img."</a>".$n98."</span><ul>";
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
				//$class="expanded";
			}
			//dd($this->getSelectedTreeL4x_count($template,$val3->CodedName));
			if($this->getSelectedTreeL4x_count($template,$val3->CodedName)==true || $this->getSelectedTreeL3x_count($template,$val3->CodedName)==true || $this->getSelectedTreeL2x_count($template,$val3->CodedName)==true ){
				$class=$class." selected";
			}else{
				//dd($this->getSelectedTreeL4($template,$val4->CodedName));
				if($this->getSelectedTreeL4($template,$val4->CodedName)!=false){
				$class=$class." selected";
				}			}
				$n98='';
					if(substr($val4->CodedName, 0,2)=='98' || substr($val4->CodedName, 0,2)=='99'){
					$n98="<a href='http://mentorxo.in/lv1/create/?CodedName=$val4->CodedName'  class='label label-danger'>Edit</a>";
				}
				$str=$str."<li class='$class' data-icon='img/bsp.png' id='$val4->CodedName'><span><a href='?id=$val4->CodedName'>".substr(chunk_split(substr($val4->CodedName,0,8),2,'-'),0,-1)." ".$val4->PreferredName." ".$img."</a>".$n98."</span></li>";
	
			}}}
		$str=$str."</ul></li>";
		}}
		}
		$str=$str."</ul></li>";
		} }//}
		$str=$str."</ul></li>";
		}
		$str=$str."</ul>";
	
	return view("header",["str"=>$str]);
	}
	}
	private function getKeywords($IdCC){
		$l1 = DB::table('eclass9_1_kwsy_en')->select("KeywordValue")->where('IdCC', '=',$IdCC)->get();
	return $l1;	
	}
	private function getLevel2($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%0000%'],['CodedName', '!=',$CodedName.'000000'],['Level','=','2']])->get();
		//dd($l1);
	return $l1;
	}
	private function getLevel3($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%00%'],['CodedName', '!=',$CodedName.'0000'],['Level','=','3']])->get();
	return $l1;
	}
	private function getLevel4($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%'],['CodedName', '!=',$CodedName.'00'],['Level','=','4']])->get();
	return $l1;
	}
		private function isSelected($CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',session("template"))->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	$valx=array();
	foreach($code as $val){
		$valx[]=substr($val,0,2);
	}
	$valx=array_unique($valx);
	$key=in_array(substr($CodedName,0,2),$valx);
	//dd($key);
	/*if($key==false){
		return false;
	}else{
		return true;
	}*/
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
	return $ret;
	/*if(count($l1vx)<=1){
		return true;
	}
	else{
		return $ret;
	}*/
		}
				private function getSelectedTreeL2x_count($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	//dd($code);
	asort($code);
	$l1x=array();
$l1x1=array();
	foreach($code as $val1){
		if(substr($val1,0,2)==substr($CodedName,0,2)){
		$l1x[]=substr($val1,0,2);
		$l1x1[]=$val1;
	}
	}
	//dd($l1x1);

	if(count($l1x1)==0){
		$l1x1[0]='x';
	}
	//dd($l1x1);
	if(substr($l1x1[0], -6)!='000000' || count($l1x)>1){
		return false;
	}else{
		return true;
	}
	
		}
					private function getSelectedTreeL3x_count($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	//dd($code);
	asort($code);
	$l1x=array();
$l1x1=array();
	foreach($code as $val1){
		if(substr($val1,0,4)==substr($CodedName,0,4)){
		$l1x[]=substr($val1,0,4);
		$l1x1[]=$val1;
	}
	}
	//dd($l1x);
	if(count($l1x1)==0){
		$l1x1[0]='x';
	}
	if(substr($l1x1[0], -4)!='0000' || count($l1x)>1){
		return false;
	}else{
		return true;
	}
	
		}

					private function getSelectedTreeL4x_count($template,$CodedName){
	$l1 = DB::table('company_template_tree_atlas_copco')->where('template', '=',$template)->get();
	$code="";
	foreach($l1 as $val){
	$code=$val->CodedName;	
	}
	$code=explode(',',$code);
	//dd($code);
	asort($code);
	$l1x=array();
$l1x1=array();
	foreach($code as $val1){
		if(substr($val1,0,6)==substr($CodedName,0,6)){
		$l1x[]=substr($val1,0,6);
		$l1x1[]=$val1;
	}
	}
	//dd(count($l1x));

	if(count($l1x1)==0){
		$l1x1[0]='x';
	}
	if(substr($l1x1[0], -2)!='00' || count($l1x)>1){
		return false;
	}else{
		return true;
	}
	
		}
			private function getSelectedTreeL2x($template,$CodedName){
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

		return $ret;
	
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
	/*if(count($l1vx)<=1){
		return true;
	}
	else{*/
		return $ret;
	//}
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
	/*if(count($l1vx)<=1){
		return true;
	}
	else{*/
		return $ret;
		}
}
