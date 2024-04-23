<div class="login-container">
    <h2>Register Form</h2>
    <?php if (session('errors')) :
        foreach (session('errors') as $key => $value) { ?>
            <div class="error"><?= $value ?></div>
    <?php
        }
    endif; ?>
    <form action="/doRegister" method="post">
        <?= csrf_field() ?>
        <input type="text" name="fullname" placeholder="Fullname" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Register" />
        <div style="margin-top: 2rem; text-align: center;">
            <span>Already have account? <a href="/login" style="text-decoration: none;">Login</a></span>
        </div>
    </form>
</div>