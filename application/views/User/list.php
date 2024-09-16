<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b> <i class="fas fa-user mr-3"></i>Users </b><small><i class="fa  fa-angle-double-right"></i> List Users</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">List Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <?php $this->view('message') ?>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= site_url('admin/user/regist') ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Device">
                            <i class="fas fa-plus"></i> <b>Add New</b>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="db_user" class="table table-bordered table-hover table-sm small">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Group</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td><?= $data->name ?> </td>
                                        <td><?= $data->username ?> </td>
                                        <td><?= $data->group_name ?> </td>
                                        <td width="80px">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="<?= site_url('admin/user/edit/' . $data->user_id) ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button id="delete-user" data-id="<?= $data->user_id ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
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