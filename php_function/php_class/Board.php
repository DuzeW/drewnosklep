<?php



interface Board
{

    public function __construct($name, $l, $w, $h, $amount, $price, $id);

    public function show_info();

    public function get_price();

    public function get_id();

    public function get_amount();
}