<?php
namespace app\models;
use Exception;

class admin extends \app\models\pagination  //админская часть
{
	private $login;  //логин
	private $pass;	//пароль
	private $errors = array();
	public $data;
	public function __construct($data = null)
	{
		$this->data = $data;
		parent::__construct($data);
	}
	
	public function authorise() //данные из формы авторизации
	{
		$this->login = $_POST['name'];
		$this->pass = $_POST['password'];
		$this->validate();
	}

	public function authorisation() //проверка правильности пароля и запоминание ИД в сессию
	{
		$sql = "Select * from test_admin where name='".$this->login."'";
		\app\core\DB::getInstance($this->data);
		try
		{
			$res = \app\core\DB::query($sql);
			if(!$res)
				throw new Exception("Ошибка обращения к БД!");
			$row = \app\core\DB::fetch_object($res);
			if(isset($row->name))
			{
				$hash = $row->pass;
				if(!password_verify($this->pass, $hash))
					array_push($this->errors, "Неверный пароль!");
				else
					$_SESSION['user_id'] = $row->id;
			}
			else
			{
				array_push($this->errors, "Неверные данные для авторизации!");
			}
			$this->data->set("errors",$this->errors);
		}
		catch (Exception $ex)
		{
			die('Ошибка: ' . $ex->getMessage());
		}
	}

	public function validate()
	{
		if($this->login === "")
			array_push($this->errors, "Поле Login не должно быть пустым!");
		if($this->pass === "")
			array_push($this->errors, "Поле Password не должно быть пустым!");

		$this->login = strip_tags($this->login);
		$this->pass = strip_tags($this->pass);
		$this->data->set("name",$this->login);
		$this->data->set("password",$this->pass);
		if($this->errors)
			$this->data->set("errors",$this->errors);
	}

	public function edit()  //заполнение данными формы редактирования задачи
	{
		$sql = "select * from test_task where id=".$this->data['id'];
		\app\core\DB::getInstance($this->data);
		try
		{
			$res = \app\core\DB::query($sql);
			if(!$res)
				throw new Exception("Ошибка обращения к БД!");
			$row = \app\core\DB::fetch_array($res);
			$val = array("id"=>$row["id"], "user"=>$row["user"], "email"=>$row["email"], "task"=>$row['task'], "status"=>$row["status"], "is_edited"=>$row["is_edited"]);
			$this->data->set("row_edit",$val);
			return $this->data;
		}
		catch (Exception $ex)
		{
			die('Ошибка: ' . $ex->getMessage());
		}
	}

	public function edit_row()  //проверка редактированной формы на изменение данных и апдейт БД
	{
		$this->edit();
		$flag_task_change = ($this->data['row_edit']['task'] != $_POST['task']) ? "task='".$_POST['task']."'" : ""; //изменился текст задачи
		$flag_status_change = ($this->data['row_edit']['status'] != ($status = isset($_POST['complete']) ? 1 : 0)) ? "status=".$status : ""; //изменился ствтус задачи
		if($flag_task_change)
			$flag_admin_edit = "is_edited='1'"; //если текст задачи изменился, ставим отметку "отредактировано"
		if($flag_task_change || $flag_status_change)
		{
			$sql = "update test_task set ".$flag_task_change.($flag_task_change != "" ? ',' : '').$flag_status_change.
				(($flag_status_change != ""&& $flag_admin_edit != "") ? ',' : "").$flag_admin_edit." where id=".$this->data['id'];
			\app\core\DB::getInstance($this->data);
			try
			{
				$res = \app\core\DB::query($sql);
				if(!$res)
					throw new Exception("Ошибка обращения к БД!");
				return true;
			}
			catch (Exception $ex)
			{
				die('Ошибка: ' . $ex->getMessage());
			}
		}
		return false;
	}

	public function get_admin()  //Логин админа для приветствия
	{
		return $this->login;
	}
}