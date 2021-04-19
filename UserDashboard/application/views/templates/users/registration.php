<div class="container register mt-4">
    <h2>Register</h2>
    <form action="/users/registration_process" method="post">
        <?php 
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
        ?>
        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div class="form-group">
            <label for="">Email Address:</label>
            <input type="email" name="email" class="form-control <?= ($this->session->flashdata('email_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('email_error') ?>">
        </div>
        <div class="form-group">
            <label for="">First Name:</label>
            <input type="text" name="first_name" class="form-control <?= ($this->session->flashdata('first_name_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('first_name_error') ?>">
        </div>
        <div class="form-group">
            <label for="">Last Name:</label>
            <input type="text" name="last_name" class="form-control <?= ($this->session->flashdata('last_name_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('last_name_error') ?>">
        </div>
        <div class="form-group">
            <label for="">Password:</label>
            <input type="password" name="password" class="form-control <?= ($this->session->flashdata('password_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('password_error') ?>">
        </div>
        <div class="form-group">
            <label for="">Confirm Password: </label>
            <input type="password" name="confirm_password" class="form-control <?= ($this->session->flashdata('confirm_password_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('confirm_password_error') ?>">
        </div>

        <p class="text-success"><?= $this->session->flashdata('success') ?> </p>

        <input type="submit" value="Register" class="btn btn-primary">
        <a href="/signin" style="display:block;" class="mt-5">Already have an account? Login Here!</a>
    </form>
</div>