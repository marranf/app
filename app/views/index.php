<h2>Список задач</h2>
<table border="1px" style="cellpadding: 5px" width="100%">
    <tr>
        <?php
        if(isset($_SESSION['user_id']))
        {?>
        <td>Редактирование</td>
        <?
        }
        ?>
        <td >Имя</td>
        <td >Емаил</td>
        <td >Задача</td>
        <td >Завершена/отредактировано</td>
    </tr>
    <tr>
		<?php
		if(isset($_SESSION['user_id']))
		{?>
            <td></td>
			<?
		}
		?>
        <td><a href="/index/sort/user/asc/<?=$data['page']?>">по возрастанию</a><br>
            <a href="/index/sort/user/desc/<?=$data['page']?>">по убыванию</a> </td>
        <td><a href="/index/sort/email/asc/<?=$data['page']?>">по возрастанию</a><br>
            <a href="/index/sort/email/desc/<?=$data['page']?>">по убыванию</a> </td>
        <td><a href="/index/sort/task/asc/<?=$data['page']?>">по возрастанию</a><br>
            <a href="/index/sort/task/desc/<?=$data['page']?>">по убыванию</a> </td>
        <td><a href="/index/sort/status/desc/<?=$data['page']?>">выполнено</a><br>
            <a href="/index/sort/status/asc/<?=$data['page']?>">не выполнено</a> </td>
    </tr>
<?php
$res = $data->get("res_tasks");
foreach ($res as $elem)
{?>
    <tr>
		<?php
		if(isset($_SESSION['user_id']))
		{?>
            <td><a href="/admin/edit/<?=$data['field']."/".$data['sort']."/".$data['page']."/".$elem['id'];?>"> Редактировать </a></td>
			<?
		}
		?>
        <td><?=$elem['user'];?></td>
        <td><?=$elem['email'];?></td>
        <td><?=$elem['task'];?></td>
        <td>
            <?php
                if($elem['status'])
                    echo "Завершено"."<br>";
                if($elem['is_edited'])
                    echo "Отредактировано администратором"
            ?>
        </td>
    </tr>
<?php }?>
</table>
<?php

/* Честно сперто с MyRusacov, только данные пришлось самому придумывать и ссылки */
$count_pages = ceil($data->get('count_rows')/3);
$active = $data->get('page');
$count_show_pages = 10;
$url = "/index/sort/".$data['field']."/".$data['sort']."/1";
$url_page = "/index/sort/".$data['field']."/".$data['sort']."/";
if ($count_pages > 1) { // Всё это только если количество страниц больше 1
	/* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
	$left = $active - 1;
	$right = $count_pages - $active;
	if ($left < floor($count_show_pages / 2)) $start = 1;
	else $start = $active - floor($count_show_pages / 2);
	$end = $start + $count_show_pages - 1;
	if ($end > $count_pages) {
		$start -= ($end - $count_pages);
		$end = $count_pages;
		if ($start < 1) $start = 1;
	}
	?>
    <!-- Дальше идёт вывод Pagination -->
    <div id="pagination">
        <span>Страницы: </span>
		<?php if ($active != 1) { ?>
            <a href="<?=$url?>" title="Первая страница">&lt;&lt;&lt;</a>
            <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница">&lt;</a>
		<?php } ?>
		<?php for ($i = $start; $i <= $end; $i++) { ?>
			<?php if ($i == $active) { ?><span><?=$i?></span><?php } else { ?><a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>"><?=$i?></a><?php } ?>
		<?php } ?>
		<?php if ($active != $count_pages) { ?>
            <a href="<?=$url_page.($active + 1)?>" title="Следующая страница">&gt;</a>
            <a href="<?=$url_page.$count_pages?>" title="Последняя страница">&gt;&gt;&gt;</a>
		<?php } ?>
    </div>
<?php } ?>



