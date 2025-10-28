<?php
$serverName = "localhost";
$connectionInfo = array("Database"=>"master", "UID"=>"sa", "PWD"=>"Password123!");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

if (isset($_GET['id'])) {
    // Directly use input as SQL (vulnerable)
    $sql = $_GET['id'];

    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Dump all rows + columns
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        foreach ($row as $col => $val) {
            echo htmlspecialchars("$col => $val") . "<br>";
        }
    }
}
?>
