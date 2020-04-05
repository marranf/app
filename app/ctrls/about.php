<?php
namespace app\ctrls;
class about
{
    private $data;
    public function __construct($data)
    {
        $this->data=$data;

    }
    public function Index()
    {
        \app\core\view::load("about","template",$this->data);
    }
}