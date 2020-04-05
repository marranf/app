
<?php
$sql="SELECT * FROM test_left_menu order by pos asc";
app\core\DB::getInstance($data);
$is_active = $_SESSION['user_id'];
$res=app\core\DB::query($sql);     //вывод меню
if($res)
{
    while($row=app\core\DB::fetch_object($res))
    {
		if($row->name == "Войти" && $is_active)
			continue;
		if($row->name == "Выйти" && !$is_active)
			continue;
        echo "<b><a href=/".$row->href.">".$row->name."</a></b><br>";
    }
}