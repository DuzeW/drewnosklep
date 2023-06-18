<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");

function getProduct($productId) {
    global $mysqli;
    $selectQuery = "SELECT * FROM product WHERE id=$productId";
    $result = $mysqli->query($selectQuery);
    return $result->fetch_assoc();
}

function saveChanges($productId, $price, $quantity) {
    global $mysqli;
    $updateQuery = "UPDATE product SET price=$price, quantity_available=$quantity WHERE id=$productId";
    $mysqli->query($updateQuery);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["edit"])) {
        $productId = $_POST["product_id"];
        $price = $_POST["price_$productId"];
        $quantity = $_POST["quantity_$productId"];
        saveChanges($productId, $price, $quantity);
    }
}

$selectAllQuery = "SELECT id, name, class, price, quantity_available, img_path, category_id, scantling_l, scantling_h, scantling_w FROM product";
$result = $mysqli->query($selectAllQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edycja produktów</title>
</head>
<body>
<h1>Edycja produktów</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nazwa</th>
        <th>Klasa</th>
        <th>Cena</th>
        <th>Dostępna ilość</th>
        <th>Ścieżka do obrazka</th>
        <th>ID kategorii</th>
        <th>Grubość (mm)</th>
        <th>Wysokość (mm)</th>
        <th>Szerokość (mm)</th>
        <th>Akcje</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) {
        $productId = $row["id"];
        $product = getProduct($productId);
        ?>
        <tr>
            <td><?php echo $productId; ?></td>
            <td><?php echo $product["name"]; ?></td>
            <td><?php echo $product["class"]; ?></td>
            <td>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="number" name="price_<?php echo $productId; ?>" value="<?php echo $product["price"]; ?>">
                    <input type="submit" name="edit" value="Zapisz">
                </form>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="number" name="quantity_<?php echo $productId; ?>" value="<?php echo $product["quantity_available"]; ?>">
                    <input type="submit" name="edit" value="Zapisz">
                </form>
            </td>
            <td><?php echo $product["img_path"]; ?></td>
            <td><?php echo $product["category_id"]; ?></td>
            <td><?php echo $product["scantling_l"]; ?></td>
            <td><?php echo $product["scantling_h"]; ?></td>
            <td><?php echo $product["scantling_w"]; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
