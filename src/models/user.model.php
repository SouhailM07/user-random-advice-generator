<?php


class User extends Dbh {
    protected function getUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->connectDB()->query($sql);
        return $stmt;
    }
    protected function getOneUser(int $id){
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt=$this->connectDB()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }
}