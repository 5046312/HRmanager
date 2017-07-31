<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\php\www\hr/application/index\view\center\huamingce.html";i:1501462423;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <ul>
        <li>
            1、<a href="/public/emp_import.xlsx">下载导入模板</a>
        </li>

        <form action="<?php echo url('index/center/importHuamingce'); ?>" method="post" enctype="multipart/form-data">
            <li>
                2、<input type="file" name='huamingce'>
                <input type="submit" value="导入excel">
            </li>
        </form>
    </ul>
</body>
</html>