<div class="content-wrapper  bg-white fontpoppins">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt mr-3"></i><b>Stock Product </b><small><i class="fa  fa-angle-double-right"></i> List <?= $title; ?></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Stock Product</a></li>
                        <li class="breadcrumb-item active">List <?= $title; ?></li>
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
                    <div class="card-header">
                        <a href="<?= site_url('admin/product/stock_add/' . $type) ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Device">
                            <i class="fas fa-plus"></i> <b>Add New</b>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="db_stock" class="table table-bordered table-hover table-sm small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Detail</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td><?= $data->product_name ?> </td>
                                        <td><?= $data->detail ?> </td>
                                        <td><?= $data->qty ?> </td>
                                        <td><?= indo_date($data->date) ?> </td>
                                        <td>
                                            <div>
                                                <button id="delete-stock" data-id="<?= $data->stock_id ?>" data-product-id="<?= $data->product_id ?>" data-type="<?= $data->type ?>" data-qty="<?= $data->qty ?>" data-fn="<?= $fn ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
                                                </button>
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