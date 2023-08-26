<?php
// use this to run the demo programs via the built-in PHP web server
// to run, from the project root run this command:
// php -S localhost:8888
// then, from your browser: http://localhost:8888
session_start();
if (!empty($_GET)) {
    $user = (!empty($_GET['user'])) ? strip_tags($_GET['user']) : '';
    $password = (!empty($_GET['password'])) ? strip_tags($_GET['password']) : '';
    $_SESSION['user'] = $user;
    $_SESSION['password'] = $password;
}
$user = $_SESSION['user'] ?? '';
$password = $_SESSION['password'] ?? '';
$html = '<ul>';
$list = new RecursiveDirectoryIterator(__DIR__ . '/demos');
foreach ($list as $name => $obj) {
    $html .= ($obj->isFile())
             ? '<li><a target="_blank" href="/demos/' . basename($name) . '?user=' . $user . '&password=' . $password . '">' . basename($name) . '</a></li>'
             : '';
}
$html .= '</ul>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>USPS PHP API Test</title>
<meta name="generator" content="Geany 1.38" />
</head>
<body>
<form method="get">
USPS Username: <input type="text" name="user" value="<?= htmlspecialchars($user); ?>" />&nbsp;
USPS Password: <input type="text" name="password" value="<?= htmlspecialchars($password); ?>" />&nbsp;
<input type="submit" name="submit" value="Update" />
</form>
<?= $html; ?>
</body>
</html>

