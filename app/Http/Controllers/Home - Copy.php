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
		if(isset($_GET["template"])){
		session(['template' => $_GET["template"]]);	
		}
		if(session('template')==null){
			//redirect()->route('template');
			echo "<a href='template'>Create or select a template</a>";
			//header("Location:template");
			//$this->template();
		}
	else{
	$l1 = DB::table('eclass9_1_cc_en')->where('CodedName', 'like','%000000%')->get();
	$str="<ul>";
	foreach($l1 as $val1){
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
			//dd($this->isSelected("18000000"));
			if($this->isSelected($val1->CodedName)==true){
				$class=$class." selected";
							}
			$str=$str."<li class='$class folder' id='$val1->CodedName'><span>".substr($val1->CodedName,0,2)." ".$val1->PreferredName." ".$img."</span></li>";
	
	}
		//$str=$str."</li>";
		
		$str=$str."</ul>";
	
	
	return view("header",["str"=>$str]);
	}
	}
	private function getKeywords($IdCC){
		$l1 = DB::table('eclass9_1_kwsy_en')->select("KeywordValue")->where('IdCC', '=',$IdCC)->get();
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
	private function getLevel4($CodedName){
		$l1 = DB::table('eclass9_1_cc_en')->where([['CodedName', 'like',$CodedName.'%'],['CodedName', '!=',$CodedName.'00']])->get();
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
}
