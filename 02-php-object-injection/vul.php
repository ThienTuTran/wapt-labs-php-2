<?php

//--------------------- Deletes files ----------------------
class FileDeleter {
    public $cache_file;

    function __destruct() {
        $file = "/var/www/html/tmp/{$this->cache_file}";
        if (file_exists($file)) @unlink($file);
    }
}

if (isset($_GET['data'])) {
    $user_data = unserialize($_GET['data']);  // vulnerable
}

//-------------------- Executes commands --------------------
class CommandExec {
    private $hook;

    function __wakeup() {
        if (isset($this->hook)) eval($this->hook);
    }
}

if (isset($_COOKIE['data'])) {
    $user_data = unserialize($_COOKIE['data']); // vulnerable
}

//---------------------- SQL injection ----------------------
// Show all PHP errors in browser (for debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- DB connection factory ---
class DBFactory {
    public static function getConnection() {
        $conn = mysqli_connect("localhost", "demo", "demo123", "demo");
        if (!$conn) {
            die("DB connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}

// --- Vulnerable classes ---
class SQL_Row_Value {
    private $_table;

    function getValue($id = 1) {
        $conn = DBFactory::getConnection();
        $sql = "SELECT * FROM {$this->_table}";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return "Running query: $sql\nResult: " . json_encode($row) . "\n";
        } else {
            return "SQL Error: " . mysqli_error($conn) . "\n";
        }
    }
}

class SQLi {
    protected $obj;

    function __toString() {
        return isset($this->obj) ? $this->obj->getValue() : '';
    }
}

// ---- Sink ----
if (!empty($_POST['data'])) {
    $obj = @unserialize($_POST['data']);  // vulnerable
    echo "<pre>";
    if ($obj === false && $_POST['data'] !== 'b:0;') {
        echo "unserialize() failed\n";
    } else {
        echo "Unserialized type: " . get_class($obj) . "\n\n";
        echo $obj;  // triggers __toString()
    }
    echo "</pre>";
}
?>


<!-- -------------------- Minimal UI -------------------- -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Object Injection Demo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
    </style>
</head>
<body>
    <h1>PHP Object Injection Demo</h1>
</body>
</html>
