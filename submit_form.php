<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database config (adjust for MAMP or XAMPP)
$host = "localhost";
$user = "vmteckqe_vmteckqe";
$password = "Vinod_Mani@786"; // Use "root" if you're on MAMP
$dbname = "vmteckqe_VMTFS_DB";

// Optional: add MAMP port if needed
// $port = 8889;
// $conn = new mysqli($host, $user, $password, $dbname, $port);
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Process form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $conn->real_escape_string($_POST['full_name']);
    $email   = $conn->real_escape_string($_POST['email']);
    $phone   = $conn->real_escape_string($_POST['phone']);
    $role    = $conn->real_escape_string($_POST['role']);
    $domain  = $conn->real_escape_string($_POST['domain']);
    $message = $conn->real_escape_string($_POST['message']);

    // Resume upload
    $resumeName = basename($_FILES['resume']['name']);
    $resumeTmp  = $_FILES['resume']['tmp_name'];
    $uploadDir  = "uploads/";
    $uploadPath = $uploadDir . $resumeName;

    if (move_uploaded_file($resumeTmp, $uploadPath)) {
        // Insert into DB
        $sql = "INSERT INTO applications (full_name, email, phone, role_type, domain, message, resume_file)
                VALUES ('$name', '$email', '$phone', '$role', '$domain', '$message', '$resumeName')";

        if ($conn->query($sql) === TRUE) {
            echo "<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <title>Application Submitted</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin-top: 100px;
      background-color: #f0f4f8;
    }
    .success {
      background: white;
      display: inline-block;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h1 {
      color: green;
    }
  </style>
</head>
<body>
  <div class='success'>
    <h1>✅ Application Submitted</h1>
    <p>Thank you, <strong>$name</strong>. We have received your application.</p>
  </div>
</body>
</html>";
        } else {
            echo "❌ Database error: " . $conn->error;
        }
    } else {
        echo "❌ Failed to upload resume.";
    }
} else {
    echo "❌ Invalid request.";
}

$conn->close();
?>
