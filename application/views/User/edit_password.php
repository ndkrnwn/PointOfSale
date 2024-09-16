<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Profile </b><small><i class="fa  fa-angle-double-right"></i> Users</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container">
            <div class="col-lg-6">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title" style="
                font-family:'Josefin Sans', sans-serif;
                font-size:18px;
                color:gray;
                ">Edit Password</h3>
                    </div>
                    <!-- form start -->
                    <form action="" method="POST" class="form-horizontal">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="<?= $row->user_id ?>">
                                    <label for="password" class="col-sm-3 col-form-label text-sm fontpoppins">Old Password</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm rounded-1" name="old-password" value="<?= $this->input->post('old-password') ?>" required>
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('old-password') ?></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Password</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm rounded-1" name="password" value="<?= $this->input->post('password') ?>" required>
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('password') ?></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Re-Type Password</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control form-control-sm rounded-1" name="pass-conf" value="<?= $this->input->post('pass-conf') ?>" required>
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('pass-conf') ?></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-sm col-sm-3">Submit</button>
                                    <a href="javascript:history.back()" class="btn btn-secondary btn-sm col-sm-3 float-right">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>