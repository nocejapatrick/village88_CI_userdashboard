<div class="container pt-4">
    <div class="row justify-content-between">
        <div class="col-6">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-3">
            <button type="button" class="btn btn-block btn-primary" id="add-product" data-toggle="modal" data-target="#exampleModal" >Add new button</button>
        </div>
    </div>
    <div class="row pt-3">
        <table class="table table-bordered">
            <thead>
                <thead>
                    <th width="200">Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Inventory Count</th>
                    <th>Quantity Sold</th>
                    <th>Action</th>
                </thead>
            </thead>
            <tbody>
            <?php foreach($products as $product){?>
              <tr>
                    <td>
                    <?php
                    
                    $image = json_decode($product->images);
                    ?>
                        <img src="/assets/images/products/<?= $product->id?>/<?= $image->main?> " alt="" class="img-fluid">
                    </td>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td>$<?= $product->price ?></td>
                    <td><?= $product->stocks ?></td>
                    <td></td>
                    <td>
                      <a href="#" class="product-edit">Edit</a> |
                      <a href="#" class="product-delete">Delete</a>
                    </td>
                </tr>
            <?php }?>
                <!-- <tr>
                    <td>
                        <img src="/assets/images/milo.jpg" alt="" class="img-fluid">
                    </td>
                    <td>2</td>
                    <td>Milo</td>
                    <td>10</td>
                    <td>100</td>
                    <td>
                      <a href="#" class="product-edit">Edit</a> |
                      <a href="#" class="product-delete">Delete</a>
                    </td>
                </tr> -->
            </tbody>
        </table>
     
    </div>
    <div class="mt-4 text-center">
              <?php for($i = 0; $i < $total_pages; $i++){?>
                <a href="/dashboard/products/<?= $i+1 ?>"><?= $i+1?></a> |
              <?php }?> 
        </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php 
      $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
    );

      ?>
      <form action="/products/create" method="POST" id="add-product-form">
        <input type="hidden" id="csrf" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div class="modal-body">
          <div class="form-group row">
            <label for="" class="col-3 text-right">Name</label>
            <input type="text" name="name" class="col-8 form-control" id="product-name">
          </div>
          <div class="form-group row">
            <label for="" class="col-3 text-right">Price</label>
            <input type="text" name="name" class="col-8 form-control" id="product-price">
          </div>
          <div class="form-group row">
            <label for="" class="col-3 text-right">Inventory Stocks</label>
            <input type="text" name="name" class="col-8 form-control" id="product-stocks">
          </div>
          <div class="form-group row">
            <label for="" class="col-3 text-right">Description</label>
            <textarea name="descripton" class="col-8 form-control" id="product-description" placeholder="Optional"></textarea>
          </div>
          <div class="form-group row">
            <label for="" class="col-3 text-right">Categories</label>
            <div class="col-8 p-0 select-categories">
              <div class="category form-control" data-catid="">Select Category</div>
              <div class="my-categories">
                <ul>
                  
                </ul>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-3 text-right" >or add a new Category</label>
            <input type="text" name="name_category" id="add-category" class="col-8 form-control">
          </div>
          <div class="form-group row images">
            <label for="" class="col-3 text-right">Images</label>
            <input type="file" name="images" id="multiple-upload" multiple>
          </div>
          <div class="form-group row">
             <label for="" class="col-3 text-right">Images List</label>
             <div class="col-8 my-images">
                <!-- <div class="image my-2 d-flex align-items-center">
                  <i class="fa fa-bars mr-2"></i>
                  <div class="product-image">
                    <img src="/assets/images/milo.jpg" style="width:50px; height:50px;" alt="">
                  </div>
                  <span class="mx-2">Milo.jpg</span>
                  <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                  <input type="checkbox" class="img-main ml-3 mr-1">
                  <label for="" class="m-0">Main</label>
                </div> -->
             </div>
          </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>