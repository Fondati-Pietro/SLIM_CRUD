<?php

class Db extends MySQLi {
    static protected $instance = null;

    public function __construct($host, $user, $paasword, $schema){
        parent::__construct($host, $user, $paasword, $schema);
    }

    static function getInstance(){
        if(self::$instance == null){
            self::$instance == new Db('my_mariadb', 'root', 'ciccio', 'scuola');
        }
        return self::$instance;
    }

    public function select($stable, $where = 1){
        $query  = "SELECT * FROM $stable WHERE $where";
        if($result = $this->query($query)){
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}