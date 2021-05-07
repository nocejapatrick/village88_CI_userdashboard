<div class="container pt-4">
    <div class="row justify-content-between">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-3">
            <label for="">Filter By: </label>
            <select name="" class="form-control" id="">
                <option value="Order in Process">Order in Process</option>
                <option value="Shipped">Shipped</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <th>Order Id</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Shipping Address</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($orders as $order){

                        $info = json_decode($order->addresses_information);
                        $class=array(
                            "Order in Process"=>"order-in-process",
                            "Shipped" => "shipped",
                            "Cancelled"=> "cancelled"
                        );
                    ?>
                    <tr class="<?= $class[$order->status] ?>">
                        <td><a href="/dashboard/orders_details/<?= $order->id ?>"><?= $order->id ?></a></td>
                        <td><?= $info->shipping_information->first_name .' '. $info->shipping_information->last_name ?></td>
                        <td><?= date("F j, Y, g:i a",strtotime($order->ordered_at)) ?></td>
                        <td><?= $info->shipping_information->address.' '.$info->shipping_information->city.' '.$info->shipping_information->state ?></td>
                        <td>$<?= $order->total ?></td>
                        <td>
                          <?= $order->status ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <?php 
                for($i= 0; $i < $total_pages; $i++){
            ?>
                 <a href="/dashboard/orders/<?= $i+1 ?>"><?= $i+1 ?></a> |
            <?php }?>
        </div>
    </div>
</div>

    <div class="bg-success success-add-cart text-white">
        Successfully Updated the Order
    </div>
