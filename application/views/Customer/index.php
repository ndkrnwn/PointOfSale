<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-users mr-3"></i><b>Customer </b><small><i class="fa  fa-angle-double-right"></i> List customer</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item active">List customer</li>
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
                        <a href="<?= site_url('admin/customer/add/') ?>" class="btn btn-outline-primary" data-toggle="tooltip" title="Add Device">
                            <i class="fas fa-plus"></i> <b>Add New</b>
                        </a>
                    </div>
                    <div class="card-body">
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
                                foreach ($row->result() as $key => $data) { ?>
                                    <tr>
                                        <td><?= $no++ ?> </td>
                                        <td><?= $data->name ?> </td>
                                        <td><?= $data->gender == 'L' ? 'Laki Laki' : 'Perempuan' ?> </td>
                                        <td><?= $data->categoryname ?> </td>
                                        <td><?= $data->phone == null ? '-' : $data->phone; ?> </td>
                                        <td><?= $data->email ?> </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button id="detail-customer" data-target="#modal-default" data-name="<?= $data->name ?>" data-gender="<?= $data->gender == 'L' ? 'Laki Laki' : 'Perempuan' ?>" data-phone="<?= $data->phone == null ? '-' : $data->phone; ?>" data-email="<?= $data->email ?>" data-address="<?= $data->address  == null ? '-' : $data->address; ?>" data-category="<?= $data->categoryname ?>" data-point="<?= $data->point == null ? '-' : $data->point; ?>" data-createdby="<?= $data->createdname ?>" data-createddate="<?= $data->createddate ?>" data-modifyby="<?= $data->modifyname == null ? '-' : $data->modifyname; ?>" data-modifydate="<?= $data->modifydate == null ? '-' : $data->modifydate; ?>" data-toggle="modal" class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-info"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="<?= site_url('admin/customer/edit/' . $data->customer_id) ?>" class="btn btn-outline-info btn-sm" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button id="delete-customer" data-id="<?= $data->customer_id ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th style="font-size: 14px;">Name</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="name"></span></td>

                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Gender</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="gender"></span></td>
                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Phone</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="phone"></span></td>
                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Email</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="email"></span></td>
                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Address</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="address"></span></td>
                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Category</th>
                            <th> :</th>
                            <td colspan="4"><span style="font-size: 14px;" id="category"></span></td>
                        </tr>
                        <tr>
                            <th style="font-size: 14px;">Point</th>
                            <th> :</th>
                            <td colspan="4"><i><span style="font-size: 14px;" id="point"></span></i></td>
                        </tr>
                        <tr>
                            <th style="width: 20%; font-size: 14px;"> Created By </th>
                            <th style="width: 1%;"> :</th>
                            <td style="width: 35%; font-size: 14px;"><span id="createdby"></span></td>
                            <td style="width: 35%; font-size: 14px;"><span id="createddate"></span></td>
                        </tr>
                        <tr>
                            <th style="width: 20%; font-size: 14px;"> Modify By </th>
                            <th style="width: 1%;"> :</th>
                            <td style="width: 35%; font-size: 14px;"><span id="modifyby"></span></td>
                            <td style="width: 35%; font-size: 14px;"><span id="modifydate"></span></td>
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