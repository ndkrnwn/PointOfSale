<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fas fa-user mr-3"></i><b>Users </b><small><i class="fa  fa-angle-double-right"></i> Edit User</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                ">Form Edit User</h3>
                    </div>
                    <!-- form start -->
                    <form action="" method="POST" class="form-horizontal">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="<?= $row->user_id ?>">
                                    <label class="col-sm-3 col-form-label text-sm">Full Name</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control form-control-sm rounded-1" name="fullname" value="<?= $row->name ?>">
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class=" form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Username</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control form-control-sm rounded-1" name="username" value="<?= $row->username ?>">
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('username') ?></small>
                                        </span>
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
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
                                        <input type="password" class="form-control form-control-sm rounded-1" name="password" value="<?= $this->input->post('password') ?>" placeholder="********">
                                        <span class="help-block">
                                            <small class="form-text text-muted">Leave blank if you don't want to change your password.</small>
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
                                        <input type="password" class="form-control form-control-sm rounded-1" name="pass-conf" value="<?= $this->input->post('pass-conf') ?>" placeholder="********">
                                        <span class="help-block">
                                            <small class="form-text text-muted">Leave blank if you don't want to change your password.</small>
                                            <small class="form-text text-danger"><?= form_error('pass-conf') ?></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">User Group</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <select required class="form-control form-control-sm rounded-1" id="group" name="group" type="text">
                                            <option disabled value="" selected>-- Select Group --</option>
                                            <?php
                                            $num = 1;
                                            foreach ($gr as $data) { ?>
                                                <option value="<?= $data->code ?>" <?= $data->code == $row->level ? "selected" : null ?>><?= $num . ' - ' . $data->explanation  ?></option>
                                            <?php $num++;
                                            } ?>
                                        </select>
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
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
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </div>
    </div>