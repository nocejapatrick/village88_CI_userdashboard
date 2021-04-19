<div class="container mt-4">
    <div class="row">
        <h3 class="col-6">
            <?php 
            $myuser = $this->session->userdata('user');

            
                if($myuser->user_level == 9){
                    echo "Manage User";
                }else{
                    echo "All Users";
                }
            
            ?>    

        </h3>
        <?php   if($myuser->user_level == 9){?>
            <div class="col-6 text-right">
                <a href="/users/new" class="btn btn-primary">Add New</a>
            </div>
        <?php } ?>
    </div>

    <div class="row">
        <table class="col-md-12 table table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created_at</th>
                    <th>User_Level</th>
                    <?php if($myuser->user_level == 9){?>
                    <th>Action</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($users as $user){?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><a href="/users/show/<?= $user->id ?>"><?= $user->first_name .' '. $user->last_name ?></a></td>
                        <td><?= $user->email ?></td>
                        <td><?= date("M jS Y",strtotime($user->created_at)) ?></td>
                    
                           <td><?= ($user->user_level == 9) ? 'admin' : 'normal' ?></td>
                   
                        <?php   if($myuser->user_level == 9){?>
                            <td>
                                <a href="/users/edit/<?= $user->id ?>">edit</a>
                                <a href="#" class="remove-user" data-toggle="modal" data-target="#exampleModal" data-userid="<?= $user->id ?>">remove</a>
                            </td>
                        <?php }?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
 
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?php 
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
        ?>
        <form action="/users/delete" method="post">
            <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
            <input type="hidden" name="user_id" id="user_id" value="">
            <input type="submit" class="btn btn-danger" value="Yes">
        </form>
      
      </div>
    </div>
  </div>
</div>

