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
            <p class="my-2">Price: <span class="product-price">$98.00</span></p>
            <p>Stock: 9</p>
            <form action="/product/buy" class="form-inline" method="post">
                <input type="number" name="quantity" min="1" max="9" value="1" class="form-control mr-2">
                <input type="submit" value="buy" class="btn btn-primary">
            </form>
        </div>
        <div class="col-8">
            <?= $product->description ?>
        </div>
    </div>
    <h2 class="mt-5">Similar Items</h2>
    <div class="row products flex-wrap">
        <div class="col-2 product">
            <a href="#">
                <img src="/assets/images/milo.jpg" class="img-fluid" alt="">
            </a>
            <h5 class="product-title mt-2">Milo</h5>
            <p class="product-price">$91.90</p>
        </div>
    </div>
</div>