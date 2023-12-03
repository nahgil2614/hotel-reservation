<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class UserModel extends Database
{
    public function getUsers($id)
    {
        $user = null;
        if ($id) {
            $user = $this->select("SELECT * FROM users WHERE id = ?", ["i", $id]);
        } else {
            $user = $this->select("SELECT * FROM users");           
        }
        return array(
            "code" => 0,
            "user" => $user
        );
    }

    public function findUser($email, $password)
    {
        $user = null;
        if ($email || $password) {
            $user = $this->select("SELECT * FROM users WHERE email = ?", ["s", $email]);
            if ($user) {
                if (password_verify($password, $user[0]['password'])) {
                    // return '{"code": 0, "user":' . $user . '}';
                    return array(
                        "code" => 0,
                        "user" => $user
                    );
                } else {
                    //return '{"code": 3, "error": "Wrong password" }';
                    return array(
                        "code" => 3,
                        "message" => "Wrong password"
                    );
                }
            } else {
                //return '{ "code": 2, "error": "user not exists"}';
                return array(
                    "code" => 2,
                    "message" => "user not exists"
                );
            }
        } else {
            //return '{ "code": 1, "error": "miss params"}';
            return array(
                "code" => 1,
                "message" => "miss params"
            );
        }
    }

    public function createUsers($data)
    {
        $user = null;
        if (isset($data['email'])) {
            $user = $this->select("SELECT * FROM users WHERE email = ?", ["s", $data['email']]);
        }
        if ($user) {
            return array(
                "code" => 2,
                "message" => "user already exists"
            );
            //return '{ "code": 2, "error": "user already exists"}';
        } else {
            if ($data) {
                $message =  $this->insert("INSERT INTO users(name, email, password, phone, creditCard, level) values (?, ?, ?, ?, ?, ?)", ["ssssss", array_values($data)]);
                //return '{ "code": 0, "message": ' . $message . '}';
                return array(
                    "code" => 0,
                    "message" => $message
                );
            } else {
                return array(
                    "code" => 1,
                    "message" => "miss params"
                );
                //return '{ "code": 1, "error": miss params}';
            }
        }
    }
}
