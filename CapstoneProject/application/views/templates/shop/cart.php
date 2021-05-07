<div class="container cart pt-4">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th width="30">Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $cart_products = ($this->session->userdata('cart')) ? $this->session->userdata('cart') : [];
                $totalCost = 0;
                foreach($cart_products as $product){?>
                    <tr>
                        <td><?= $product["name"]?></td>
                        <td>$<?= $product["price"]?></td>
                        <td>
                            <input data-productprice="<?= $product["price"] ?>" data-productid="<?= $product["product_id"] ?>" type="number" value="<?= $product["quantity"]?>" class="form-control cart-item-quantity">
                        </td>
                        <td class="cart-item-total">$<?= $product["price"] * $product["quantity"] ?></td>
                        <?php 
                            $totalCost += $product["price"] * $product["quantity"];
                        ?>
                        <td><i class="fa fa-times text-danger delete-product" data-productid="<?= $product["product_id"] ?>"></i></td>
                    </tr>
                <?php }?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right font-weight-bold">TOTAL</td>
                        <td id="total-price">$<?= $totalCost ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <form action="/products/pay" method="POST">
    <?php
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $user = $this->session->userdata('user');
    ?>
    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
        <div class="row">
            <div class="col-5">
                <h2>Shipping Information</h2>
                    <div class="form-group row">
                        <label class="col-4" for="First Name">First Name</label>
                          <input type="text" name="shipping_first_name" value="<?= ($user != null) ? $user->first_name: "" ?>" class="form-control col-8">
                       
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Last Name">Last Name</label>
                          <input type="text" name="shipping_last_name" value="<?= ($user != null) ? $user->last_name: "" ?>" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address">Address</label>
                        <input type="text" name="shipping_address" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">Address 2</label>
                        <input type="text" name="shipping_address_2" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="City">City</label>
                        <input type="text" name="shipping_city" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="State">State</label>
                        <input type="text" name="shipping_state" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Zipcode">Zipcode</label>
                        <input type="text" name="shipping_zipcode" class="form-control col-8">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <h2>Billing Information</h2>
        
                <div class="form-group form-inline">
                    <input type="checkbox" id="same_as_shipping" class="form-control" name="same_as_shipping">
                    <label for="" class="ml-2">Same as Shipping Address</label>
                </div>
                <div id="billing_info">
            
                    <div class="form-group row">
                        <label class="col-4" for="First Name">First Name</label>
                          <input type="text" name="billing_first_name" value="<?= ($user != null) ? $user->first_name: "" ?>" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Last Name">Last Name</label>
                          <input type="text" name="billing_last_name"  value="<?= ($user != null) ? $user->last_name: "" ?>" class="form-control col-8">
                     
                    </div>
                <?php ?>
                    <div class="form-group row">
                        <label class="col-4" for="Address">Address</label>
                        <input type="text" name="billing_address"  class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">Address 2</label>
                        <input type="text" name="billing_address_2"  class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="City">City</label>
                        <input type="text" name="billing_city" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="State">State</label>
                        <input type="text" name="billing_state" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Zipcode">Zipcode</label>
                        <input type="text" name="billing_zipcode" class="form-control col-8">
                    </div>
                </div>
               
            </div>
        </div>
        <input type="submit" value="Pay" class="btn btn-primary">
    </form>
</div>


<div class="bg-danger delete-product-cart text-white">
        Product Deleted from Cart Successfully
    </div>
