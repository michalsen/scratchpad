<?php


 if($_REQUEST['klouterator']){

  $final_list    = array();
  $klout_array   = array();

  require_once("KloutAPIv2.class.php");
  $kloutapi_key = "APIKEY";
  $klout = new KloutAPIv2($kloutapi_key);

  $klout_array   = explode("\n",$_REQUEST['klout_names']);
  $network   = 'twitter';

foreach($klout_array as $key=>$value){
 if(!strlen($value) == 0){
  
   $kloutid = $klout->KloutIDLookupByName($network,chop($value));
 if($kloutid){
   $result = $klout->KloutUser($kloutid);
   $networkdata = $klout->KloutIDLookupReverse($network,$kloutid);
   $json_feed = json_decode($result, true);
   array_push($final_list, $json_feed['nick'] . ' ' . round($json_feed['score'][score]));
   }
  }
 }
}


?>

<div class="klouterator">
<fieldset>
<legend>Klout/Twitter Lookup</legend>
<i>put in a Twitter handle on each row.</i><br>
<form name="klouterator" method=POST>
<textarea name="klout_names" rows=10 cols=20>
<?php if(isset($_REQUEST['klout_names'])) print $_REQUEST['klout_names'];?>
</textarea>
<input type=submit name="klouterator" value=Go>
</form>
</fieldset>
</div>

<?php

$final_ist = sort($final_list);
$unique_list = array_unique($final_list);

if( $_REQUEST['klouterator'] ){
print '<textarea cols=40 rows=25 id="txtarea" onClick="SelectAll(\'txtarea\');">';
 foreach($unique_list as $ul){
    print $ul . "\n";
  }
print '</textarea>';
}

?>
