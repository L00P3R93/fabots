<?php


namespace BOTS\Models;

class User{
    protected $table = 'users';
    public $id;
    public $staff_details;

    /**
     * User constructor.
     * @param null $id
     */
    public function __construct($id=null){
        if($id){
            $this->id=$id;
            $this->staff_details = $this->get_user($id);
        }
    }

    /**
     * Returns array of user details
     * @param $id
     * @return string[]|null
     */
    public function get_user($id){
        return Db::get($this->table,"uid='$id'");
    }

    /**
     * Return the Users First and Last name
     * @param $enc_id
     * @return string
     */
    public function get_user_names($enc_id){
        $id = Util::decurl($enc_id);
        $d = Db::get($this->table, "uid='$id'");
        return $d['first_name'].' '.$d['last_name'];
    }

    /**
     * Returns the username
     * @param $id
     * @return mixed|string
     */
    public function get_username($id){
        return Db::get_value($this->table, "uid='$id'", 'user_name');
    }

    /**
     * Returns the user status
     * @param $id
     * @return mixed|string
     */
    public function get_user_status($id){
        return Db::get_value($this->table, "uid='$id'", 'status');
    }


}