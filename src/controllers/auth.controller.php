<?php

class MyAuthController extends MyAuth {

    public function isPasswordConfirmed(string $password, string $confirmPassword) {
        if ($password === $confirmPassword){
            return true;
        }else {
            $e = "Passwords do not match";
            header("Location: /register?error=$e");
            exit();
        }
    }
    public function loginUser(string $name, string $password) {
        $userExist = $this->isUserExist($name);
        if($userExist){
            $isPasswordCorrect = $this->checkPassword($name, $password);
            if($isPasswordCorrect){
                session_start();
                $_SESSION['user_id'] = $this->getUserId($name);
                $_SESSION['name'] = $name;
                // $_SESSION['password'] = $password;
                header("Location: /login?success=Login successful");
                exit();
            } else {
                $e = "Incorrect password";
                header("Location: /login?error=$e");
                exit();
            }
        } else {
            $e = "User does not exist";
            header("Location: /login?error=$e");
            exit();
        }
    }
    public function registerUser(string $name, string $password, string $confirmPassword) {
        $userExist = $this->isUserExist($name);
        if($this->isPasswordConfirmed($password, $confirmPassword)){
             if($userExist){
                $e="User does exist";
                header("Location: /register?error=$e");
                exit();
            }
            else {
                $newUser=$this->register($name, $password);
                if($newUser){
                    $msg= "User registered successfully";
                    session_start();
                    $_SESSION['user_id'] = $this->getUserId($name);
                    $_SESSION['name'] = $name;
                    $_SESSION['password'] = $password;
                    header("Location: /register?success=$msg");
                    exit();
                }
            }  
        }
     }

}