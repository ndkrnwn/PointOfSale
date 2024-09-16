<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-shopping-cart mr-3"></i><b>Sales </b><small><i class="fa  fa-angle-double-right"></i> List Transaction</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sales</a></li>
                        <li class="breadcrumb-item active">List Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <?php $this->load->view('message') ?>

            <div class="col-lg-12">
                <div class="card card">
                    <div class="card-body">
                        <table id="db_report_sales" class="table table-bordered table-hover table-sm small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Cust. Name</th>
                                    <th>Sub Total</th>
                                    <th>Discount Total</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td><?= $data->invoice ?> </td>
                                        <td><?= indo_date($data->sale_date) ?> </td>
                                        <td><?= $data->customer_name ?> </td>
                                        <td><?= indo_currency($data->sub_total) ?> </td>
                                        <td><?= indo_currency($data->disc_total) ?> </td>
                                        <td><?= indo_currency($data->total_price) ?> </td>
                                        <td><?= $data->payment ?> </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button id="detail-sales" data-target="#modal-transaction" data-id="<?= $data->sale_id ?>" data-invoice="<?= $data->invoice ?>" data-payment="<?= $data->payment ?>" data-customer="<?= $data->customer_name ?>" data-subtotal="<?= indo_currency($data->sub_total) ?>" data-disctotal="<?= indo_currency($data->disc_total) ?>" data-totalprice="<?= indo_currency($data->total_price) ?>" data-cash="<?= $data->cash == 0 ? '-' : $data->cash; ?>" data-change="<?= $data->remaining == 0 ? '-' : $data->remaining; ?>" data-cashier="<?= $data->casiher_name ?>" data-date="<?= indo_date($data->sale_date) ?>" data-time="<?= substr($data->sale_date, 11, 5)  ?>" data-toggle="modal" class="btn btn-outline-warning btn-sm" title="Detail">
                                                        <i class="fas fa-info"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="<?= site_url('admin/sales/print/' . $data->sale_id) ?>" target="_blank" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" title="Print">
                                                        <i class=" fa fa-print"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button id="delete-sales" data-id="<?= $data->sale_id ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-transaction">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Transaction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th style="width: 15%;" class="text-sm"> Invoice</th>
                            <td style="width: 25%;" class="text-sm"><span id="invoice"></span></td>
                            <th class="text-sm">Sale Date</th>
                            <td class="text-sm"><span id="saledate"></span></td>
                        </tr>
                        <tr>
                            <th class="text-sm">Cashier</th>
                            <td class="text-sm"><span id="cashier"></span></td>
                            <th style="width: 20%;" class="text-sm">Customer</th>
                            <td style="width: 25%;" class="text-sm"><span id="customer"></span></td>
                        </tr>
                        <tr>
                            <th class="text-sm">Sub Total</th>
                            <td class="text-sm"><span id="subtotal"></span></td>
                            <th class="text-sm">Discount Total</th>
                            <td class="text-sm"><span id="disctotal"></span></td>
                        </tr>
                        <tr>
                            <th class="text-sm">Total Price</th>
                            <td class="text-sm"><span id="totalprice"></span></td>
                            <th class="text-sm">Payment Method</th>
                            <td class="text-sm"><span id="payment"></span></td>
                        </tr>
                        <tr>
                            <th class="text-sm">Cash</th>
                            <td class="text-sm"><span id="cash"></span></td>
                            <th class="text-sm">Change</th>
                            <td class="text-sm"><span id="change"></span></td>
                        </tr>
                        <tr>
                            <th style="width: 100px;" class="text-sm">Item </th>
                            <td colspan="4" class="text-sm"> <span id="item_data"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->