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
                    <tr>
                        <td>Black Belt for Staff</td>
                        <td>$19.99</td>
                        <td>
                            <input type="num" value="1" class="form-control">
                        </td>
                        <td>$100.00</td>
                        <td><i class="fa fa-times text-danger delete-product"></i></td>
                    </tr>
                    <tr>
                        <td>Black Belt for Staff</td>
                        <td>$19.99</td>
                        <td>
                            <input type="num" value="1" class="form-control">
                        </td>
                        <td>$100.00</td>
                        <td><i class="fa fa-times text-danger delete-product"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <form action="/products/pay" method="POST">
        <div class="row">
            <div class="col-5">
                <h2>Shipping Information</h2>
                    <div class="form-group row">
                        <label class="col-4" for="First Name">First Name</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Last Name">Last Name</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address">Address</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">Address 2</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">City</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">State</label>
                        <input type="text" class="form-control col-8">
                    </div>
                    <div class="form-group row">
                        <label class="col-4" for="Address2">Zipcode</label>
                        <input type="text" class="form-control col-8">
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <h2>Billing Information</h2>
                <div class="form-group form-inline">
                    <input type="checkbox" class="form-control">
                    <label for="" class="ml-2">Same as Shipping Address</label>
                </div>
                <div class="form-group row">
                    <label class="col-4" for="First Name">First Name</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Last Name">Last Name</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Address">Address</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Address2">Address 2</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Address2">City</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Address2">State</label>
                    <input type="text" class="form-control col-8">
                </div>
                <div class="form-group row">
                    <label class="col-4" for="Address2">Zipcode</label>
                    <input type="text" class="form-control col-8">
                </div>
            </div>
        </div>
        <input type="submit" value="Pay" class="btn btn-primary">
    </form>
</div>