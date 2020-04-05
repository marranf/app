<?php
namespace app\models;
use Exception;

class pagination extends \app\models\index //сортировка и пагинация страниц
{
	public $data;			//регистр
	private $count_rows;	//количество выбранных строк
	private $res = array(); //выбранные строки
	public function __construct($data = null)
	{
		$this->data = $data;
		parent::__construct($data);
	}
	
	public function index()  //начальные установки сортировки и страницы
	{
		$this->get_count_rows();
		if(!$this->data['field']) //формирование ссылок
		{
			$this->data->set('field','user'); //поле сортировки
			$this->data->set('sort','asc');		//тип сортировки
			$this->data->set('page',1);			//страница
		}
		$this->sort();
		return $this->data;
	}
	
	public function get_count_rows() //получить количество строк из БД
	{
		$sql = 'select count(*) as count from test_task';
		\app\core\DB::getInstance($this->data);
		try
		{
			$res = \app\core\DB::query($sql);
			if(!$res)
				throw new Exception("Ошибка обращения к БД!");
			$row = \app\core\DB::fetch_object($res);
		}
		catch (Exception $ex)
		{
			die('Ошибка: ' . $ex->getMessage());
		}
		$this->count_rows = $row->count;
		$this->data->set('count_rows',$this->count_rows);
	}

	public function sort()  //сортировка по параметрам из ссылки
	{
		$sql = 'select * from test_task order by '.$this->data['field'].' '.$this->data['sort'].' limit '.(($this->data['page']-1)*3).' ,3';
		\app\core\DB::getInstance($this->data);
		try
		{
			$res = \app\core\DB::query($sql);
			if (!$res)
				throw new Exception("Ошибка обращения к БД!");
			while ($row = \app\core\DB::fetch_array($res))
			{
				$val = array("id"=>$row["id"], "user"=>$row["user"], "email"=>$row["email"], "task"=>$row['task'], "status"=>$row["status"], "is_edited"=>$row["is_edited"]);
				array_push($this->res, $val);
			}
			$this->data->set("res_tasks",$this->res);
		}
		catch (Exception $ex)
		{
			die('Ошибка: ' . $ex->getMessage());
		}
	}
}