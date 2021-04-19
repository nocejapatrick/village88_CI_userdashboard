<div class="container mt-4">
    <div class="row">
        <h3 class="col-6">Add a new user</h3>
        <div class="col-6 text-right">
            <a href="/dashboard/admin" class="btn btn-primary">Return to Dashboard</a>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mt-4">
            <form action="/users/new_user_process" method="post">
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

                <input type="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>