<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b> <i class="fa fa-cog mr-3"></i>Parameter </b><small><i class="fa  fa-angle-double-right"></i> <?= $title; ?></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Parameter</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <?php $this->load->view('message') ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <a href="<?= site_url('admin/parameter/add') ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Device">
                                <i class="fas fa-plus"></i> <b>Add New</b>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="db_parameter" class="table table-bordered table-hover table-sm small">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Explanation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($row->result() as $key => $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?> </td>
                                            <td><?= $data->code ?> </td>
                                            <td><?= $data->explanation ?> </td>
                                            <td class="text-center" width="150px">
                                                <button id="delete-parameter" data-id="<?= $data->id ?>" data-code="<?= $data->code ?>" data-fn="<?= $fn; ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>