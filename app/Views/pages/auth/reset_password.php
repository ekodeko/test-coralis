<div class="container">
    <h2>Reset Password</h2>
    <form action="/reset_password" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= $token ?>">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <input type="submit" value="Reset Password">
    </form>
</div>