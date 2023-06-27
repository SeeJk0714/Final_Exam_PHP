<?php

class DB
{
    // replace these with your own database credentials
    private $host = 'devkinsta_db'; // change this to devkinsta_db
    private $db_name = 'Final_Exam_PHP'; // use your own database name
    private $username = 'root';
    private $password = 'GObT0SaYlthXkrat'; // use your own password
    private $db;

    public function __construct()
    {
        $this->db =  new PDO(
            "mysql:host=$this->host;dbname=$this->db_name", 
            $this->username, 
            $this->password
        );
    }

    public function fetch( $sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetch();
    }

    public function fetchAll( $sql, $params = [])
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->fetchAll();
    }

    public function insert( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $this->db->lastInsertId();
    }

    public function update( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->rowCount();
    }

    public function delete( $sql, $params = [] )
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        return $query->rowCount();
    }
}