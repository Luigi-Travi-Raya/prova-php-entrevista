<?php

class UserColors{

    private $connection;
    private $userModel;

    public function __construct($connection,$userModel){
        $this->connection = $connection;
        $this->userModel = $userModel;
    }

    public function findAll(){
        $queryResult = $this->connection->query("SELECT * FROM user_colors A, ");
        $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function findOneById($id){
        try{
            if(gettype($id) != "integer"){
                throw new Exception("Id must be a number");
            }

            $id = (int)$id;
            $queryResult = $this->connection->query("SELECT * FROM user_colors WHERE user_id = {$id} LIMIT 1");
            $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }catch(Exception $e){
            return $e;
        }
    }
}
?>