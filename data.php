<html>
<head>
<link rel="stylesheet" type="text/css" href="data.css">
<script src="jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function(){
    $(".file1").click(function(){
        $(".import").show();
    });
});
</script>
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

$connection = mysqli_connect($db_host, $db_username, $db_password, $Database, '8889');
$queryempty='select * From Examdata';
$query=mysqli_query($connection,$queryempty)or die ("Error in query: $query. ".mysqli_error());
if(mysqli_num_rows($query) > 0){
    $message="There is data";

}
else{
    

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 110000, ";")) !== false) {
            $sqlInsert = "INSERT into Examdata (Class_ID,Subject_ID,Student_ID,Subject_name,exam_days,exam_dates,exam_times)
            values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "')";
            $result = mysqli_query($connection, $sqlInsert);
            if (!empty($result)) {
                $message = "Upload Done ";
            } else {
                $message = "Problem In Upload Data";

            }

        }
    }
}

}

if (isset($_POST['delete'])) {
    $sqldelete = "delete from Examdata";
    $result1 = mysqli_query($connection, $sqldelete);
    if (!empty($result1)) {
        $message = "Deleted Done";
    } 
}
?>
<body id="body">
 <div id="bar">
 <div id="wlcomeadmin">Welcome Admin
 </div>
 </div>

<div id="uploadfile">
<br>
<div id="outer-scontainer">
<div id="uploaddiv">

<div id="response"><?php if (!empty($message)) {echo $message;}?></div>
    <div class="row">
            <form class="form-horizontal" action="" method="post"
            name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="input-row">
                    <label>
                        <input type="file" name="file"id="file" class="file1"accept=".csv">
                        <img src="images/upload-2.png"id="file"><br>
                    </label><br><table id="tablebtn"> <tr> <td>
                    <label class="col-md-4 control-label">Choose CSV File to Upload </label></td>
                    <td><input  style="display:none"type='submit'id="import" name='import' class="import"value='Import'></td></tr>
                   <tr><td> <label> Delete The Current Data </label> </td>
                   <td> <input type="submit"value="Delete"name="delete" id="delete"></td></tr></table>
                    
                </div>
            </form>
        </div>
    </div>
</div>
</body>









