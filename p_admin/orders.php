<?php
include '../php_function/show_orders.php';
include '../php_function/head.php';
head_for_subdomain_p_chosen();
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");

if ($mysqli->connect_error) {
    die("Błąd" . $mysqli->connect_error);
}

function getUsers()
{
    global $mysqli;

    $query = "SELECT id, e_mail FROM user_data";
    $result = $mysqli->query($query);

    $users = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[$row['id']] = $row['e_mail'];
        }
    }

    return $users;
}

function getOrdersForUser($userId)
{
    global $mysqli;

    $query = "SELECT id, order_date, status_of_order_id FROM orders WHERE user_data_id='$userId'";
    $result = $mysqli->query($query);

    $orders = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

function deleteOrder($orderId)
{
    global $mysqli;

    $query = "DELETE FROM orders WHERE id='$orderId'";
    $result = $mysqli->query($query);

    return $result;
}

$users = getUsers();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["user_id"])) {
        $userId = $_POST["user_id"];
        $orders = getOrdersForUser($userId);
    }

    if (isset($_POST["delete_order"])) {
        $orderId = $_POST["order_id"];
        $deleteResult = deleteOrder($orderId);

    } elseif (isset($_POST["update_order"])) {
        $orderId = $_POST["order_id"];
        $statusId = $_POST["status_id"];
        $query = "UPDATE orders SET status_of_order_id='$statusId' WHERE id='$orderId'";
        $result = $mysqli->query($query);
    }
    elseif (isset($_POST["show_order"])){
        $orderId = $_POST["order_id"];
        echo 'Pokazuje zamówienie nr:';
        echo $orderId;
        show_ordered_p($orderId);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel administracyjny</title>
</head>
<body>
<h1>Panel administracyjny</h1>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="user_id">Wybierz użytkownika:</label>
    <select name="user_id" id="user_id" required>
        <option value="">Wybierz</option>
        <?php
        foreach ($users as $userId => $email) {
            echo "<option value='$userId'>$email</option>";
        }
        ?>
    </select>
    <input type="submit" value="Pokaż zamówienia">
</form>

<?php
if (isset($orders)) {
    if (!empty($orders)) {
        foreach ($orders as $order) {
            $orderId = $order["id"];
            $orderDate = $order["order_date"];
            $statusId = $order["status_of_order_id"];
            ?>
            <br>
            <div class="message">
                <strong>ID zamówienia:</strong> <?php echo $orderId; ?><br>
                <strong>Data zamówienia:</strong> <?php echo $orderDate; ?><br>
                <strong>Status zamówienia:</strong> <?php echo $statusId; ?><br>

                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                    <label for="status_id">Nowy status zamówienia:</label>
                    <input type="text" name="status_id" id="status_id" value="<?php echo $statusId; ?>"><br>
                    <input type="submit" name="show_order" value="Pokaż zamówienie">
                    <input type="submit" name="update_order" value="Zaktualizuj zamówienie">
                    <input type="submit" name="delete_order" value="Usuń zamówienie">
                </form>
            </div>
            <?php
        }
    } else {
        echo '<div>Brak zamówień dla tego użytkownika.</div>';
    }
}
?>
</body>
</html>
