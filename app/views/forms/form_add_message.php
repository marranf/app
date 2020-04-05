<h2>Добавить задачу</h2>
<form name="form_add" method="post" action="add_task" id="form_add">
	<table>
		<tr>
			<td>Логин</td>
			<td><input type="text" name="name" id="name" value="<?=isset($data['name']) ? $data['name'] : ""; ?>"></td>
		</tr>
		<tr>
			<td>Емаил</td>
			<td><input type="text" name="email" id="email"  value="<?=isset($data['email']) ? $data['email'] : ""; ?>"></td>
		</tr>
		<tr>
			<td>Задача</td>
			<td><textarea name="task" id="task" rows="5"><?=isset($data['task']) ? $data['task'] : ""; ?></textarea></td>
		</tr>
		<tr>
			<td>Отправить</td>
			<td><input type="submit" name="form_add_submit" id="form_add_submit" value="Send"></td>
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