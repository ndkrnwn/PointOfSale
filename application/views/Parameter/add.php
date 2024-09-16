<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b> <i class="fa fa-cog mr-3"></i>Parameter </b><small><i class="fa  fa-angle-double-right"></i> Add Parameter</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Parameter</a></li>
                        <li class="breadcrumb-item active">Add Parameter</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <?php $this->load->view('message') ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="
                     font-family:'Josefin Sans', sans-serif;
                     font-size:18px;
                     color:gray;
                     ">Form Add Parameter</h3>
                        </div>
                        <form action="<?= site_url('admin/parameter/add') ?>" method="POST" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Class</label>
                                    <div class="col-form-label text-sm">:
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm rounded-0" id="class" name="class" type="text" required>
                                            <option value="" selected="selected" disabled>-- Choose Class --</option>
                                            <?php
                                            $num = 1;
                                            foreach ($cl as $data) { ?>
                                                <option value="<?= $data->class ?>"><?= $num . ' - ' . $data->class;  ?></option>
                                            <?php $num++;
                                            } ?>
                                        </select>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Code</label>
                                    <div class="col-form-label text-sm">:
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm rounded-0" name="code" value="<?= set_value('code') ?>" placeholder="Code" required>
                                        <small class="form-text text-danger"><?= form_error('code') ?></small>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Explanation</label>
                                    <div class="col-form-label text-sm">:
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm rounded-0" name="explanation" value="<?= set_value('explanation') ?>" placeholder="Explanation" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-sm col-sm-3">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>