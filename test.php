<?php
error_reporting(E_ERROR | E_PARSE);
include("imdb.php");
$movieName = $_REQUEST["search"];
$i = new Imdb();
$mArr = $i->getActorInfo($movieName);
$k=0;
while($k<3){
$review[$k] = $i->getMovieReview($mArr[$k]['title_id']);
$k++;
}
$data = array_flatten($review);


function array_flatten($review) { 
  if (!is_array($review)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($review as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 
//echo json_encode($review);
?>
<!DOCTYPE html>
<html>
<head>
	<link href="http://fonts.googleapis.com/css?family=Kadwa" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
	font: 15px/1.5em "Kadwa", sans-serif;
}
 td {
    padding: 5px;
}
 th {
    padding: 5px;
	font: 20px/1.5em "Kadwa", sans-serif;
	font-weight: bold;
}
</style>
<body>


<div id="id01"></div>
<script>
var myArray = <?php echo json_encode($mArr);?>;
var myArray1 = <?php echo json_encode($data);?>;



myFunction(myArray,myArray1);


function myFunction(arr,arr1) {
    var out = "<table><th> Movie Display Picture </th><th> Name </th><th> Rating </th><th> Top-Review </th>";
    var i;
	var j=0;
    for(i = 0; i < arr.length; i++) {

        out += '<tr>'+
			   '<td>'+
			   '&nbsp;<img src="'+ arr[i].poster +'">&nbsp;'+
			   '</td>'+
			   '<td>'+
			  '<a href ="'+arr[i].imdb_url+'">'+arr[i].title +'</a>'+
			   '&nbsp;('+ 
			   arr[i].year +')&nbsp;<br>'+
			   arr[i].mpaa_rating +'&nbsp;|&nbsp;'+
			   arr[i].runtime +'mins&nbsp;|&nbsp;'+
			   arr[i].genres +'&nbsp;<br>'+
			   arr[i].release_date +'&nbsp;|&nbsp;'+
			   arr[i].country+'&nbsp;'+
			   '</td>'+
			   '<td>'+
			   arr[i].rating +'&nbsp;/10 from<br>'+ 
			   arr[i].votes +'&nbsp;users'+
			   '</td>'+
			   '<td><b>'+
			  '<ol><li>'+arr1[j+6] +'&nbsp;&nbsp;</b><br>(by '+ 
			   arr1[j] +'&nbsp;&nbsp;'+
			   arr1[j+9]+ ' )&nbsp;&nbsp;<br><br>'+
			   arr1[j+3] +'&nbsp;&nbsp;<br><br>'+'</li>'+
			   '<b><li>'+arr1[j+7] +'&nbsp;&nbsp;</b><br>(by '+ 
			   arr1[j+1] +'&nbsp;&nbsp;'+
			   arr1[j+10]+ ' )&nbsp;&nbsp;<br>'+
			   arr1[j+4] +'&nbsp;&nbsp;<br><br>'+'</li>'+			   
			   '<b><li>'+arr1[j+8] +'&nbsp;&nbsp;</b><br>(by '+ 
			   arr1[j+2] +'&nbsp;&nbsp;'+
			   arr1[j+11]+ ' )&nbsp;&nbsp;<br>'+
			   arr1[j+5] +'&nbsp;&nbsp;<br><br>'+'</li>'+
			   
			   '</ol></td>'+
			   '</tr>';
			   j+=12;
    }
	out+='</table>';
    document.getElementById("id01").innerHTML = out;
}
</script>

</body>
</html>


