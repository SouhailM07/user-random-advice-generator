<?php


class MyAuth extends Dbh {
    protected function isUserExist($name):bool{
        $sql = "SELECT COUNT(*) FROM users WHERE name = ?";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute([$name]);
        return (bool) $stmt->fetchColumn()>0;
    }

    protected function register(string $name,string $password){
        try {
            if($this->isUserExist($name)){
                return ["message"=>"user exist","status"=>409];
            }else {
                $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(name,password) VALUES(?,?)";
                $stmt=$this->connectDB()->prepare($sql);
                $stmt->execute([$name,$hashedPassword]);
                return ["message"=>"new user was added","status"=>201];
            }
        } catch (PDOException $e) {
            die("Something went wrong");
            return ["message"=>$e->getMessage(),"status"=>500];
        }
    }
    protected function getUserId(string $name):int{
        $sql = "SELECT id FROM users WHERE name=?";
        $stmt=$this->connectDB()->prepare($sql);
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        return (int) $result["id"];
    }
    protected function checkPassword(string $name,string $password):bool{ 
    $sql = "SELECT password FROM users WHERE name=?";                 
    $stmt=$this->connectDB()->prepare($sql);                              
    $stmt->execute([$name]);                                          
    $result = $stmt->fetch();                                             
    return password_verify($password,$result["password"]);                
}                                                                         
}