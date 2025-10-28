<?php
libxml_disable_entity_loader(false);

// Load XML
$xml = simplexml_load_file("users.xml");

// Handle logout
if (isset($_POST['logout'])) {
    echo "<h3>Login.</h3>";
    echo '<form method="POST">
            <label>Username: </label><input type="text" name="username"><br>
            <label>Password: </label><input type="password" name="password"><br>
            <input type="submit" value="Login">
          </form>';
    exit;
}

// Get user input from form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Vulnerable XPath query
$query = "//user[username/text()='$username' and password/text()='$password']";

// Execute query
$result = $xml->xpath($query);

if ($result) {
    echo "<h3>Login successful!</h3>";
    foreach ($result as $user) {
        echo "Welcome, " . $user->username . "<br>";
        echo "Your secret: " . $user->secret . "<br><br>";
    }
    echo '<form method="POST">
            <input type="submit" name="logout" value="Logout">
          </form>';
} else {
    echo "<h3>Login failed</h3>";
    echo '<form method="POST">
            <label>Username: </label><input type="text" name="username"><br>
            <label>Password: </label><input type="password" name="password"><br>
            <input type="submit" value="Login">
          </form>';
}
?>
