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

print($text_question.", ".$answer1.", ".$answer2.", ".$answer3.", ".$answer4.", ".$correct_answer."<br/>");

if(($text_question == "" )|| ($answer1 == "") || ($answer2 == "" ) ||
   ($answer3 == "" ) || ($answer4 == "" ) || ($correct_answer == "" )) {
	print("There are some empty field...<br/><br/>");
    print("<a href='submit_question.php'>Back To Submit A Quiz</a>");	
	return;
} //else {

$MAX_FILESIZE = 1024 * 1024 * 10;
$upload_folder = "../files/";

$supported_extensions = array (
    "png" => "image/png",
    "gif" => "image/gif",
    "jpg" => "image/jpeg",
    "jpeg" => "image/jpeg",
);

//from http://www.php.net/manual/en/features.file-upload.errors.php#53278
$file_error_codes = array( 
    0=>"There is no error, the file uploaded with success", 
    1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini", 
    2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    3=>"The uploaded file was only partially uploaded", 
    4=>"No file was uploaded", 
    6=>"Missing a temporary folder" ,
);

dump_array_pretty($_FILES);
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
    $query1  = "select max(qid) from question";
    $result1 = pdo_query($query1);
    $max_qid  = $result1->fetch();
    $curr_qid = $max_qid["max(qid)"];

    $id_numpart = substr($curr_qid, 1);
    $new_qid = "q" . ($id_numpart + 1);

	print("cur: ".$curr_qid.", new: ".$new_qid."<br/>");

// 2) change temp file name to "qid.extension"
// 3) insert into question. LEAVE subtopicid as NULL and ADD dubmitedby
/*     
	$query3  = "INSERT INTO question VALUES ('".$curr_id."','".$new_name."','".$new_email."',0,'".$bcrypt_pass."', '".$referringid."')";
    $result3 = pdo_query($query3);
	
	if($result3 == false) {
        print("Failed to create new question: " . pdo_errorInfo() . "<br />");
		pdo_rollback();
	}
  */      


if (isset($_FILES[$file_field]) && isset($_FILES[$file_field]["tmp_name"]) && isset($_FILES[$file_field]["name"])) {
    if ($_FILES[$file_field]["error"] == 4) {
        echo "<h1>no file?</h1>";     
        //NO FILE UPLOADED
        return;
    }
    if ($_FILES[$file_field]["error"] != 0) {
        echo "<h1>ERROR! " . $file_error_codes[$_FILES[$file_field]["error"]] . "</h1>";
        return;
    }
    
    $tmpfilename = $_FILES[$file_field]["tmp_name"];
    $size = filesize($tmpfilename);
    if ($size > $MAX_FILESIZE) {
        echo "<h1>ERROR, TOO LARGE</h1>";
        return;
    }
    
    $base = strtolower(pathinfo($tmpfilename, PATHINFO_BASENAME));

    $extension = strtolower(pathinfo($_FILES[$file_field]["name"], PATHINFO_EXTENSION));
    if (isset($supported_extensions[$extension]))  {
        //$questionId = "q001";
        $filename = $upload_folder . $new_qid . "." . $extension;
        move_uploaded_file($tmpfilename, $filename);
        echo "<h1>File uploaded to " . $filename . "</h1>";
        

        
        
    } else {
        echo "<h1>ERROR, Unsupported file type</h1>";
        return;
    }
    
    print("<a href='submit_question.php'>Back To Submit A Quiz</a>");
}
//}
  ?>

  <br/><br/>
	
	<div id="menu"><a href='menu.php'>Menu</a></div>
	<div id="logout"><a href='logout.php'>Logout</a></div> <!--COMPLETE-->

 </div>

 <footer>
  <hr>
  <section>
   <div>created by SQ4</div>
  </section>
 </footer> 
 </body>
 
</html>
<?php
server_disconnect();
?>
