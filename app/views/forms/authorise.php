<h2>Вход для администратора</h2>
<form name="form_authorise" method="post" action="authorise" id="authorise">
	<table>
		<tr>
			<td>Login</td>
			<td><input type="text" name="name" id="name" value="<?=isset($data['name']) ? $data['name'] : ""; ?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="password" id="password"  value="<?=isset($data['password']) ? $data['password'] : ""; ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="form_authorise" id="form_authorise_submit" value="Authorisation"></td>
		</tr>
	</table>
</form>
<?php
if(isset($data[errors]))
{
	foreach($data[errors] as $err)
	{
		echo "<p>$err</p>";
	}
}
?>