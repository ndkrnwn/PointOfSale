<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <i class="fas fa-user mr-3"></i><b>Users </b><small><i class="fa  fa-angle-double-right"></i> Register User</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                        <li class="breadcrumb-item active">Register User</li>
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
                     font-family:'Josefin Sans', sans-serif;
                     font-size:18px;
                     color:gray;
                     ">Registration Form</h3>
                    </div>
                    <form action="<?= site_url('admin/User/regist') ?>" method="POST" class="form-horizontal">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Full Name</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control form-control-sm rounded-1" name="fullname" value="<?= set_value('fullname') ?>" placeholder="Full Name">
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Username</label>
                                    <div class="col=sm-1 col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" required class="form-control form-control-sm rounded-1" name="username" value="<?= set_value('username') ?>" placeholder="Username">
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
                                        <input type="password" required class="form-control form-control-sm rounded-1" name="password" value="<?= set_value('password') ?>" placeholder="Password">
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('password') ?></small>
                                        </span>
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
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
                                        <input type="password" required class="form-control form-control-sm rounded-1" name="pass-conf" value="<?= set_value('pass-conf') ?>" placeholder="Re-Type Password">
                                        <span class="help-block">
                                            <small class="form-text text-danger"><?= form_error('pass-conf') ?></small>
                                        </span>
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
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
                                            foreach ($gr as $row) { ?>
                                                <option value="<?= $row->code ?>"><?= $num . ' - ' . $row->explanation  ?></option>
                                            <?php $num++;
                                            } ?>
                                        </select>
                                    </div>
                                    <div clas="col-sm-1">
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                    </div>
                                </div>
                            </div>
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