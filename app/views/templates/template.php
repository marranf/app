<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="/views/templates/index.css">

</head>
<body bgcolor="#DDECE9">


<header>
<br><h1 align="left" style="margin-left: 450px;"></h1><br>

</header>

<nav class="side_left">
<?php
	include $menu;
    
?>
</nav>

<aside class="side_right">
    <h3>Системные сообщения</h3>
    <?php
    if($data->get("added_task_ok"))
        echo $data->get("added_task_ok")."<br>";
    if($data->get("admin_enter"))
        echo $data->get("admin_enter");
    ?>
</aside>
<article>
<?php
    include $view;
?>
</article>

<footer>
<p><b>&lt;footer&gt;</p>
</footer>
</body>
</html>
