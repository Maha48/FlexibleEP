<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login</title>
</head>

<body>
    <form  name ="loginform"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <?php 
            $nameErr = $passErr  = "";
           
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["usernameadmin"])) {
        if (!empty($_POST["passwordadmin"])) {
           
         
            header("location: data.php");
        } 
    }
    else {
        $emailErr = "Password is required";
        $nameErr = "username is required";}
}
   ?>
        <div id="basicdiv">
            <img id="psauimage" src="images/Prince_Sattam_Bin_Abdulaziz_University.png">
            <img id="fepimage" src="images/FEP.png">
            <hr style="width:400px">
            <div id="inputdiv">
                <table>
                    <tr>
                        <td class="usernameinput">Username</td>
                        <td><input type="text" name="usernameadmin">
                        <span class="error">* <?php echo $nameErr;?></span>
                    </td>
                </tr><br>
                <tr>
                    <td class="usernameinput">Password</td>
                    <td><input type="password" name="passwordadmin">
                    <span class="error">* <?php echo $emailErr;?></span></td>
                </tr><br>
            </table> <br>
            <input id="loginsubmit" type="submit" value="Login">
        </div>
    </div>
</form>
</body>

</html>
