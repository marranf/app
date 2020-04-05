<h2>Изменение/завершение задачи</h2>
<form name="form_edit" method="post" action="/admin/edit_row/<?=$data['field']."/".$data['sort']."/".$data['page']."/".$data['id'];?>" id="form_edit">
	<table>
		<tr>
			<td>User ID</td>
            <td><input type="hidden" name="id" value="<?=isset($data['row_edit']) ? $data['row_edit']['id'] : "";?>">
				<?=isset($data['row_edit']) ? $data['row_edit']['id'] : "";?>
            </td>
		</tr>
		<tr>
			<td>Имя пользователя</td>
			<td><?=isset($data['row_edit']) ? $data['row_edit']['user'] : ""; ?></td>
		</tr>
		<tr>
			<td>Емаил</td>
			<td><?=isset($data['row_edit']) ? $data['row_edit']['email'] : ""; ?></td>
		</tr>
		<tr>
			<td>Задача</td>
			<td><textarea name="task" id="task" rows="5"><?=isset($data['row_edit']) ? $data['row_edit']['task'] : ""; ?></textarea></td>
		</tr>
		<tr>
			<td>Set complete</td>
			<td><input type="checkbox" name="complete" id="complete" <? if($data['row_edit']['status'] == 1) echo checked;?>>
            <? if($data['row_edit']['status'] == 1) echo "(Задание завершено)"; else echo "(Задание не завершено)";?></td>
		</tr>
		<tr>
			<td>Отправить</td>
			<td><input type="submit" name="form_edit_submit" id="form_edit_submit" value="Confirm"></td>
		</tr>
	</table>
</form>
<br>
<?php
if(isset($data[errors]))
{
	foreach($data[errors] as $err)
	{
		echo "<p>$err</p>";
	}
}
?>