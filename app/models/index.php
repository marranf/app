<?php
namespace app\models;
use Exception;

class index extends \app\core\model
{
	public $data;  //регистр
	private $user; //имя юзера
	private $email;//емаил
	private $task; //текст задачи
	private $errors = array(); //массив ошибок
  	function __construct($data = null)
  	{
  		$this->data = $data;
    	parent::__construct($data);
  	}
  	
  	public function set()  //установка переменных, валидация
	{
		$this->user = $_POST['name'];
		$this->email = $_POST['email'];
		$this->task = $_POST['task'];
		$this->is_empty();
		$this->is_xss();
		return $this->data;
	}
	
	public function is_empty() //проверка на заполненность полей
	{
		if($this->user === "")
			array_push($this->errors, "Поле Логин не должно быть пустым!");
		if($this->email === "")
			array_push($this->errors, "Поле Емаил не должно быть пустым!");
		else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
			array_push($this->errors, "Не валидный емайл адрес!");
		if($this->task === "")
			array_push($this->errors, "Поле Задача не должно быть пустым!");
		$this->data->set("errors",$this->errors);
	}
	
	public function is_xss() //XSS
	{
		$this->user = strip_tags($this->user);
		$this->email = strip_tags($this->email);
		$this->task = strip_tags($this->task);
		$this->data->set("name",$this->user);
		$this->data->set("email",$this->email);
		$this->data->set("task",$this->task);
	}
	
	public function add_task() //добавление новой задачи
	{
		$sql = "insert into test_task (user,email,task) values ('".$this->user."','".$this->email."','".$this->task."')";
		try
		{
			\app\core\DB::getInstance($this->data);
			if(!\app\core\DB::query($sql))
				throw new Exception("Ошибка добавления данных в БД!");
		}
		catch (Exception $ex)
		{
			die('Ошибка: ' . $ex->getMessage());
		}
		
	}
}