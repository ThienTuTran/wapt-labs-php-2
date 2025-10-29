<?php
// simple insecure filter function
function insecure_filter($input) {
    // Blacklist
    $blacklist = ["<script>", "</script>", "onload=", "onerror=", "alert(", "prompt(", "confirm(", "javascript:", "iframe", "svg", "img", "src=", "href=", "body", "embed", "object", "video", "audio", "style", "base", "link", "meta", "form", "input", "textarea", "button", "marquee", "math", "xss", "applet","onfocus="];

    foreach ($blacklist as $bad) {
        $input = str_ireplace($bad, "", $input);
    }
    return $input;
}

// Get input from form
$user_input = "";
if (isset($_POST['data'])) {
    $user_input = insecure_filter($_POST['data']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insecure XSS Filter Lab</title>
</head>
<body>
    <h1>Insecure XSS Filter Demo</h1>
    <form method="POST">
        <label>Enter text:</label>
        <input type="text" name="data" />
        <input type="submit" value="Submit" />
    </form>

    <h3>Output:</h3>
    <div>
        <?php echo $user_input; ?>
    </div>
</body>
</html>
