<html>
    <head>
<link rel="stylesheet" type="text/css" href="data.css">
</head>
<?php
require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
// نستطيع الان قراءة المتغيرات من الملف
$db_host = getenv('DB_host'); //استدعاء البيانات من الملف المحتوي على البيانات الحساسه
$db_username = getenv('DB_username');
$db_password = getenv('DB_password');
$Database = getenv('DB');

$connection=mysqli_connect($db_host,$db_username,$db_password,$Database,'8889');

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0){
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 110000, ";")) !== FALSE) {
            $sqlInsert = "INSERT into Examdata (Class_ID,Subject_ID,Student_ID,Subject_name,exam_days,exam_dates,exam_times)
            values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "')";
            $result=mysqli_query($connection,$sqlInsert);
            if (! empty($result)){
                $message="data imported to database ";
            }
            else{ 
                $message="problem in importing data";
                
            } 

        }
    }
}
if(isset($_POST['delete'])){
    $sqldelete="delete from Examdata";
    $result=mysqli_query($connection,$sqldelete);
}
?>

<div id="bar">
<div id="wlcomeadmin">Welcome Admin</div>
</div>

<div id="uploadfile">
<div id="uploaddiv">    
<div id="response" class=""><?php if(!empty($message)) { echo $message; } ?></div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label for="img">
                        <input type="file" name="file"id="img" accept=".csv">
                        <img src="images/upload-2.png"id="img">
                    </label><br>
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> 
                    <input type="submit" name="import" value="Import"class="btn-submit">
                       
                        <input type="submit"value="Delete"name="delete">
                    <br />

                </div>

            </form>
        </div></div></div></div>









