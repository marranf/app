<?php
namespace app\core;
use app\admin\ctrls\index;

class router		//упрощенный роутер под конкретную задачу
{
	static function Run($data)
	{
		$_POST;
		$url = $_GET['url'];
		$action = "Index";
		if (isset($url))
		{
			$exp = explode('/', $url);
			if (file_exists("ctrls/" . $exp[0] . ".php"))
			{
				$controller = "app\ctrls\\" . $exp[0];
				if (isset($exp[1]))
				{
					if (method_exists($controller, $exp[1]))
					{
						$action = $exp[1];
						if(isset($exp[2]))
							$data->set("field",$exp[2]);
						if(isset($exp[3]))
							$data->set("sort",$exp[3]);
						if(isset($exp[4]))
							$data->set("page",$exp[4]);
						if(isset($exp[5]))
							$data->set("id",$exp[5]);
					}
					else
						$action = "err_404";
				}
				else
				{
					$action = "err_404";
					$controller = "\app\ctrls\\index";
				}
			}
		}
		else
		{
			$controller = '\app\ctrls\\index';
		}
		$controller = new $controller($data);
		$controller->$action();
	}
}