<div class="container pt-5">
    <div class="row">
        <div class="col-3">
            <div class="filters-container">
                <form action="/products" class="form-inline" method="post">
                    <div class="form-group mx-sm-1 mb-2">
                        <label for="search" class="sr-only">Search</label>
                        <input type="text" class="form-control" id="search" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i></button>
                </form>
                <h5 class="mt-5">Categories</h5>
                <ul>
                    <?php foreach($categories as $category){?>
                        <li><a href="/products/categories/<?= $category->cat_id ?>/1"><?= $category->cat ?> (<?= $category->count ?>)</a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="products-container">
                <div class="row">
                    <div class="col-6">
                        <h1>Shop</h1>
                    </div>
                    <div class="col-6 text-right">
                    <?php if($current_page != 1){?>
                        <?php if($category_id != 0){ ?>
                        <a href="/products/categories/<?= $category_id ?>/1">first</a> |
                        <?php }else{ ?>
                            <a href="/products/1">first</a> |
                        <?php } ?>
                    <?php } ?>
                    <?php if($current_page != 1){?>
                        <?php if($category_id != 0){ ?>
                        <a href="/products/categories/<?= $category_id ?>/<?= $current_page-1;?>">prev</a> |
                        <?php }else{ ?>
                            <a href="/products/<?= $current_page-1;?>">prev</a> |
                        <?php } ?>
                    <?php }?>

                    <span><?= $current_page ?></span> |
                        
                    <?php if($current_page != $total_pages){ ?>
                        <?php if($category_id != 0){ ?>
                        <a href="/products/categories/<?= $category_id ?>/<?= $current_page+1;?>">next</a> |
                        <?php }else{ ?>
                            <a href="/products/<?= $current_page+1;?>">next</a> |
                        <?php } ?>
                    <?php }?>
                    
                    </div>
                </div>
                <div class="row">
                    <form action="" class="form-inline justify-content-end" style="width:100%;">
                        <label for="" class="mr-2">Sorted By</label>
                        <select name="sorted_by" id="" class="form-control">
                            <option value="price">Price</option>
                            <option value="most_popular">Most Popular</option>
                        </select>
                    </form>
                </div>
                <div class="row products flex-wrap">
                    <?php foreach($products as $product){?>
                        <div class="col-2 my-3 product">
                            <a href="/products/show/<?= $product->id ?>">
                            <?php 
                                $img = json_decode($product->images);
                            ?>
                                <img src="/assets/images/products/<?= $product->id ?>/<?= $img->main ?>" class="img-fluid" alt="">
                            </a>
                            <h5 class="product-title mt-2"><?= $product->name ?></h5>
                            <p class="product-price">$<?= $product->price ?></p>
                        </div> 
                    <?php }?>
                </div>
                <div class="pages text-center">
                <?php for($i = 0; $i < $total_pages; $i++){ ?>
                    <?php if($category_id != 0){?>
                        <a href="/products/categories/<?= $category_id ?>/<?= $i+1 ?>"><?= $i+1 ?></a> |
                    <?php }else{?>
                        <a href="/products/<?= $i+1 ?>"><?= $i+1 ?></a> |
                    <?php }?> 
                   
                <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>