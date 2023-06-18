<?php
$mysqli = new mysqli("localhost", "root", "", "drewnosklepdb");
$query = "SELECT id, name, description FROM category";
$result = $mysqli->query($query);

function saveChanges($categoryId, $name, $description) {
    global $mysqli;
    $updateQuery = "UPDATE category SET name='$name', description='$description' WHERE id='$categoryId'";
    $mysqli->query($updateQuery);
}

function deleteCategory($categoryId) {
    global $mysqli;
    $deleteQuery = "DELETE FROM category WHERE id='$categoryId'";
    $mysqli->query($deleteQuery);
}

function addCategory($name, $description) {
    global $mysqli;
    $insertQuery = "INSERT INTO category (name, description) VALUES ('$name', '$description')";
    $mysqli->query($insertQuery);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["edit"])) {
        $categoryId = $_POST["category_id"];
        $name = $_POST["name_$categoryId"];
        $description = $_POST["description_$categoryId"];
        saveChanges($categoryId, $name, $description);
    } elseif (isset($_POST["delete"])) {
        $categoryId = $_POST["category_id"];
        deleteCategory($categoryId);
    } elseif (isset($_POST["add"])) {
        $name = $_POST["new_name"];
        $description = $_POST["new_description"];
        addCategory($name, $description);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edycja kategorii</title>
</head>
<body>
<h1>Edycja kategorii</h1>

<h2>Aktualne kategorie</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nazwa</th>
        <th>Opis</th>
        <th>Akcje</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $categoryId = $row["id"];
        $name = $row["name"];
        $description = $row["description"];
        ?>
        <tr>
            <td><?php echo $categoryId; ?></td>
            <td>
                <input type="text" name="name_<?php echo $categoryId; ?>" value="<?php echo $name; ?>">
            </td>
            <td>
                <textarea name="description_<?php echo $categoryId; ?>" rows="5"><?php echo $description; ?></textarea>
            </td>
            <td>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>">
                    <input type="submit" name="edit" value="Zapisz">
                    <input type="submit" name="delete" value="Usuń">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<h2>Dodaj nową kategorię</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="new_name">Nazwa:</label>
    <input type="text" name="new_name" id="new_name" required>
    <label for="new_description">Opis:</label>
    <textarea name="new_description" id="new_description" rows="5" required></textarea>
    <input type="submit" name="add" value="Dodaj">
</form>
</body>
</html>
