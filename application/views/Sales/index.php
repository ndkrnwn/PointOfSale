<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
    </div>

    <div class="content fontpoppins-input">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-widget">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="datetime" id="date" value="<?= $date ?>" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">DATE / TIME</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" id="customer_id" readonly>
                                    <input type="hidden" class="form-control form-control-sm" id="customer_point" readonly>
                                    <input type="text" class="form-control form-control-sm input-area bg-white" data-toggle="modal" data-target="#customer-modal-sales" id="customer_name" readonly>
                                    <label class="label">CUSTOMER</label>
                                    <div class="input-group-append">
                                        <button type="button" class="form-control form-control-sm bg-white" data-toggle="modal" data-target="#customer-modal-sales">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-widget">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm input-area bg-white" data-toggle="modal" data-target="#service-modal-cart" readonly>
                                    <label class="label">TREATMENT</label>
                                    <div class="input-group-prepend">
                                        <button type="button" class="form-control form-control-sm  bg-white" data-toggle="modal" data-target="#service-modal-cart">
                                            <i class="fas fa-search"></i></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm input-area  bg-white" data-toggle="modal" data-target="#product-modal-cart" readonly>
                                    <label class="label">PRODUCT</label>
                                    <div class="input-group-prepend">
                                        <button type="button" class="form-control form-control-sm  bg-white" data-toggle="modal" data-target="#product-modal-cart">
                                            <i class="fas fa-search"></i></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-widget">
                        <div class="card-body">
                            <div class="float-right ">
                                <h4>Invoice <b><span id="invoice"> <?= $invoice ?></span></b></h4>
                                <h1><b><span class="float-right" id="invoice_price" style="font-size:40pt">0</span></b></h1>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-widget">
                        <div class="card-header">
                            <button type="button" class="btn btn-sm btn-tool float-right" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-sm table-hover   text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Item Point</th>
                                        <th>Total Point</th>
                                        <th>Discount/ Item</th>
                                        <th>Sub. Total</th>
                                        <th>Disc. Total</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="cart_table_item">
                                    <?php $this->load->view('sales/cart_data'); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-widget">
                        <!-- <div class="card-header">
                            <button type="button" class="btn btn-sm btn-tool float-right" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div> -->
                        <div class="card-body ">
                            <div class="form-group">
                                <div class=" input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control form-control-sm bg-white "><b>Rp </b></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm input-area bg-white" id="sub_total" disabled>
                                    <label class="label">SUB TOTAL</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control form-control-sm bg-white "><b>Rp </b></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm input-area bg-white" id="disc_total" disabled>
                                    <label class="label">DISCOUNT TOTAL</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control form-control-sm bg-white"><b>Rp </b></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm input-area bg-white" id="total_price" disabled>
                                    <label class="label">PRICE TOTAL</label>
                                </div>
                            </div>
                            <div class="form-group" style="align-items: center;display:none;">
                                <div class=" input-group">
                                    <input type="number" class="form-control form-control-sm input-area bg-white " name="point" id="point" readonly>
                                    <label class="label">POINT</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-widget">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control form-control-sm input-area" id="method_payment" onchange="toggleFieldRow()" required>
                                        <option value="" selected>Select Payment Method</option>
                                        <optgroup label="-------- CASH --------">
                                            <option value="CASH">1 - Cash</option>
                                        </optgroup>
                                        <optgroup label="-------- EDC --------">
                                            <option value="BCA">1 - BANK BCA</option>
                                            <option value="BRI">2 - BANK BRI</option>
                                            <option value="BNI">3 - BANK BNI</option>
                                            <option value="MANDIRI">4 - BANK MANDIRI</option>
                                        </optgroup>
                                        <optgroup label="-------- E - Wallet --------">
                                            <option value="OVO">1 - OVO</option>
                                            <option value="GOPAY">2 - GOPAY</option>
                                            <option value="QRIS">3 - QRIS</option>
                                        </optgroup>
                                        <optgroup label="-------- POINT --------">
                                            <option value="POINT">1 - POINT</option>
                                        </optgroup>
                                    </select>
                                    <label class="label">PAYMENT METHOD</label>
                                </div>
                            </div>
                            <div class="row" style="display:none;" id="pointPaymentFieldRow">
                                <div class="form-group col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm input-area bg-white" id="pointrequired" disabled>
                                        <label class="label">Point Required</label>
                                    </div>
                                </div>
                                <div class="form-group  col-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm input-area bg-white" id="pointcustomer" disabled>
                                        <label class="label">Point Customer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="display:none;" id="cashFieldRow">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control form-control-sm bg-white"><b>Rp </b></span>
                                    </div>
                                    <input type="number" min="0" class="form-control form-control-sm input-area bg-white" id="cash">
                                    <label class="label text-primary">CASH *</label>
                                </div>
                            </div>
                            <div class="form-group" style="display:none;" id="changeFieldRow">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control form-control-sm bg-white "><b>Rp </b></span>
                                    </div>
                                    <input type="number" class="form-control form-control-sm input-area  bg-white " id="change" disabled>
                                    <label class="label">CHANGE</label>
                                </div>
                            </div>
                            <div class="form-group row" style="align-items: center;">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6 float-right">
                                        <button id="cancel_payment" class="btn btn-sm btn-outline-danger float-left fontpoppins">
                                            <i class="fas fa-trash-alt"></i> Cancel
                                        </button>
                                        <button id="process_payment" class="btn btn-sm btn-outline-secondary float-right fontpoppins">
                                            <i class="far fa-paper-plane"></i> Process
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SERVICE CART -->
    <div class="modal fade" id="service-modal-cart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Add Treatment Cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" id="item_type_service" readonly>
                                <input type="hidden" id="item_id_service" readonly>
                                <input type="hidden" id="item_price_service" readonly>
                                <input type="hidden" id="qty_service_cart" readonly>
                                <input type="text" class="form-control form-control-sm input-area bg-white" id="name_service" data-toggle="modal" data-target="#service-modal-sales" readonly>
                                <label class="label ">Treatment</label>
                                <div class="input-group-prepend">
                                    <button type="button" id="select-service-sales" class="form-control form-control-sm" data-toggle="modal" data-target="#service-modal-sales">
                                        <i class="fas fa-search"></i></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" value="1" class="form-control form-control-sm input-area  bg-white" id="qty_service" required>
                                <label class="label ">QTY</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="0" max="100" value="0" class="form-control form-control-sm input-area bg-white" id="discount_service">
                                <label class="label">DISCOUNT %</label>
                            </div>
                        </div>
                        <div class=" float-right">
                            <button type="button" id="add_cart_service" class="btn btn-sm btn-outline-primary btn-rounded waves-effect fontpoppins">
                                <i class="fa fa-cart-plus"></i> Add Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL SELECT SERVICE -->
    <div class="modal fade" id="service-modal-sales">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Select Treatment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tb_service_modal" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($service->result() as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?> </td>
                                    <td><?= $data->name ?> </td>
                                    <td><?= $data->categoryname ?> </td>
                                    <td>
                                        <small class="btn badge badge-secondary" id="select-service-modal-sales" data-id="<?= $data->service_id ?>" data-name="<?= $data->name ?>" data-price="<?= $data->price ?>">SELECT</small>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL PRODUCT CART -->
    <div class="modal fade" id="product-modal-cart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fontpoppins-header">Add Product Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" id="item_type_product" readonly>
                                <input type="hidden" id="item_id_product" readonly>
                                <input type="hidden" id="item_price_product" readonly>
                                <input type="hidden" id="item_point_product" readonly>
                                <input type="hidden" id="qty_product_cart" readonly>
                                <input type="hidden" id="stock_product" readonly>
                                <input type="text" class="form-control form-control-sm input-area bg-white" id="name_product" data-toggle="modal" data-target="#product-modal-sales" readonly>
                                <label class="label ">PRODUCT</label>
                                <div class="input-group-prepend">
                                    <button type="button" id="select-product-sales" class="form-control form-control-sm  bg-white" data-toggle="modal" data-target="#product-modal-sales">
                                        <i class="fas fa-search"></i></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" value="1" class="form-control form-control-sm input-area" id="qty_product" required>
                                <label class="label ">QTY</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="0" max="100" value="0" class="form-control form-control-sm input-area" id="discount_product">
                                <label class="label ">DISCOUNT %</label>
                            </div>
                        </div>
                        <div class=" float-right">
                            <button type="button" id="add_cart_product" class="btn btn-sm btn-outline-primary btn-rounded waves-effect fontpoppins">
                                <i class="fa fa-cart-plus"></i> Add Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL SELECT PRODUCT -->
    <div class="modal fade" id="product-modal-sales">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Select Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="tb_product_modal" class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Point Required</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($product->result() as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?> </td>
                                    <td><?= $data->name ?> </td>
                                    <td><?= $data->point ?> </td>
                                    <td><?= $data->stock ?> </td>
                                    <td>
                                        <small class="btn badge badge-secondary" id="select-product-modal-sales" data-id="<?= $data->product_id ?>" data-name="<?= $data->name ?>" data-stock="<?= $data->stock ?>" data-price="<?= $data->price ?>" data-point="<?= $data->point ?>">SELECT</small>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL SELECT CUSTOMER -->
    <div class="modal fade" id="customer-modal-sales">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Select Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="db_customer" class="table table-bordered table-hover table-sm small">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($customer->result() as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?> </td>
                                    <td><?= $data->name ?> </td>
                                    <td><?= $data->gender == 'L' ? 'Laki Laki' : 'Perempuan' ?> </td>
                                    <td><?= $data->categoryname ?> </td>
                                    <td><?= $data->phone == null ? '-' : $data->phone; ?> </td>
                                    <td><?= $data->email ?> </td>
                                    <td>
                                        <small class="btn badge badge-secondary" id="select-customer-modal-sales" data-id="<?= $data->customer_id ?>" data-name="<?= $data->name ?>" data-point-cust="<?= $data->point ?>">SELECT</small>
                                    </td>
                                </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- MODAL EDIT CART PRODUCT -->
    <div class="modal fade" id="product-edit-modal-cart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Update Cart Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="product_cart_id">
                    <!-- <input type="hidden" id="product_item_id"> -->
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="product_edit_name" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Product Item</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" id="product_edit_price" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Price</label>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_qty" min="1" class="form-control form-control-sm input-area bg-white">
                                    <label class="label text-primary" label class="label">Qty</label>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_stock" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">Stock</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class=" form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_item_point" min="1" class="form-control form-control-sm input-area bg-white">
                                    <label class="label text-primary" label class="label">Item Point</label>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_total_point" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">Total Point</label>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" id="product_edit_sub_total" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Sub Total</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_discount_item" min="1" class="form-control  form-control-sm input-area bg-white">
                                    <label class="label  text-primary">Discount / Item ( % )</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="product_edit_disc_total" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">Discount Total</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" id="product_edit_total_price" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Price Total</label>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" id="edit_cart_product" class="btn btn-sm btn-outline-primary btn-rounded waves-effect fontpoppins">
                            <i class="fa fa-pen"></i> Update
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    <!-- MODAL EDIT CART SERVICE -->
    <div class="modal fade" id="service-edit-modal-cart">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fontpoppins-header">Update Cart Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="service_cart_id">
                    <!-- <input type="hidden" id="service_item_id"> -->
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" id="service_edit_name" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Treatment Name</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="service_edit_price" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">Price</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="service_edit_qty" min="1" class="form-control form-control-sm input-area bg-white">
                                    <label class="label text-primary">Qty</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" id="service_edit_sub_total" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Sub Total</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="service_edit_discount_item" min="1" class="form-control form-control-sm input-area bg-white">
                                    <label class="label text-primary">Discount / Item ( % )</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" id="service_edit_disc_total" class="form-control form-control-sm input-area bg-white" readonly>
                                    <label class="label">Discount Total</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" id="service_edit_total_price" class="form-control form-control-sm input-area bg-white" readonly>
                                <label class="label">Price Total</label>
                            </div>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" id="edit_cart_service" class="btn btn-sm btn-outline-primary btn-rounded waves-effect fontpoppins">
                            <i class="fa fa-pen"></i> Update
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- /.modal -->