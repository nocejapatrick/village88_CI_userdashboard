<div class="container product-detail">
    <a href="/" class="mt-4" style="display:block;">Go back</a>
    <h2><?= $product->name ?></h2>
    <div class="row">
        <div class="col-4">
        <?php 
            $main_img = json_decode($product->images)->main;
            $subs_img = json_decode($product->images)->subs;
        ?>
            <img src="/assets/images/products/<?= $product->id ?>/<?= $main_img ?>" class="img-fluid main-img" alt="">
            <div class="img-gallery mt-2">
                <?php foreach($subs_img as $sub){?>
                    <img src="/assets/images/products/<?= $product->id ?>/<?= $sub ?>" alt="">
                <?php }?>
            </div>
            <p class="my-2">Price: <span class="product-price">$<?= $product->price ?></span></p>
            <p>Stock: <?= $product->stocks ?></p>
            <form action="/product/buy" id="buy-product" class="form-inline" method="post">
                <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>">
                <input type="number" id="quantity" name="quantity" min="1" max="<?= $product->stocks ?>" value="1" class="form-control mr-2">
                <input type="submit" value="buy" class="btn btn-primary">
            </form>
        </div>
        <div class="col-8">
            <?= $product->description ?>
        </div>
    </div>
    <h2 class="mt-5">Similar Items</h2>
    <div class="row products flex-wrap">
        <?php 

        foreach($similar as $item){
          
            ?>
        <div class="col-2 product">
            <a href="/products/show/<?= $item->id ?>">
            <?php 
                $main_img = json_decode($item->images)->main;
            ?>
                <img src="/assets/images/products/<?= $item->id ?>/<?= $main_img ?>" class="img-fluid" alt="">
            </a>
            <h5 class="product-title mt-2"><?= $item->name?></h5>
            <p class="product-price">$<?= $item->price?></p>
        </div>
        <?php } ?>
    </div>
    <?php if($this->session->userdata('user')){ ?>
    <div class="row">
        <div class="col-12">
            <?php
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
        );
            
            ?>
            <h2>Product Review</h2>
            <form action="/products/add_review" method="POST">
              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
              <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <div class="form-group">
                    <textarea name="review" id="" class="form-control" cols="30" rows="4" placeholder="Type your review"></textarea>
                </div>
                <div class="text-right mb-2">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-12">
            <h5>Reviews</h5>
            <hr>
            <div class="reviews-container">
                <?php foreach($product_reviews as $pr){
                    ?>
                <div class="review p-4 ml-5 border mt-4">
                    <div class="row">
                        <div style="width:20px; margin-left:15px;">
                                <i class="fa fa-user-circle-o" style="font-size: 1.5em;" aria-hidden="true"></i>
                        </div>
                    
                    
                        <div class="col-8">
                            <h6 class="m-0"><?= $pr->name ?></h6>
                            <p class="text-secondary"><small><?= date("F j, Y, g:i a",strtotime($pr->created_at)) ?></small></p>
                        </div>
                    </div>
                    <p><?= $pr->review ?></p>
                </div>
                <?php }?>
                
            </div>
        </div>
    </div>
</div>


    <div class="bg-success success-add-cart text-white">
        Product Added to Cart Successfully
    </div>

