<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$database = "fruits";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET requests for fetching data
    $result = $conn->query("SELECT * FROM data");
    $fruitData = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fruitData[] = $row;
        }
    }

    echo json_encode($fruitData);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests for adding new data
    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data['name'];
    $id = $data['id'];
    $family = $data['family'];
    $order = $data['order'];
    $genus = $data['genus'];
    $calories = $data['calories'];
    $fat = $data['fat'];
    $sugar = $data['sugar'];
    $carbohydrates = $data['carbohydrates'];
    $protein = $data['protein'];

    $sql = "INSERT INTO data (name, id, family, `order`, genus, calories, fat, sugar, carbohydrates, protein) 
            VALUES ('$name', $id, '$family', '$order', '$genus', $calories, $fat, $sugar, $carbohydrates, $protein)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Handle PUT requests for updating data
    parse_str(file_get_contents("php://input"), $putVars);

    $id = $putVars['id'];
    $calories = $putVars['calories'];
    $fat = $putVars['fat'];
    $sugar = $putVars['sugar'];
    $carbohydrates = $putVars['carbohydrates'];
    $protein = $putVars['protein'];

    $sql = "UPDATE data 
            SET calories = $calories, fat = $fat, sugar = $sugar, carbohydrates = $carbohydrates, protein = $protein
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Handle DELETE requests for deleting data
    parse_str(file_get_contents("php://input"), $deleteVars);

    $id = $deleteVars['id'];

    $sql = "DELETE FROM data WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

$conn->close();