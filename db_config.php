<?php
// db_config.php
// Database connection for XAMPP default settings

$host = 'localhost';
$username = 'root';           // Default XAMPP MySQL username
$password = '';               // Default XAMPP MySQL password (empty)
$database = 'nba_league_system';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

// Start session (for user authentication later)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in, fetch their information from database
    $user_id = $_SESSION['user_id'];
    
    $user_query = "SELECT ID, first_name, last_name, type 
                   FROM `User` 
                   WHERE ID = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        
        // Set session variables with fresh data from database
        $_SESSION['user_type'] = $user_data['type'];
        $_SESSION['user_name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
        $_SESSION['first_name'] = $user_data['first_name'];
        $_SESSION['last_name'] = $user_data['last_name'];
    } else {
        // User ID in session doesn't exist in database, clear session
        session_unset();
        session_destroy();
    }
    $stmt->close();
} 

else {///////////////////////////////// OVAJ ELSE STATEMENT JE SAMO KADA NEMAM LOGIN PA MORAM DA HARDKODUJEM DA BI SVE TESTIRAO, OBAVEZNO OBRISATIII//////////////////////////////////
    // No user logged in - for now, hardcode admin for testing
    // REMOVE THIS SECTION when you implement login system
    $_SESSION['user_id'] = 3;        // Admin user ID from sample data
    $_SESSION['user_type'] = 'admin';
    $_SESSION['user_name'] = 'Admin User';
    $_SESSION['first_name'] = 'Admin';
    $_SESSION['last_name'] = 'User';
    
    // TO REMOVE THIS HARDCODED LOGIN:
    // 1. Delete lines 46-51 above
    // 2. Instead redirect to login page:
    // header('Location: login.php');
    // exit();
}


?>