<?php

class Sudoky_item
{
    public $empty = false; //пустая клеточка или нет
    public $v=0; //значение
    public $r=0; //строка
    public $c=0; //столбец
    public $s=0; //квадрат
    public function __construct($v,$r,$c){
        //находим номер квадрата по стобцу и строке
        if($r < 3) {
            if($c < 3) $this->s=0;
            else if($c < 6) $this->s=1;
            else$this->s=2;
        }else if($r < 6) {
            if($c < 3) $this->s=3;
            else if($c < 6) $this->s=4;
            else$this->s=5;
        }else {
            if($c < 3) $this->s=6;
            else if($c < 6) $this->s=7;
            else $this->s=8;
        }
        $this->empty=boolval(0==$v);
        $this->v=$v;
        $this->r=$r;
        $this->c=$c;
    }
}