<div class="container signin mt-4">
    <div class="row">
        <div class="col-6">
            <h2>Admin Sign in</h2>
            <form action="/users/signin_proccess" method="POST">
                <?php
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                ?>
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control <?= ($this->session->flashdata('email_error')) ? 'error' : '' ?>" placeholder="<?= $this->session->flashdata('email_error') ?>">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control <?= ($this->session->flashdata('password_error')) ? 'error' : '' ?>" placeholder="<?= $this->session->flashdata('password_error') ?>">
                </div>
                <input type="submit" value="Sign in" class="btn btn-primary">
            </form>
            <a href="/register" class="mt-3" style="display:block;">Don't have an account? Register Here!</a>
        </div>
    </div>
</div>