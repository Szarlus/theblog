<?php

class Auth_model extends Model
{

    public function __construct()
    {
        @parent::__construct();
    }

    function confirmPassword($username, $tested_password)
    {
        $authorization = null;

        $username = $this->sanitize($username);
        $tested_password = $this->sanitize($tested_password);

        $query = "SELECT user_salt, user_password FROM blog_user WHERE user_nickname = '$username' AND user_registered=true AND user_active = true LIMIT 1";

        $result = $this->query($query);

        if(count($result)) {
            $authorization = hash_equals($result[0]->user_password, hash('sha512', $tested_password.$result[0]->user_salt));
        }

        return $authorization;
    }

    function setUserPassword($username, $pass, &$ret_password = NULL)
    {
        if (is_null($pass)){
            $ret_password = $pass = $this->generateRandomPassword();
            echo "Generated random password: ".$ret_password." for user ".$username;
        }

        $salt = $this->generateSalt();

        $hashed_password = $this->hashPassword($pass, $salt);

        $this->updateUserPassword($username, $hashed_password, $salt);
    }

    function generateSalt()
    {
        do {
            $salt = bin2hex(openssl_random_pseudo_bytes(64, $strong));
        } while (!$strong);

        return $salt;
    }

    function generateRandomPassword()
    {
        $dirty_password = base64_encode(openssl_random_pseudo_bytes(10));
        $random_password = substr(str_replace(['/', '+', '='], ['', '', ''], $dirty_password), 0, 10); //przykladowe haslo uzytkownika

        return $random_password;
    }

    function hashPassword($password, $salt)
    {
        $concat = $password.$salt;

        return hash('sha512', $concat);
    }

    function updateUserPassword($username, $hashed_password, $salt)
    {

        $stmt = "UPDATE blog_user SET user_salt = '$salt', user_password = '$hashed_password' WHERE user_nickname = '$username'";

        return $this->execute($stmt) === TRUE;
    }

}



?>