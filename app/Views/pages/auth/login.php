<div class="login-container">
    <h2>Login Form</h2>
    <?php if (session('errors')) :
        foreach (session('errors') as $key => $value) { ?>
            <div class="error"><?= $value ?></div>
    <?php
        }
    endif; ?>
    <?php if (session('success')) : ?>
        <div class="success"><?= session('success') ?></div>
    <?php endif; ?>
    <form action="/doLogin" method="post">
        <?= csrf_field() ?>
        <input type="email" name="email" placeholder="email" required />
        <input type="password" name="password" placeholder="Password" required />
        <a href="/forgot_password" style="text-decoration: none;">Forgot password</a>
        <input type="submit" value="Login" style="margin-top: 1rem;"/>
        <div style="margin-top: 2rem; text-align: center;">
            <span>Dont have account? <a href="/register" style="text-decoration: none;">Register</a></span>
        </div>
    </form>
</div>