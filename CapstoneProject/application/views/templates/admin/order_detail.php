<div class="container pt-4">
    <div class="row">
        <div class="col-4 border p-4">
            <p>Order Id: <?= $order->id ?></p>
            <p class="mt-4">Customer shipping info: </p>
            <?php
            $shipping_info = json_decode($order->addresses_information);


            ?>
            <p>Name: <?= $shipping_info->shipping_information->first_name . ' ' .  $shipping_info->shipping_information->last_name ?></p>
            <p>Address: <?= $shipping_info->shipping_information->address ?></p>
            <p>City: <?= $shipping_info->shipping_information->city ?></p>
            <p>State: <?= $shipping_info->shipping_information->state ?></p>
            <p>Zipcode: <?= $shipping_info->shipping_information->zipcode ?></p>

            <?php if (isset($shipping_info->billing_information)) { ?>
                <p class="mt-4">Customer billing info: </p>
                <p>Name: <?= $shipping_info->billing_information->first_name . ' ' . $shipping_info->billing_information->last_name ?></p>
                <p>Address: <?= $shipping_info->billing_information->address ?></p>
                <p>City: <?= $shipping_info->billing_information->city ?></p>
                <p>State: <?= $shipping_info->billing_information->state ?></p>
                <p class="m-0">Zipcode: <?= $shipping_info->billing_information->zipcode ?></p>
            <?php } ?>
        </div>
        <div class="col-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $sub_total = 0;


                    foreach ($order->products as $product) {

                        $sub_total += $product->price;
                        $total += number_format(($product->price * $product->quantity), 2);
                    ?>
                        <tr>
                            <td><?= $product->id ?></td>
                            <td><?= $product->name ?></td>
                            <td>$<?= $product->price ?></td>
                            <td><?= $product->quantity ?></td>
                            <td>$<?= number_format(($product->price * $product->quantity), 2) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <?php if ($order->status == "Shipped") { ?>
                        <div class="shipped border px-3 py-1">Status Shipped</div>
                    <?php } else if ($order->status == "Order in Process") { ?>
                        <div class="order-in-process border px-3 py-1">Order in Process</div>
                    <?php } else { ?>
                        <div class="cancelled border px-3 py-1">Cancelled</div>
                    <?php } ?>
                </div>
                <div class="col-6 border p-2">
                    <p>Sub total: $<?= $sub_total ?></p>
                    <p class="m-0">Total Price: $<?= $total ?></p>
                </div>
            </div>
        </div>
    </div>
</div>