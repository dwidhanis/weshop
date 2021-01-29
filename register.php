<div id="container-user-akses">

    <form action="<?php echo BASE_URL."proses_register.php"; ?>" method="POST"></form>

        <div class="element-form">
            <label>Nama Lengkap</label>
            <span><input type="text" name="nama_lengkap"/></span>
        </div>

        <div class="element-form">
            <label>Email</label>
            <span><input type="text" name="email"/></span>
        </div>

        <div class="element-form">
            <label>Nomor Telepon</label>
            <span><input type="text" name="phone"/></span>
        </div>

        <div class="element-form">
            <label>Alamat</label>
            <span><textarea name="alamat"></textarea></span>
        </div>

        <div class="element-form">
            <label>Password</label>
            <span><input type="password" name="password"/></span>
        </div>

        <div class="element-form">
            <label>Re-type Password</label>
            <span><input type="password" name="re-password"/></span>
        </div>

        <div class="element-form">
            <span><input type="submit" value="register"/></span>
        </div>

    </form>
</div>