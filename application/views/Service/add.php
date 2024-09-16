<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-spa mr-3"></i><b>Treatment </b><small><i class="fa  fa-angle-double-right"></i> Add Treatment</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Treatment</a></li>
                        <li class="breadcrumb-item active">Add Treatment</li>
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
                     ">Form Add Treatment</h3>
                    </div>
                    <!-- form start -->
                    <form action="<?= site_url('admin/service/process') ?>" method="POST" class="form-horizontal">
                        <div class="card-body">

                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Name</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm rounded-1" name="name" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Category</label>
                                    <div class="col-form-label text-sm">:
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm rounded-0" name="category" type="text" required>
                                            <option value="" selected="selected" disabled>-- Select Category --</option>
                                            <?php
                                            $num = 1;
                                            foreach ($category as $data) { ?>
                                                <option value="<?= $data->code ?>"><?= $num . ' - ' . $data->explanation;  ?></option>
                                            <?php $num++;
                                            } ?>
                                        </select>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Modal</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="input-group col-sm-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control-sm rounded-0"><b>Rp. </b></span>
                                        </div>
                                        <input type="number" min="0" class="form-control form-control-sm rounded-0" name="modal" required>
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
                                        <input type="number" min="0" class="form-control form-control-sm rounded-0" name="price" required>
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