<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Search extends Controller
{
    //
	public function index(){
if(isset($_GET['search'])){
	$type=$_GET["type"];
	if($type=="class"){
	$text=$_GET['search'];
	echo "<table cellpadding='5' cellspacing='1' class='cart' style='font-size:12px;' summary='Results'>
	<tbody>
<tr>";
$l1 = DB::table('eclass9_1_cc_en')->where('PreferredName', 'like','%'.$text.'%')->get();

foreach($l1 as $val){
	echo "<tr>
	<th scope='row'><a href='?id=$val->CodedName'>$val->CodedName</a></th><td> $val->PreferredName </td>
	</tr>";
}
$l2 = DB::table('eclass9_1_cc_en')->where('Definition', 'like','%'.$text.'%')->get();

foreach($l2 as $val1){
	echo "<tr>
	<th scope='row'><a href='?id=$val1->CodedName'>$val->CodedName</a></th><td> $val1->Definition </td>
	</tr>";
}
}}

}
}
