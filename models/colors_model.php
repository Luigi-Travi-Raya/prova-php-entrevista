<?php

class Color{

    private $connection;
    

    public function __construct($connection){
            $this->connection = $connection;
    }

    public function findAll(){

        $queryResult = $this->connection->query("SELECT * FROM colors");
        $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function findOneById($id){
        try{
            if(gettype($id) != "integer"){
                throw new Exception("Id must be a number");
            }

            $id = (int)$id;
            $queryResult = $this->connection->query("SELECT * FROM colors WHERE id = {$id} LIMIT 1");
            $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }catch(Exception $e){
            return $e;
        }
    }
}
?>