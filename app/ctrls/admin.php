<?php
namespace app\ctrls;
class admin extends \app\ctrls\index
{
	public $data;
	public function __construct($data)
	{
		$this->data=$data;
		parent::__construct($data);
	}
	public function authorisation() //форма авторизации
	{
		\app\core\view::load("forms/authorise","template",$this->data);
	}

	public function authorise()  //обработка формы авторизации
	{
		$m_admin = new \app\models\admin($this->data);
		$m_admin->authorise();
		if($m_admin->data->get("errors"))
			$this->authorisation();
		else
		{
			$m_admin->authorisation();
			if($m_admin->data->get("errors"))
				$this->authorisation();
			else
			{
				$this->data->set("admin_enter", "Welcome ".$m_admin->get_admin());
				parent::index();
			}
		}
	}

	public function exit()  //выход
	{
		unset($_SESSION['user_id']);
		parent::index();
	}

	public function edit() //форма редактирования
	{
		$m_admin = new \app\models\admin($this->data);
		$this->data = $m_admin->edit();
		\app\core\view::load("forms/edit","template",$this->data);
	}

	public function edit_row() //обработка формы редактирования
	{
		if(!isset($_SESSION['user_id']))
		{
			$this->data->set("admin_enter", "Нельзя редактировать задание не залогинившись!");
			parent::index();
			return;
		}
		$m_admin = new \app\models\admin($this->data);
		if($m_admin->edit_row())
			$this->data->set("admin_enter", "Задание успешно отредактировано");
		else
			$this->data->set("admin_enter", "Редактирование отменено");
		$url = $_GET['url'];
		$url = str_replace('admin/edit_row','/index/sort',$url); //перенаправление на главную страницу после редактирования
		parent::sort();
	}
}