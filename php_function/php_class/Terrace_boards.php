<?php



class Terrace_boards implements Board
{
    private $name;
    private $id;
    private $l;
    private $w;
    private $h;
    private $amount;
    private $weight;
    private $europallets;
    private $price;

    public function __construct($name, $l, $w, $h,$amount,$price,$id)
    {
        if($amount>25) {
            $europallets = $this->count_europallets(650, $l, $w, $h, $amount);
        }
        else{
            $europallets =0;
        }
        $this->weight = $this->count_weight(650, $l, $w, $h,$europallets,$amount);
        if($amount>25) {
        $h_multiplier=ceil(($w*$amount)/800);
            $h = (100 + ($h * $h_multiplier))/$europallets;
            $w = 1000;
        }
        $this->europallets=$europallets;
        $this->name = $name;
        $this->price=$price*$amount;
        $this->id=$id;
        $this->l = $l;
        $this->w = $w;
        $this->h = $h;
        $this->amount=$amount;

    }
    protected function m3($l, $w, $h,$amount){
        $w/=1000;
        $l/=1000;
        $h/=1000;
        return $l*$h*$w*$amount;
    }

    protected function count_weight($kg_per_m3, $l, $w, $h, $europallets, $amount)
    {
        $m3 = $this->m3($l, $w, $h, $amount);
        if($europallets!=0) {
            return ($m3 * $kg_per_m3)/$europallets+25;
        }
        else{
            return ($m3 * $kg_per_m3);
        }
    }

    protected function count_europallets($kg_per_m3, $l, $w, $h, $amount)
    {
        $m3 = $this->m3($l, $w, $h, $amount);
        return ceil(($m3 * $kg_per_m3) / 4000);
    }
    public function show_info()
    {
        $w=$this->w;
        echo 'Cena za ' . $this->name . ' ' . $this->price . ' zł<br>';
        if($this->europallets!=0){
            echo 'Ilość europalet z towarem: ' . $this->europallets . '<br>';
        }
        else{
            echo 'Ilość desek:' .$this->amount . '<br>';
        }
        echo 'Wymiary każdej<br>';
        echo 'Długość: ' . $this->l . ' mm<br>';
        echo 'Szerokość: ' . $w . ' mm<br>';
        echo 'Wysokość: ' . $this->h . ' mm<br>';
        echo 'Waga: ' . $this->weight . ' kg<br>';
    }

    public function get_price()
    {
        return $this->price;
    }
    public function change_w($w){
        $this->w=$w;
    }
    public function get_amount(){
        return $this->amount;
    }
    public function get_id(){
        return $this->id;
        }
}
