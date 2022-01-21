<?php
namespace BOTS\Models;

class Product{
    private $table = "bots";

    public function get_product_details($item_id=null){
        return Db::get($this->table, "uid='$item_id'");
    }

    public function get_product_status($item_id=null, $state=null){
        if(is_null($state) and !is_null($item_id)){
            $state = Db::get_value($this->table, "uid='$item_id'", "bot_status");
        }

        return ($state == 1)? "<span class='badge bg-success'>Active</span>": "<span class='badge bg-light text-dark'>In-Active</span>";
    }
}