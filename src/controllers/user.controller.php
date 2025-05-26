<?php

class UserController extends User {
    public function handle_getUsers() {
        $users = $this->getUsers();
        if($users){
            return $users->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }
}