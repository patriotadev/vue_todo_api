<?php

header('Content-Type: application/json');

$conn = mysqli_connect('localhost', 'root', '', 'vue_todo');
$request = $_SERVER['REQUEST_METHOD'];


switch ($request) {
    case 'GET':
        $sql = "SELECT * FROM todolist";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
            http_response_code(200);
            die();
        }
        break;

    case 'POST':
        $text = $_POST['text'];
        $done = $_POST['done'];
        $date = $_POST['id_date'];

        if (!isset($text)) {
            http_response_code(400);
            die();
        } else {
            $sql = "INSERT INTO todolist (text, done, id_date) VALUES ('$text', '$done','$date')";
            $result = mysqli_query($conn, $sql);

            http_response_code(200);
            die();
        }


        break;

    case 'DELETE':

        $date = $_GET['id'];

        $sql = "DELETE FROM todolist WHERE id_date = '$date'";
        $result = mysqli_query($conn, $sql);
        http_response_code(200);
        die();
        break;

    case 'PATCH':

        $date = $_GET['id'];
        $done = $_GET['done'];

        $sql = "UPDATE todolist SET done=$done WHERE id_date='$date'";
        $result = mysqli_query($conn, $sql);
        http_response_code(200);
        die();

        break;

    default:

        break;
}
