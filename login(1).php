<?php
session_start();

$db_config = require_once('config_db.php');

try {
    $conn = mysqli_connect(
        $db_config['db_host'],
        $db_config['db_user'],
        $db_config['db_password'],
        $db_config['db_name']
    );
    mysqli_set_charset($conn, "utf8");
} catch (Exception $e) {
    die("Database connection failed."); // Simplified error handling
}

if (!isset($_SESSION['employeeCode']) || !isset($_SESSION['division'])) {
    header("Location: index.php");
    exit();
}

$employeeCode = $_SESSION['employeeCode'];
$division = $_SESSION['division'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login - Don't Miss to Wish</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
        }
        .input-field {
            margin-bottom: 20px;
        }
        .input-field label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        .input-field input[type="text"], .input-field select {
            width: calc(100% - 22px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .button-group {
            margin-top: 30px;
        }
        .button-group button {
            background-color: #007bff;
            color: white;
            padding: 14px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            margin: 0 10px;
        }
        .button-group button:hover {
            background-color: #0056b3;
        }
        .prefilled-value {
            color: #777;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Page</h2>
        <form action="page3.php" method="post">
            <div class="input-field">
                <label for="employeeCode">Employee Code:</label>
                <input type="text" id="employeeCode" name="employeeCode" value="<?php echo htmlspecialchars($employeeCode, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                <input type="hidden" name="employeeCode" value="<?php echo htmlspecialchars($employeeCode, ENT_QUOTES, 'UTF-8'); ?>">
                <p class="prefilled-value">Prefilled from previous page</p>
            </div>

            <div class="input-field">
                <label for="division">Division:</label>
                <input type="text" id="division" name="division" value="<?php echo htmlspecialchars($division, ENT_QUOTES, 'UTF-8'); ?>" readonly>
                <input type="hidden" name="division" value="<?php echo htmlspecialchars($division, ENT_QUOTES, 'UTF-8'); ?>">
                <p class="prefilled-value">Prefilled from previous page</p>
            </div>

            <div class="input-field">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>

            <div class="input-field">
                <label for="agm">AGM:</label>
                <input type="text" id="agm" name="agm">
            </div>

            <div class="input-field">
                <label for="testUser">TestUser:</label>
                <input type="text" id="testUser" name="testUser">
            </div>

            <div class="button-group">
                <button type="submit">LOGIN</button>
                <button type="button" onclick="window.location.href='index.php'">BACK</button>
            </div>
        </form>
    </div>
</body>
</html>