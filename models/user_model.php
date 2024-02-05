<?php

class User{

    private $connection;
    
    public function __construct($connection){
        $this->connection = $connection;
     }

    public function findAll(){
        $queryResult = $this->connection->query("SELECT * FROM users");
        $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function findAllByValue($value,$column){
        try{
            if(gettype($value) != "string" OR str_contains($value,'-') OR str_contains($value,'=') OR str_contains($value,'"') OR str_contains($value,"'")){
                throw new Exception("Value must have valid characters");
            }
            $queryResult = $this->connection->query("SELECT * FROM users WHERE {$column} = '{$value}'");
            $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return $e;
        }
    }

    public function findOneById($id){
        try{
            if(gettype($id) != "integer"){
                throw new Exception("Id must be a number");
            }
            $id = (int)$id;
            $queryResult = $this->connection->query("SELECT * FROM users WHERE id = {$id} LIMIT 1");
            $result = $queryResult->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(Exception $e){
            return $e;
        }
    }

    public function create($name, $email,){
        try{
            if(gettype($name) != "string" OR str_contains($name,'-') OR str_contains($name,'=') OR str_contains($name,'"') OR str_contains($name,"'")){
                throw new Exception("Name must have valid characters");
            }
            if(gettype($email) != "string" OR str_contains($email,'-') OR str_contains($email,'=') OR str_contains($email,'"') OR str_contains($email,"'")){
                throw new Exception("Email must have valid characters");
            }

            $queryResult = $connection->query("SELECT * FROM users WHERE name = '{$name}'");
            $result = $queryResult->fetchAll(PDO::FETCH_NUM);
            if($result){
                if($result[0][0] != $_SESSION['userId'] AND count($result)>0){
                    throw new Exception("Name is already taken");
                }
            }

            $queryResult = $connection->query("SELECT * FROM users WHERE email = '{$email}'");
            $result = $queryResult->fetchAll(PDO::FETCH_NUM);

            if($result){
                if(count($result)>0){
                    $_SESSION['emailTaken'] = true;
                    header("Location: create_form.php");
                    exit;
                }
            }   

            $queryResult = $this->connection->query("INSERT INTO * FROM users WHERE {$column} = '{$value}'");
            return $result;

        }catch(Exception $e){
            return $e;
        }

    }
}
?>