<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["excelFile"])) {
    $targetDirectory = '../documents/'; // Directory where you want to store uploaded files
    print_r($targetDirectory);
    $targetFile = $targetDirectory . basename($_FILES["excelFile"]["name"]);

    if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
?>