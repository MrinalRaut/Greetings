<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    die("Database connection failed.");
}

$errorMessage = "";
$employeeCode = isset($_SESSION['employeeCode']) ? $_SESSION['employeeCode'] : "";
$division = isset($_SESSION['division']) ? $_SESSION['division'] : "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "POST request detected!<br>"; // Simple confirmation
    // Temporarily output the variables for inspection
    echo "Employee Code: ";
    var_dump($_POST['employeeCode']);
    echo "<br>";
    echo "Division: ";
    var_dump($_POST['division']);
    echo "<br>";
    echo "Executing SQL: SELECT id, name FROM employees WHERE employee_code = '" . mysqli_real_escape_string($conn, $_POST['employeeCode']) . "' AND division = '" . mysqli_real_escape_string($conn, $_POST['division']) . "'<br>";

    $employeeCode = mysqli_real_escape_string($conn, $_POST['employeeCode']);
    $division = mysqli_real_escape_string($conn, $_POST['division']);

    // Store the values in the session
    $_SESSION['employeeCode'] = $employeeCode;
    $_SESSION['division'] = $division;

    if (empty($employeeCode)) {
        $errorMessage = "Please enter your Employee Code.";
    } elseif (!is_numeric($employeeCode) || $employeeCode < 1 || $employeeCode > 5) {
        $errorMessage = "Employee Code must be a number between 1 and 5.";
    } elseif (empty($division)) {
        $errorMessage = "Please select your Division.";
    } else {
        $sql = "SELECT id, name FROM employees WHERE employee_code = '$employeeCode' AND division = '$division'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['employee_id'] = $row['id'];
            $_SESSION['employee_name'] = $row['name'];
            header("Location: login.php");
            exit();
        } else {
            $errorMessage = "Invalid Employee Code or Division.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Don't Miss to Wish (Initial)</title>
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
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            min-height: 350px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: calc(100% - 12px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            min-height: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Welcome </h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="input-group">
                <label for="employeeCode">Employee Code:</label>
                <input type="text" id="employeeCode" name="employeeCode" value="<?php echo htmlspecialchars($employeeCode); ?>">
            </div>

            <div class="input-group">
                <label for="division">Division:</label>
                <select id="division" name="division">
                    <option value="">Select Division</option>
                    <option value="Excel" <?php if ($division == 'Excel') echo 'selected'; ?>>Excel</option>
                    <option value="Pharma" <?php if ($division == 'Pharma') echo 'selected'; ?>>Pharma</option>
                    <option value="Spade" <?php if ($division == 'Spade') echo 'selected'; ?>>Spade</option>
                    <option value="Spera" <?php if ($division == 'Spera') echo 'selected'; ?>>Spera</option>
                    <option value="Synergy" <?php if ($division == 'Synergy') echo 'selected'; ?>>Synergy</option>
                    <option value="Vision" <?php if ($division == 'Vision') echo 'selected'; ?>>Vision</option>
                </select>
            </div>

            <button type="submit">Next</button>
            <?php if (!empty($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>

        </form>

    </div>
</body>
</html>