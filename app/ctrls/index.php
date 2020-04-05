<?php
namespace app\ctrls;
/*класс главной страницы
* добавление задачи
 * сортировка
 *
 */
class index extends \app\core\ctrl
{
  	public $data;
 	private $m_task;
  	public function __construct($data)
  	{
    	$this->data=$data;
  	}
  
  	public function index()
  	{
	  	$this->m_task = new \app\models\pagination($this->data);
	  	$this->data = $this->m_task->index();
	  	\app\core\view::load("index","template",$this->data);
  	}

  	public function add() //показ формы добавления задачи
  	{
	  	\app\core\view::load("forms/form_add_message","template",$this->data);
  	}
  
  	public function add_task() //обработка формы добавления
  	{
  		$this->m_task = new \app\models\index($this->data);
  		$this->data = $this->m_task->set();
  		if($this->data->get("errors"))
  			$this->add();
  		else
  		{
			$this->m_task->add_task();
			$this->data->set("added_task_ok","Задание успешно добавлено!");
			unset($_GET['url']);
			$this->index();
		}
  	}

  	public function sort() //сортировка и пагинация
	{
		$this->m_task = new \app\models\pagination($this->data);
		$this->m_task->get_count_rows();
		$this->m_task->sort();
		\app\core\view::load("index","template",$this->data);
	}

  	public function err_404()
  	{
		\app\core\view::load("404","template",$this->data);
  	}
}
