<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt mr-3"></i><b>Product </b><small><i class="fa  fa-angle-double-right"></i> List Product</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">List Product</li>
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
                        <a href="<?= site_url('admin/product/add/') ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Device">
                            <i class="fas fa-plus"></i> <b>Add New</b>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="db_product" class="table table-bordered table-hover table-md small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Point Required</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++ ?> </td>
                                        <td style="vertical-align: middle;"><?= $data->name ?> </td>
                                        <?php if ($data->file_name !== null) : ?>
                                            <td style="vertical-align: middle;"><img style="height: 80px; width: 80px" src="<?= base_url('uploads/product/') . $data->file_name ?>"></td>
                                        <?php else : ?>
                                            <td style="vertical-align: middle;"><img style="height: 80px; width: 80px" src="<?= base_url('uploads/product/sample.jpg') ?>"></td>
                                        <?php endif; ?>
                                        <td style="vertical-align: middle;"><?= $data->description == null ? '-' : $data->description; ?> </td>
                                        <td style="vertical-align: middle;"><?= indo_currency($data->price) ?> </td>
                                        <td style="vertical-align: middle;"><?= $data->point ?> points </td>
                                        <td style="vertical-align: middle;"><?= $data->stock ?> </td>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="<?= site_url('admin/product/edit/' . $data->product_id) ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button id="delete-product" data-id="<?= $data->product_id ?>" data-img="<?= $data->file_name ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
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