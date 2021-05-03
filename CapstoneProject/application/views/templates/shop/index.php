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
                        <li><a href="#"><?= $category->cat ?> (<?= $category->count ?>)</a></li>
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
                        <a href="#">first</a> | 
                        <a href="#">prev</a> |
                        <span>2</span> |
                        <a href="#">next</a>
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
                    <a href="#">1</a> |
                    <a href="#">2</a> |
                </div>
            </div>
        </div>
    </div>
</div>