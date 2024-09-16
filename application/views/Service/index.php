<div class="content-wrapper  bg-white fontpoppins">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-spa mr-3"></i><b>Treatment </b><small><i class="fa  fa-angle-double-right"></i> List Treatment</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Treatment</a></li>
                        <li class="breadcrumb-item active">List Treatment</li>
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
                        <a href="<?= site_url('admin/service/add/') ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Treatment">
                            <i class="fas fa-plus"></i> <b>Add New</b>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="db_service" class="table table-bordered table-hover table-sm small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Modal</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td><?= $data->name ?> </td>
                                        <td><?= $data->categoryname ?> </td>
                                        <td><?= indo_currency($data->modal) ?> </td>
                                        <td><?= indo_currency($data->price) ?> </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="<?= site_url('admin/service/edit/' . $data->service_id) ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button id="delete-service" data-id="<?= $data->service_id ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
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