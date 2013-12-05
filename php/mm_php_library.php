<?php
/* Check the string if it has a certain string (needle)
return - true(or, 1) if the string has a needle
return - false if the string dosn't has a needle
*/
function find_category($hay, $needle){
 if($hay == null) {
	return false;
 }
$charlen_needle = strlen($needle);

$textpos = text_match($hay, $needle, $charlen_needle);
$numpos = is_numeric(substr($hay, $charlen_needle, 1));
 
 if($textpos && $numpos) {
 	return true;
 }
 
 return false;
} // find_category

/* Check if the string has numeric after category
return - true(or, 1) if the string has a needle
return - false if the string dosn't has a needle
*/
function text_match($hay, $needle, $charlen) {

 for($i = 0; $i < $charlen; $i++) {
	
	$needle_char = substr($needle, $i, 1);
	$hay_char = substr($hay, $i, 1);
	
	if($needle_char != $hay_char) {
		return false;
	}
 }
 return true;
} // text_match

?>