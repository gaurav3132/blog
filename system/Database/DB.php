<?php

namespace System\Database;
use \PDO;

abstract class DB
{
    private $conn;
    private $statement;

    public function __construct()
    {
        $this->conn = new PDO(dsn:"mysql:host=".config('db_host').";dbname=".config('db_name'),username:config('db_user'), password:config('db_password'));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function run($sql){
        $this->statement=$this->conn->prepare($sql);
        $this->statement->execute();
    }

    public function fetch(){
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function  count(){
        return $this->statement->rowcount();
    }

    public function last_query(): string {
        return $this->statement->queryString;
    }

    public function last_id(): string {
        return $this->conn->lastInsertId();
    }
}