<?php
session_start();

$error = '';

$env_key = getenv('SECRET_KEY') ?: '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_key = trim($_POST['auth_key'] ?? '');

    if ($input_key === $env_key) {
        $_SESSION['SECRET_KEY'] = $input_key;

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