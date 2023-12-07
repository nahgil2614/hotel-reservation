<?php
class UserModel extends BaseModel
{
    public function create($data, $level=1)
    {
        // name, email, password, phone, creditCard
        // level: traveller (1) by default
        if (!$this->isRegisteringUserInfo($data)) {
            return array(
                "code" => 2,
                "message" => "Make sure you have all the fields: name, email, password, phone, and creditCard."
            );
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['level'] = $level;

        if ($this->query("SELECT id FROM users WHERE email=?", "s", $data['email'])) {
            return array(
                "code" => 2,
                "message" => "Email already existed."
            );
        }
        
        if ($this->query("SELECT id FROM users WHERE phone=?", "s", $data['phone'])) {
            return array(
                "code" => 2,
                "message" => "Phone number already existed."
            );
        }
        
        if ($this->query("SELECT id FROM users WHERE creditCard=?", "s", $data['creditCard'])) {
            return array(
                "code" => 2,
                "message" => "Credit card already existed."
            );
        }
        
        $message = $this->query("INSERT INTO users(name, email, password, phone, creditCard, level) values (?, ?, ?, ?, ?, ?)", "sssssi", ...array_values($data));

        if ($message === false) {
            return array(
                "code" => 2,
                "message" => "Failed to execute query."
            );
        }

        return array(
            "code" => 0,
            "message" => $message
        );
    }

    public function get($id)
    {
        $user = $this->query("SELECT name, email, phone FROM users WHERE id=?", "i", $id);
        return array(
            "code" => 0,
            "user" => $user
        );
    }

    // getAllUsers

    public function find($email, $password)
    {
        // no need to check for missing params: the controller will handle that

        $user = $this->query("SELECT * FROM users WHERE email=?", "s", $email);
        if (!$user) {
            return array(
                "code" => 2,
                "message" => "User doesn't exist."
            );
        }

        // every email is unique
        $user = $user[0];
        if (password_verify($password, $user['password'])) {
            unset($user['password']);
            unset($user['creditCard']);
            return array(
                "code" => 0,
                "user" => $user
            );
        }

        return array(
            "code" => 3,
            "message" => "Wrong password"
        );
    }

    private function isRegisteringUserInfo(&$data) {
        return isset($data['name'])
            && isset($data['email'])
            && isset($data['password'])
            && isset($data['phone'])
            && isset($data['creditCard']);
    }
}
