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
                                <a href="#" id="remove-user" data-userid="<?= $user->id ?>">remove</a>
                            </td>
                        <?php }?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
 
</div>