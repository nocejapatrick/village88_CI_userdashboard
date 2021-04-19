<div class="container mt-4">
    <div class="row">
        <?php if($this->session->userdata('user')->user_level == 9){?>
          <h3 class="col-6">Edit user # <?= $user->id ?></h3>
        <?php }else{?>
            <h3 class="col-6">Edit Profile</h3>
            <?php }?>
        <div class="col-6 text-right">
            <a href="/dashboard/admin" class="btn btn-primary">Return to Dashboard</a>
        </div>
    </div>
    <div class="row mt-4 justify-content-between">
        <div class="col-6 pr-4">
            <div class="card">
                <div class="card-header">
                    Edit Information
                </div>
                <div class="card-body">
                    <form action="/users/edit_information_process" method="post">
                        <?php 
                            $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash()
                            );
                        ?>
                            <?php if($this->session->userdata('user')->user_level == 9){?>
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <?php }?>
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <div class="form-group">
                            <label for="">Email Address:</label>
                            <input type="email" name="email" value="<?= $user->email ?>" class="form-control <?= ($this->session->flashdata('email_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('email_error') ?>">
                        </div>
                        <div class="form-group">
                            <label for="">First Name:</label>
                            <input type="text" name="first_name" value="<?= $user->first_name ?>" class="form-control <?= ($this->session->flashdata('first_name_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('first_name_error') ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name:</label>
                            <input type="text" name="last_name"value="<?= $user->last_name ?>"  class="form-control <?= ($this->session->flashdata('last_name_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('last_name_error') ?>">
                        </div>
                        <div class="form-group">
                            <label for="">User Level: </label>
                            <select name="user_level" id="" class="form-control">
                                <option value="1" <?=($user->user_level==1) ?"selected" : ""?>>Normal</option>
                                <option value="9" <?=($user->user_level==9) ?"selected" : ""?>>Admin</option>
                            </select>
                        </div>
                        <p class="text-success"><?= $this->session->flashdata('success') ?></p>
                        <div class="text-right">
                           <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                   
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 pl-4">
            <div class="card">
                <div class="card-header">
                    Change Password
                </div>
                <div class="card-body">
                    <form action="/users/change_password_process" method="post">
                        <?php 
                            $csrf = array(
                                'name' => $this->security->get_csrf_token_name(),
                                'hash' => $this->security->get_csrf_hash()
                            );
                        ?>
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                        <?php if($this->session->userdata('user')->user_level == 9){?>
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <?php }?>
                        <div class="form-group">
                            <label for="">Password:</label>
                            <input type="password" name="password" class="form-control <?= ($this->session->flashdata('password_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('password_error') ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password: </label>
                            <input type="password" name="confirm_password" class="form-control <?= ($this->session->flashdata('confirm_password_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('confirm_password_error') ?>">
                        </div>

                        <p class="text-success"><?= $this->session->flashdata('success_updated_password') ?></p>
                        <div class="text-right">
                            <input type="submit" value="Update Password" class="btn btn-primary">
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
        <?php if($this->session->userdata('user')->user_level == 1){?>
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        Edit Description
                    </div>
                    <div class="card-body">
                        <form action="/users/edit_description_process" method="post">
                            <?php 
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                            ?>
                            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                            <div class="form-group">
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"><?= $user->description ?></textarea>
                            </div>

                            <p class="text-success"><?= $this->session->flashdata('success_description') ?></p>
                            <div class="text-right">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>