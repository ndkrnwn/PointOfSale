<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt mr-3"></i><b>Stock Product </b><small><i class="fa  fa-angle-double-right"></i> Add <?= $title ?> </small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Stock Product</a></li>
                        <li class="breadcrumb-item active">Add <?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="
                     font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
                     font-size:18px;
                     color:gray;
                     ">Form Add <?= $title ?></h3>
                    </div>
                    <!-- form start -->
                    <form action="<?= site_url('admin/product/stock_process') ?>" method="POST" class="form-horizontal">
                        <div class="card-body">

                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Date</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="product_id" name="product_id">
                                        <input type="hidden" name="type" value="<?= $type ?>">
                                        <input type="date" class="form-control form-control-sm rounded-1" name="date" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Product Name</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="input-group col-sm-8">
                                        <input type="text" class="form-control form-control-sm bg-white" id="name" readonly>
                                        <div class="input-group-prepend">
                                            <button type="button" class="form-control form-control-sm bg-white" data-toggle="modal" data-target="#product-modal">
                                                <i class="fas fa-search"></i></i>
                                            </button>
                                        </div>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Detail</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" name="detail" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Initial Stock</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" min="0" class="form-control form-control-sm bg-white" id="stock" name="stock" readonly>
                                    </div>
                                    <label class="col-sm-2 col-form-label text-sm">Qty</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" min="0" class="form-control form-control-sm" name="qty" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <br />
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" name="add" class="btn btn-primary btn-sm col-sm-3">Submit</button>
                                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm col-sm-3 float-right">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="product-modal">
        <div class="modal-dialog modal-lg ">
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
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($row->result() as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?> </td>
                                    <td><?= $data->name ?> </td>
                                    <td><?= $data->stock ?> </td>
                                    <td>
                                        <small class="btn badge badge-secondary" id="select-product-modal" data-id="<?= $data->product_id ?>" data-name="<?= $data->name ?>" data-stock="<?= $data->stock ?>">SELECT</small>
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