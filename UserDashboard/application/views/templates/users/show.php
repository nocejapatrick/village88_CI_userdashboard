<div class="container mt-4">
    <h2><?= $user->first_name.' '.$user->last_name ?></h2>
    <div class="row mt-4">
        <p class="col-2 font-weight-bold">Registered at:</p>
        <p class="col-2 pl-2"><?= date("F jS Y",strtotime($user->created_at)) ?></p>
    </div>
    <div class="row">
        <p class="col-2 font-weight-bold">User ID:</p>
        <p class="col-2 pl-2">#<?= $user->id ?></p>
    </div>
    <div class="row">
        <p class="col-2 font-weight-bold">Email Address:</p>
        <p class="col-2 pl-2"><?= $user->email ?></p>
    </div>
    <div class="row">
        <p class="col-2 font-weight-bold">Description:</p>
        <p class="col-2 pl-2"><?= $user->description ?></p>
    </div>
    <div class="message-container mt-5">
        <h3>Leave a message for <?= $user->first_name ?></h3>
        <form action="/messages/create_message" method="post">
            <?php 
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
            ?>
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <input type="hidden" name="to_id" value="<?= $user->id?>" />
            <div class="form-group">
                <textarea name="message" class="form-control <?= ($this->session->flashdata('message_error')) ? 'error': '' ?>" placeholder="<?= $this->session->flashdata('message_error') ?>" id="" cols="30" rows="4"></textarea>
            </div>
        
            <div class="form-group text-right">
                <input type="submit" value="Post" class="btn btn-primary">
            </div>
        </form>
    </div>

    <?php for($i = count($user->messages)-1; $i >= 0; $i--){?>
        <div class="messages-container mt-3">
            <div class="messages mt-5">
                <div class="row">
                    <div class="col-6">
                        <p><a href="/"><?= $user->messages[$i]->from->first_name .' '.$user->messages[$i]->from->last_name ?></a> wrote</p>
                    </div>
                    <div class="col-6 text-right">
                        <p><em>7 hours ago</em></p>
                    </div>
                    <div class="col-12">
                        <form action="/">
                            <textarea disabled="disabled" class="form-control" cols="30" rows="4"><?= $user->messages[$i]->message ?></textarea>
                        </form>
                    </div>


                    <div class="col-12 mt-4 comments-container pl-5">
                        <div class="pl-5">
                        <?php 
                        // var_dump($user->messages[$i]->comments);
                        // die;
                        for($j = count($user->messages[$i]->comments)-1; $j >= 0; $j--){?>
                            <div class="comment mt-3">
                                <div class="row">
                                    <div class="col-6">
                                        <p><a href="/"><?= $user->messages[$i]->comments[$j]->from->first_name ?></a> wrote</p>
                                    </div>
                                    <div class="col-6 text-right">
                                        <p><em>7 hours ago</em></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <form action="/">
                                        <textarea disabled="disabled" class="form-control" cols="30" rows="4"><?= $user->messages[$i]->comments[$j]->comment?></textarea>
                                    </form>
                                </div>
                            </div>
                          <?php } ?>
                            <div class="col-12">
                            <?php 
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                            ?>
                            
                                <form action="/messages/comment_add" class="mt-3" method="post">
                                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                <input type="hidden" name="message_id"  value="<?= $user->messages[$i]->id ?>">
                                    <div class="form-group">
                                    <textarea class="form-control <?= ($this->session->flashdata('comment_error_'.$user->messages[$i]->id)) ? 'error': '' ?>" placeholder="<?= ($this->session->flashdata('comment_error_'.$user->messages[$i]->id)) ?$this->session->flashdata('comment_error_'.$user->messages[$i]->id) : "Write a message"  ?>" name="comment" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="form-group text-right">
                                    <input type="submit" value="Post" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    <?php } ?>
</div>