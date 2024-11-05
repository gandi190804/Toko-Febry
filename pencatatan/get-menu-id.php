<?php
require_once '../helper/connection.php';

if (isset($_GET['id'])) {
    $menu_id = $_GET['id'];
    $query = "SELECT * FROM menus WHERE id = '$menu_id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $menu = mysqli_fetch_assoc($result);
        echo json_encode($menu);
    } else {
        echo json_encode(array('error' => 'Menu not found'));
    }

    mysqli_close($connection);
} else {
    echo json_encode(array('error' => 'ID not provided'));
}
?>
