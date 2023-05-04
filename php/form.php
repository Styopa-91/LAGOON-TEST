<?php
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Email '$email' does not valid \n";
    echo json_encode(array("error" => true, "mess" => $error));
    return false;
}


if (!($password == $repassword)) {
    echo json_encode(array("error" => true, "mess" =>"passwords are not the same"));
    return false;
}
$arr = array('name' => "$name $surname", 'email' => $email, 'password' => $password);

$users_with_ids = [];
$users_with_ids[] = array('ID' => 1, 'name' => "Peter Tr", 'email' => "22222@msda.com", 'password' => 213);
$users_with_ids[] = array('ID' => 2, 'name' => "John Joe", 'email' => "111111@msda.com", 'password' => 25253);
$users_with_ids[] = array('ID' => 3, 'name' => "Ioann Pavlo", 'email' => "33333@msda.com", 'password' => 634543);
$users_with_ids[] = array('ID' => 4, 'name' => "Michel Jackson", 'email' => "4444@msda.com", 'password' => 456456);
$users_with_ids[] = array('ID' => 5, 'name' => "Misha Mariny", 'email' => "5555@msda.com", 'password' => 346346);
$users_with_ids[] = array('ID' => 6, 'name' => "Dmytro Gordon", 'email' => "8888@msda.com", 'password' => 435345);

foreach ($users_with_ids as $user) {
    if ($user['email'] == $arr['email']) {
        $log = date('Y-m-d H:i:s') . ' user with this EMAIL already exists';
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
        echo json_encode(array("error" => true, "mess" =>"user with this EMAIL already exists"));
        return false;
    } else {
        $log = date('Y-m-d H:i:s') . ' user with this EMAIL can be saved';
        file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
    }
}

$ids = [];
foreach ($users_with_ids as $user) {
    $userId = $user['ID'];
    $ids[] = array($userId => $user['email']);
}

$i = 1;
$n = 3;
while (true){
    if (array_key_exists($i, $ids)) {
        $i =  $i+$n;
    } else {
        $arr['ID'] = $i;
        $users_with_ids[] = $arr;
        break;
    }
}

echo json_encode(array("success" => true, "mess" =>"user $name added"));

?>