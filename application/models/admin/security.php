<?php
echo "========================".PHP_EOL;
$dirty_password = base64_encode(openssl_random_pseudo_bytes(10));
$random_password = substr(str_replace(['/', '+', '='], ['', '', ''], $dirty_password), 0, 10); //przykladowe haslo uzytkownika

$password = "gMP9m0kuuo";

// echo "random password: ".$random_password.PHP_EOL;
// echo "salt: ".$salt.PHP_EOL;
// echo "hashed password: ".$hashed_pass_with_salt.PHP_EOL;

$mysqli = new mysqli("localhost", "theblog", "strongpassword", "theblog");
// $mysqli = new mysqli("127.0.0.1:3306", "theblog", "strongpassword", "theblog");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
else {
    echo "Connection established".PHP_EOL;
}

$query = "SELECT * FROM blog_post";
$result = $mysqli->query($query);

while($row = $result->fetch_object()){
    print_r($row);
}

// $result = $mysqli->query($query);

//EXECUTION OF PASSWORD UPDATE
// $stmt = "UPDATE blog_user SET user_salt = '$salt', user_password = '$hashed_pass_with_salt' WHERE id=1";

// $mysqli->real_query($stmt);

// $result = $mysqli->store_result();

// if($result){
//     echo "Statement execute successfully".PHP_EOL;
// }
// else{
//     echo "There was a problem with statement ".$mysqli->error.PHP_EOL;
// }

// EXECUTION OF DATA RETRIEVAL
// $query = "SELECT user_salt, user_password FROM blog_user WHERE user_nickname = 'Szarlus'";

// $result = $mysqli->query($query);

// if($result) {
//     $row = $result->fetch_object();

//     print_r($row);

//     var_dump(hash_equals($row->user_password, hash('sha512', $password.$row->user_salt)));

//     echo "user_password: ".$row->user_password.PHP_EOL;
//     echo "hashed password with retrieved salt: ".hash('sha512', $password.$row->user_salt).PHP_EOL;

// }


// set_user_password("Szarlus", "karol100", $rand_password);

// var_dump(confirm_password("Szarlus", "karol100"));

// var_dump($rand_password);

function confirm_password($username, $testes_password)
{
    global $mysqli;

    $authorization = null;

    $query = "SELECT user_salt, user_password FROM blog_user WHERE user_nickname = '$username'";

    $result = $mysqli->query($query);

    if($result->num_rows) {
        $row = $result->fetch_object();

        $authorization = hash_equals($row->user_password, hash('sha512', $testes_password.$row->user_salt));
    }

    return $authorization;
}

function set_user_password($username, $pass, &$ret_password = NULL){
    if (is_null($pass)){
        $ret_password = $pass = generate_random_password();
    }
    
    $salt = generate_salt();

    $hashed_password = hash_password($pass, $salt);

    update_user_password($username, $hashed_password, $salt);
}

function generate_salt(){
    do {
        $salt = bin2hex(openssl_random_pseudo_bytes(64, $strong));
    } while (!$strong);

    return $salt;
}

function generate_random_password(){
    $dirty_password = base64_encode(openssl_random_pseudo_bytes(10));
    $random_password = substr(str_replace(['/', '+', '='], ['', '', ''], $dirty_password), 0, 10); //przykladowe haslo uzytkownika

    return $random_password;
}

function hash_password($password, $salt){
    $concat = $password.$salt;

    return hash('sha512', $concat);
}

function update_user_password($username, $hashed_password, $salt){
    global $mysqli;

    $stmt = "UPDATE blog_user SET user_salt = '$salt', user_password = '$hashed_password' WHERE user_nickname = '$username'";

    return $mysqli->query($stmt) === TRUE;
}

$mysqli->close();
?>