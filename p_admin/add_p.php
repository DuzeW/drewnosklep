<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
function addProduct($name, $class, $price, $quantity, $imgPath, $categoryId, $scantlingL, $scantlingH, $scantlingW) {
    global $mysqli;
    $insertQuery = "INSERT INTO product (name, class, price, quantity_available, img_path, category_id, scantling_l, scantling_h, scantling_w)
                    VALUES ('$name', '$class', $price, $quantity, '$imgPath', $categoryId, $scantlingL, $scantlingH, $scantlingW)";
    $mysqli->query($insertQuery);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add"])) {
        $name = $_POST["name"];
        $class = $_POST["class"];
        $price = $_POST["price"];
        $quantity = $_POST["quantity"];
        $imgPath = $_POST["img_path"];
        $categoryId = $_POST["category_id"];
        $scantlingL = $_POST["scantling_l"];
        $scantlingH = $_POST["scantling_h"];
        $scantlingW = $_POST["scantling_w"];
        addProduct($name, $class, $price, $quantity, $imgPath, $categoryId, $scantlingL, $scantlingH, $scantlingW);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dodawanie produktu</title>
</head>
<body>
<h1>Dodawanie produktu</h1>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="name">Nazwa:</label>
    <input type="text" name="name" id="name" required>
    <label for="class">Klasa:</label>
    <input type="text" name="class" id="class" required>
    <label for="price">Cena:</label>
    <input type="number" name="price" id="price" required>
    <label for="quantity">Dostępna ilość:</label>
    <input type="number" name="quantity" id="quantity" required>
    <label for="img_path">Ścieżka do obrazka:</label>
    <input type="text" name="img_path" id="img_path" required>
    <label for="category_id">ID kategorii:</label>
    <input type="number" name="category_id" id="category_id" required>
    <label for="scantling_l">Długość (mm):</label>
    <input type="number" name="scantling_l" id="scantling_l" required>
    <label for="scantling_h">Wysokość (mm):</label>
    <input type="number" name="scantling_h" id="scantling_h" required>
    <label for="scantling_w">Szerokość (mm):</label>
    <input type="number" name="scantling_w" id="scantling_w" required>
    <input type="submit" name="add" value="Dodaj">
</form>
</body>
</html>
