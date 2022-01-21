<?php

namespace BOTS\Models;


class Order{
    public $counter;
    public $order_no;

    public function __construct(){
        $this->counter = Db::get_max_value('orders',"uid>0","counter");
        if($this->counter <=0){$this->counter = 1;}
        else{$this->counter++;}
    }

    public function create_order(){
        $now = date("Ymd");
        if(strlen(strval($this->counter)) == 1)
            $this->order_no=$now."000".$this->counter;
        elseif(strlen(strval($this->counter)) == 2)
            $this->order_no=$now."00".$this->counter;
        elseif(strlen(strval($this->counter)) == 3)
            $this->order_no=$now."0".$this->counter;
        elseif(strlen(strval($this->counter)) >= 4)
            $this->order_no=$now.$this->counter;
        return $this->order_no;
    }
}