<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

include 'DbConnect.php';
$objDb = new DbConnect;
$conn = $objDb->connect();

$case = $_GET['xCase'];
switch ($case) {
    case 0: // Getdata
        $sql = "SELECT * FROM news JOIN typenews USING(typeNewsID) Where void = 0";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($path[4]) && is_numeric($path[4])) {
            $sql .= " and newsID = :newsID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':newsID', $path[4]);
            $stmt->execute();
            $location = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $location = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        echo json_encode($location);
        break;

    // case 1: //Insert data
    //     $target_dir = "img/";
    //     // img1
    //     $target_file1 = $target_dir . uniqid() . basename($_FILES["img1"]["name"]);
    //     move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file1);
    //     // img2
    //     $target_file2 = $target_dir . uniqid() . basename($_FILES["img2"]["name"]);
    //     move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file2);
    //     // img3
    //     $target_file3 = $target_dir . uniqid() . basename($_FILES["img3"]["name"]);
    //     move_uploaded_file($_FILES["img3"]["tmp_name"], $target_file3);
    //     $sql = "INSERT INTO location(id,img, namelocation, locationLat, locationLng, riskID, equipPlace, equipLat, equipLng, practiceArea, howtoUse, void) VALUES(null,:img1, :namelocation, :locationLat, :locationLng, :riskID, :img2, :equipLat, :equipLng, :practiceArea, :img3,0)";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':img1', $target_file1);
    //     $stmt->bindParam(':namelocation', $_POST["namelocation"]);
    //     $stmt->bindParam(':locationLat', $_POST["locationLat"]);
    //     $stmt->bindParam(':locationLng', $_POST["locationLng"]);
    //     $stmt->bindParam(':riskID', $_POST["riskID"]);
    //     $stmt->bindParam(':img2', $target_file2);
    //     $stmt->bindParam(':equipLat', $_POST["equipLat"]);
    //     $stmt->bindParam(':equipLng', $_POST["equipLng"]);
    //     $stmt->bindParam(':practiceArea', $_POST["practiceArea"]);
    //     $stmt->bindParam(':img3', $target_file3);
    //     if ($stmt->execute()) {
    //         $response = ['status' => 1, 'message' => 'Record created successfully.'];
    //     } else {
    //         $response = ['status' => 0, 'message' => 'Failed to create record.'];
    //     }
    //     echo json_encode($response);
    //     break;

    // case 2: //Update data 
    //     $target_dir = "img/";
    //     $sql = "UPDATE location SET namelocation = :namelocation, locationLat = :locationLat, locationLng = :locationLng, riskID = :riskID, equipLat = :equipLat, equipLng = :equipLng, practiceArea = :practiceArea ";
    //     // img1
    //     if ($_FILES["img1"] != null) {
    //         $sql .= ", img = :img1";
    //         $target_file1 = $target_dir . uniqid() . basename($_FILES["img1"]["name"]);
    //         move_uploaded_file($_FILES["img1"]["tmp_name"], $target_file1);
    //     } else {
    //     }
    //     // img2
    //     if ($_FILES["img2"] != null) {
    //         $sql .= ", equipPlace = :img2";
    //         $target_file2 = $target_dir . uniqid() . basename($_FILES["img2"]["name"]);
    //         move_uploaded_file($_FILES["img2"]["tmp_name"], $target_file2);
    //     } else {
    //     }
    //     // img3
    //     if ($_FILES["img3"] != null) {
    //         $sql .= ", howtoUse = :img3";
    //         $target_file3 = $target_dir . uniqid() . basename($_FILES["img3"]["name"]);
    //         move_uploaded_file($_FILES["img3"]["tmp_name"], $target_file3);
    //     } else {
    //     }
    //     // where id 
    //     $sql .= " WHERE id = :id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':id', $_POST["id"]);
    //     // if check img
    //     if ($_FILES["img1"] != null) {
    //         $stmt->bindParam(':img1', $target_file1);
    //     } else {
    //     }
    //     $stmt->bindParam(':namelocation', $_POST["namelocation"]);
    //     $stmt->bindParam(':locationLat', $_POST["locationLat"]);
    //     $stmt->bindParam(':locationLng', $_POST["locationLng"]);
    //     $stmt->bindParam(':riskID', $_POST["riskID"]);
    //     if ($_FILES["img2"] != null) {
    //         $stmt->bindParam(':img2', $target_file2);
    //     } else {
    //     }
    //     $stmt->bindParam(':equipLat', $_POST["equipLat"]);
    //     $stmt->bindParam(':equipLng', $_POST["equipLng"]);
    //     $stmt->bindParam(':practiceArea', $_POST["practiceArea"]);
    //     if ($_FILES["img3"] != null) {
    //         $stmt->bindParam(':img3', $target_file3);
    //     } else {
    //     }
    //     if ($stmt->execute()) {
    //         $response = ['status' => 1, 'message' => 'Record created successfully.'];
    //     } else {
    //         $response = ['status' => 0, 'message' => 'Failed to create record.'];
    //     }
    //     echo json_encode($response);
    //     break;


    // case 3: //Delete data 
    //     $user = json_decode(file_get_contents('php://input'));
    //     $path = explode('/', $_SERVER['REQUEST_URI']);
    //     // Delete file 
    //     $statement = $conn->prepare("SELECT img, equipPlace, howtoUse FROM location WHERE id = :id");
    //     $statement->bindParam(':id', $path[4]);
    //     $statement->execute();
    //     $result = $statement->fetchall(PDO::FETCH_ASSOC);
    //     foreach ($result as $row) {
    //         if ($result != '') {
    //             unlink($row["img"]);
    //             unlink($row["equipPlace"]);
    //             unlink($row["howtoUse"]);
    //         }
    //     }
    //     // Delete database
    //     $sql = "UPDATE location SET void = '1' Where id = :id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':id', $path[4]);

    //     if ($stmt->execute()) {
    //         $response = ['status' => 1, 'message' => $stmt];
    //     } else {
    //         $response = ['status' => 0, 'message' => 'Failed to delete record.'];
    //     }
    //     echo json_encode($response);
    //     break;
    case 4: // GetTypeNews
        $sql = "SELECT * FROM typenews";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $location = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($location);
        break;
}
