<?php
session_start();

$error = '';

$env_key = getenv('SECRET_KEY') ?: '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_key = trim($_POST['auth_key'] ?? '');

    if ($input_key === $env_key) {
        setcookie('SECRET_KEY', $input_key, time() + 3600, "/", "", false, true);

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

<footer>
    <hr>
    <p><strong>Cookie Policy:</strong>
        This site uses a temporary authentication cookie to maintain your session.
        It expires automatically after logout or inactivity.
        No personal data, tracking, or analytics cookies are stored.</p>
</footer>
