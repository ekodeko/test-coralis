<div class="profile-container">
    <?php if (session('success')) : ?>
        <div class="success"><?= session('success') ?></div>
    <?php endif; ?>
    <?php if (session('errors')) :
        foreach (session('errors') as $key => $value) { ?>
            <div class="error"><?= $value ?></div>
    <?php
        }
    endif; ?>
    <form action="/update_profile_picture" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <h2><?= $data['fullname'] ?></h2>
        <div class="profile_wrapper">
            <img src="<?= $data['profile_picture'] ? base_url('images/'.$data['profile_picture']) : base_url('images/default_profile.jpg') ?>" alt="Profile Picture" class="profile-image" id="profile-image">
            <label for="file-upload" id="file-upload-wrapper"></label>
        </div>
        <br>
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="file" id="file-upload" name="profile_picture" accept="image/*" onchange="displayImage(this)">
        <input type="submit" value="Update Profile" class="btn-upload">
        <a href="/logout">Logout</a>
    </form>
</div>

<script>
    function displayImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-image').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>