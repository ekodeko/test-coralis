<div class="container">
    <h2>Reset Password</h2>
    <form action="/forgot_password" method="post">
        <?= csrf_field() ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Reset Password">
        <a href="/login" style="text-decoration: none;">Back to login</a>
    </form>
</div>