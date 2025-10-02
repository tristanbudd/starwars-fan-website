<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = trim($_POST['auth_key'] ?? '');

    if (preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $key)) {
        $_SESSION['SECRET_KEY'] = $key;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Invalid authentication key.';
    }
}
?>

<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="">
    <label for="auth_key">Authentication Key:</label>
    <input type="text" id="auth_key" name="auth_key" required>
    <button type="submit">Submit</button>
</form>