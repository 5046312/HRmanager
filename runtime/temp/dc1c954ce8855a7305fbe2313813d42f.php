<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"E:\php\www\hr/application/index\view\center\selectcompany.html";i:1501472511;}*/ ?>
<!doctype html>
<html lang="ch">
<head>
    <meta charset="UTF-8">
    <title>选择</title>
</head>
<body>
<form action="<?php echo url('index/center/doSelectCompany'); ?>" method="post">
    <select name="company">
        
        <option value="1">1</option>
    </select>
    <input type="submit">
</form>
</body>
</html>