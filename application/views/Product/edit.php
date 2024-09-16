<div class="content-wrapper  bg-white fontpoppins">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fab fa-product-hunt mr-3"></i><b>Product </b><small><i class="fa  fa-angle-double-right"></i> Edit Product</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <div class="col-lg-6">
                <div class="card card-lightblue card-outline ">
                    <div class="card-header">
                        <h3 class="card-title" style="
                     font-family:Helvetica Neue,Helvetica,Arial,sans-serif;
                     font-size:18px;
                     color:gray;
                     ">Form Edit Product</h3>
                    </div>
                    <!-- form start -->
                    <form action="<?= site_url('admin/product/process') ?>" enctype="multipart/form-data" method="POST" class="form-horizontal">
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $row->product_id ?>">
                            <input type="hidden" name="img_old" value="<?= $row->file_name ?>">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Name</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control form-control-sm rounded-1" name="name" value="<?= $row->name ?>">
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Price</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="input-group col-sm-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control-sm rounded-0"><b>Rp. </b></span>
                                        </div>
                                        <input type="number" min="0" class="form-control form-control-sm rounded-0" name="price" value="<?= $row->price ?>" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Photo</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="input-group col-sm-8">
                                        <div class="custom-file">
                                            <input type="file" class="form-control form-control-sm rounded-1 custom-file-input" name="attachment">
                                            <label class="form-control form-control-sm rounded-1 custom-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Description</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <textarea class="form-control form-control-sm rounded-1" name="description"><?= $row->description ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input custom-control-input-danger col-sm-12" type="checkbox" name="is_point_exchange" value="<?= $row->is_point_exchange ?>" id="point_toogle" onchange="togglePointRow()" <?= ($row->is_point_exchange == 1) ? 'checked' : '' ?>>
                                            <label for="point_toogle" class="custom-control-label col-sm-12  text-sm">Point Exchange</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row" style=" display:none;" id="pointFieldRow">
                                    <label class="col-sm-3 col-form-label text-sm">Point</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" min=0 class="form-control  rounded-1" name="product_point" value="<?= $row->point ?>" id="product_point">
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div><br />
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" name="edit" class="btn btn-primary btn-sm col-sm-3">Submit</button>
                                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm col-sm-3 float-right">Cancel</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>