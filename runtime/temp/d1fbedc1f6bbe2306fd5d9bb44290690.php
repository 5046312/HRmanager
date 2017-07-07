<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\phpStudy\WWW\hr/application/index\view\index\login.html";i:1499324626;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="<?php echo url('index/index/loginAct'); ?>" method="post">
    <input type="text" name="uname">
    <input type="text" name="upass">
    <input type="submit">
</form>
</body>
</html>