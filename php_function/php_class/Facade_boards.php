<?php

class Facade_boards extends Terrace_boards
{
    private $w_save;
    public function __construct($name, $l, $w, $h,$amount,$price,$id)
    {
        $this->w_save=$w;
        $w=$w-0.25*$w;
        parent::__construct($name, $l, $w, $h, $amount,$price,$id);
    }
    public function show_info()
    {
        $this->change_w($this->w_save);
        parent::show_info();
    }
}