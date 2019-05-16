<?php
//echo password_hash('MMLG123', PASSWORD_BCRYPT);
require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// نستطيع الان قراءة المتغيرات من الملف
$db_host = getenv('DB_host'); //استدعاء البيانات من الملف المحتوي على البيانات الحساسه
$db_username = getenv('DB_username');
$db_password = getenv('DB_password');
$Database = getenv('DB');
$db_adminuser=getenv('DB_adminname');
$db_adminpassword=getenv('DB_adminpassword');
// echo $db_host;
// echo $db_username;
// echo $Database;
$Adminusername = $_POST['usernameadmin']; //استدعاء البيانات من صفحة الHTML login.html
$Adminpassword = $_POST['passwordadmin'];
$connection = mysqli_connect($db_host, $db_username, $db_password, $Database, '8889'); //الاتصال بقاعدة
$Username = mysqli_real_escape_string($connection, $Adminusername);
$Password = mysqli_real_escape_string($connection, $Adminpassword);
//التحقق من ان كلمة المرور واسم المستخدم ليست فارغه
if (isset($Adminusername)&&!empty($Adminusername)) {
    if (isset($Adminpassword)&&!empty($Adminpassword)) {
    
} 
}
//الاستعلام عن اسم المستخدم وكلمة المرور
$query=mysqli_query($connection,"select * from Admin where $db_adminuser='$Adminusername' AND $db_adminpassword='$Adminpassword'")
    or die("failed to query database " . mysqli_error($connection));
$result = mysqli_fetch_array($query);
//التحقق من ان اسم المستخدم وكلمة المرور موجوده بقاعدة البيانات
if ($result > 0) {
    echo "Welcome Admin";
} else {
     header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>
<form method="Post"action="logout.php">
<input type="submit"value="Logout">
</form>