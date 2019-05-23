<?php
require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// نستطيع الان قراءة المتغيرات من الملف
$db_host = getenv('DB_host'); //استدعاء البيانات من الملف المحتوي على البيانات الحساسه
$db_username = getenv('DB_username');
$db_password = getenv('DB_password');
$Database = getenv('DB');

// echo $db_host;
// echo $db_username;
// echo $Database;
$Adminusername = $_POST['usernameadmin']; //استدعاء البيانات من صفحة الHTML login.html
$Adminpassword = $_POST['passwordadmin'];
$connection = mysqli_connect($db_host, $db_username, $db_password, $Database, '8889'); //الاتصال بقاعدة
$Username = mysqli_real_escape_string($connection, $Adminusername);
$Password = mysqli_real_escape_string($connection, $Adminpassword);

//الاستعلام عن اسم المستخدم وكلمة المرور
$query = mysqli_query($connection, "select * from Admin where Username='$Adminusername'")
or die("failed to query database " . mysqli_error($connection));
$result = mysqli_fetch_array($query);
$db_adminpassword = $result['Password'];

//التحقق من ان اسم المستخدم وكلمة المرور موجوده بقاعدة البيانات
if ($result > 0 && password_verify($Adminpassword, $db_adminpassword)) {
    echo "Welcome Admin";
} else {
    
    echo"<script> alert('username or password is Error ')</script>";
    echo "<script>
    window.location = '".$_SERVER['HTTP_REFERER']."';
    </script>";} 
?>
<form method="Post" action="logout.php">
<input type="submit" value="Logout">
</form>