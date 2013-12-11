<?php
include("connection.php");
include("mm_php_library.php");

server_connect();

session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

$text_question = isset($_REQUEST["text_question"]) ? $_REQUEST["text_question"] : "";
$answer1 = isset($_REQUEST["answer1"]) ? $_REQUEST["answer1"] : "";
$answer2 = isset($_REQUEST["answer2"]) ? $_REQUEST["answer2"] : "";
$answer3 = isset($_REQUEST["answer3"]) ? $_REQUEST["answer3"] : "";
$answer4 = isset($_REQUEST["answer4"]) ? $_REQUEST["answer4"] : "";;
$correct_answer = isset($_REQUEST["correct_answer"]) ? $_REQUEST["correct_answer"] : "";

//DELETME
//print($text_question.", ".$answer1.", ".$answer2.", ".$answer3.", ".$answer4.", ".$correct_answer."<br/>");

if(($text_question == "" )|| ($answer1 == "") || ($answer2 == "" ) ||
   ($answer3 == "" ) || ($answer4 == "" ) || ($correct_answer == "" )) {
	print("There are some empty field...<br/><br/>");
    print("<a href='submit_question.php'>Back To Submit A Quiz</a>");	
	return;
} 

$MAX_FILESIZE = 1024 * 1024 * 10;
$upload_folder = "../files/";

$supported_extensions = array (
    "png" => "image/png",
    "gif" => "image/gif",
    "jpg" => "image/jpeg",
    "jpeg" => "image/jpeg",
    "mp3" => "audio",
    "mp4" => "video",
    "flv" => "video",
);

//from http://www.php.net/manual/en/features.file-upload.errors.php#53278
$file_error_codes = array( 
    0=>"There is no error, the file uploaded with success", 
    1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
    2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    3=>"The uploaded file was only partially uploaded", 
    4=>"No file was uploaded", 
    6=>"Missing a temporary folder"
);

//dump_array_pretty($_FILES);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
 <head>
 	<title>VERIFY A SUBMISSION</title>
	<script src="../js/source/jquery-1.10.2.min.js" type="text/javascript"></script>	
	<script src="../js/check_empty.js" type="text/javascript"></script>
 </head>
 <body>
 
 <header>
  <h1>SiQuoia - <?php print($username); ?>'s page</h1><hr>  
 </header>
 
 <div class="content">
 <h2>VERIFY A SUBMISSION</h2>
  <hr>
  <?php
  $file_field = "multimedia_question";

// Creating new question and insert into question
// 1) generate new qid

	// Fetch the maximum value of the question id
	$table_name = "question";
	$new_qid = get_max_id($table_name);

if (isset($_FILES[$file_field]) && isset($_FILES[$file_field]["tmp_name"]) && isset($_FILES[$file_field]["name"])) {

/*    if ($_FILES[$file_field]["error"] == 4) { //NO FILE UPLOADED    
        print("<h1>no file?</h1>");     
    }

    if ($_FILES[$file_field]["error"] != 0) {
        print("<h1>ERROR! " . $file_error_codes[$_FILES[$file_field]["error"]] . "</h1>");
	    print("<a href='submit_question.php'>Back To Submit A Quiz</a>");
	    return;	
    }
*/  
    $tmpfilename = $_FILES[$file_field]["tmp_name"];
    $size = filesize($tmpfilename);
    if ($size > $MAX_FILESIZE) {
        echo "<h1>ERROR, TOO LARGE</h1>";
    	print("<a href='submit_question.php'>Back To Submit A Quiz</a>");
    	return;

    }
    
//    $base = strtolower(pathinfo($tmpfilename, PATHINFO_BASENAME));
    $extension = strtolower(pathinfo($_FILES[$file_field]["name"], PATHINFO_EXTENSION));

// 2) change temp file name to "qid.extension"
    if (isset($supported_extensions[$extension]))  {
        $base = $new_qid . "." . $extension;
        $filename = $upload_folder . $base;
        move_uploaded_file($tmpfilename, $filename);
//DELETEME
//        echo "<h1>File uploaded to " . $filename . "</h1>";
        
    } 
    /*else {
        echo "<h1>ERROR, Unsupported file type</h1>";
   	 	print("<a href='submit_question.php'>Back To Submit A Quiz</a>");
    	return;
    }    
    */
}

// 3) insert into question. LEAVE subtopicid as NULL and ADD submitedby
	// TEMPORARY...st6 = misc
	$subtopicid = "st6";
	$base = (isset($base)) ? $base : "";
	$query2  = "INSERT INTO question VALUES ('".
				$new_qid."','".$text_question."','".$base."','".
				$answer1."','".$answer2."','".$answer3."','".$answer4."','".
				$correct_answer."','".$subtopicid."',0,0,'".$userid."',null)";

    $result2 = pdo_query($query2);
	
	if($result2 == false) {
        print("Failed to create new question: " . pdo_errorInfo() . "<br />");
		pdo_rollback();
	} else {
		print("Your submission was successfully sent.<br/>".
			"After your question is accepted, you will see the new score.<br/><br/>");
	}

    print("<a href='submit_question.php'>Back To Submit A Quiz</a>");

  ?>

  <br/><br/>
	
	<div id="menu"><a href='menu.php'>Menu</a></div>
	<div id="logout"><a href='logout.php'>Logout</a></div> <!--COMPLETE-->

 </div>

 <footer>
  <hr>
  <section>
<!--<div>created by SQ4</div>-->
<img src="../files/sq04/sq04.png" alt='sq04 logo' height='60' width='150'>	
  </section>
 </footer> 
 </body>
 
</html>
<?php
server_disconnect();
?>
