<?php
namespace BOTS\Models;

class Db{
    /**
     * Connects to MySQL database and return connection result.
     * @return false|\mysqli
     */
    public static function connect(){
        try{
            $conn = mysqli_connect(_DB_SERVER_, _DB_USER_, _DB_PASSWD_,_DB_NAME_) or die('Oops! Something went Wrong : '.mysqli_connect_error());
            return $conn;
        }catch (\Exception $e){
            die('Connection Failed: '. $e->getMessage());
        }
    }

    /**
     * Closes MySQL database connection
     */
    public static function close(){mysqli_close(self::connect());}

    /**
     * Db constructor.
     */
    public function __construct(){
        self::connect();
    }

    /**
     * Accepts a query and executes the query.
     * Returns 1 if query executes successfully otherwise it returns mysqli_error.
     * @param $q - The Query
     * @return int|void
     */
    public static function exec($q){
        $con = self::connect();
        return mysqli_query($con, $q) ? 1 : die(mysqli_error($con));
    }

    /**
     * Accepts a query and executes the query.
     * Returns the query result is execution is successful otherwise returns mysqli_error.
     * @param $q - The Query
     * @return bool|\mysqli_result|void
     */
    public static function execQ($q){
        $con = self::connect();
        return mysqli_query($con, $q) ? mysqli_query($con, $q) : die(mysqli_error($con));
    }

    /**
     * Accepts a query, executes and returns mysqli_fetch_assoc array.
     * @param $q - The Query
     * @return string[]|null
     */
    public static function execS($q){
        $con = self::connect();
        return mysqli_fetch_assoc(mysqli_query($con, $q));
    }

    /**
     * Accepts a table name, an array with table columns and an array with the respective values to insert.
     * Returns 1 if insert is successful otherwise returns an error.
     * @param $table - Table
     * @param $fields - Array of table fields
     * @param $values - Array of values to insert
     * @return int|void
     */
    public static function insert($table, $fields, $values){
        $fields = implode(',', $fields);
        $values = implode("','", $values);
        $values = "'$values'";
        $q = "INSERT INTO $table ($fields) VALUES ($values)";
        return self::exec($q);
    }

    /**
     * Accepts a table name, string with columns to update and the 'WHERE' condition for update.
     * Returns 1 if update is successful otherwise returns an error.
     * @param $table
     * @param $fields
     * @param $where
     * @return int|void
     */
    public static function update($table, $fields, $where){
        $q = "UPDATE $table SET $fields WHERE $where";
        return self::exec($q);
    }

    /**
     * Accepts a table name, the 'WHERE' condition for update and the column name.
     * Returns the value of the column.
     * @param $table
     * @param $where
     * @param $name
     * @return mixed|string
     */
    public static function get_value($table, $where, $name){
        $q = "SELECT $name FROM $table WHERE $where";
        return self::execS($q)[$name];
    }

    /**
     * Returns the result of executed query depending on the order, group or limit.
     * @param $table
     * @param $where
     * @param string $columns
     * @param null $group_by
     * @param null $order_by
     * @param string $direction
     * @param null $limit
     * @return bool|\mysqli_result|void
     */
    public static function getQ($table, $where, $columns='*', $group_by=null, $order_by=null, $direction='ASC', $limit=null){
        if(!is_null($group_by) and !is_null($order_by) and !is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by ORDER BY $order_by $direction LIMIT $limit";
        elseif (!is_null($group_by) and is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by";
        elseif (is_null($group_by) and !is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by $direction";
        elseif (!is_null($group_by) and !is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by ORDER BY $order_by $direction";
        elseif(is_null($group_by) and !is_null($order_by) and !is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by $direction LIMIT $limit";
        else
            $q = "SELECT $columns FROM $table WHERE $where";
        return self::execQ($q);
    }

    /**
     * @param $table
     * @param $where
     * @param string $columns
     * @param null $group_by
     * @param null $order_by
     * @param string $direction
     * @param null $limit
     * @return string[]|null
     */
    public static function get($table, $where, $columns='*', $group_by=null, $order_by=null, $direction='ASC', $limit=null){
        if(!is_null($group_by) and !is_null($order_by) and !is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by ORDER BY $order_by $direction LIMIT $limit";
        elseif (!is_null($group_by) and is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by";
        elseif (is_null($group_by) and !is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by $direction";
        elseif (!is_null($group_by) and !is_null($order_by) and is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where GROUP BY $group_by ORDER BY $order_by $direction";
        elseif(is_null($group_by) and !is_null($order_by) and !is_null($limit))
            $q = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by $direction LIMIT $limit";
        else
            $q = "SELECT $columns FROM $table WHERE $where";
        return self::execS($q);
    }

    /**
     * @param $table
     * @param $where
     * @param $order_by
     * @param string $columns
     * @return string[]|null
     */
    public static function get_max($table, $where, $order_by, $columns='*'){
        $q = "SELECT $columns FROM $table WHERE $where ORDER BY $order_by DESC LIMIT 0, 1";
        return self::execS($q);
    }

    /**
     * @param $table
     * @param $where
     * @param string $column
     * @return int|mixed|string
     */
    public static function get_max_value($table, $where, $column='uid'){
        $q = "SELECT MAX($column) AS $column FROM $table WHERE $where";
        return mysqli_num_rows(self::execQ($q)) > 0 ? self::execS($q)[$column] : 0;
    }

    /**
     * @param $table
     * @param $where
     * @return int
     */
    public static function check_row_exists($table, $where){
        $q = "SELECT * FROM $table WHERE $where";
        $rows = mysqli_num_rows(self::execQ($q));
        return $rows > 0 ? 1 : 0;
    }

    /**
     * @param $table
     * @param $where
     * @param string $columns
     * @return int
     */
    public static function num_rows($table, $where, $columns='*'){
        $q = "SELECT $columns FROM $table WHERE $where";
        return mysqli_num_rows(self::execQ($q));
    }

    /**
     * @param $table
     * @param $where
     * @param $column
     * @return mixed|string
     */
    public static function sum_rows($table,$where, $column){
        $q = "SELECT SUM($column) AS $column FROM $table WHERE $where";
        return self::execS($q)[$column];
    }

    /**
     * @param $content
     * @param $user_id
     * @return int|void
     */
    public static function activity_log($content){
        $fields = ['activity', 'date_created'];
        $values = ["$content", FULL_DATE];
        return self::insert('h_activity_logs', $fields, $values);
    }

    /**
     * @param $table
     * @param $where
     * @return int|void
     */
    public static function delete($table, $where){
        return self::exec("DELETE FROM $table WHERE $where");
    }
}