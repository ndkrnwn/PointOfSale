<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-users mr-3"></i><b>Customer </b><small><i class="fa  fa-angle-double-right"></i> Add Customer</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Customer</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
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
                     ">Form Add Customer</h3>
                    </div>
                    <!-- form start -->
                    <form action="" method="POST" class="form-horizontal">
                        <div class="card-body">

                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Name</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm rounded-1" name="name" value="<?= set_value('name') ?>" required>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Gender</label>
                                    <div class="col-form-label text-sm">:
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control form-control-sm rounded-0" name="gender" type="text" required>
                                            <?= $gender = set_value('gender'); ?>
                                            <option value="" selected="selected" disabled>-- Select Gender --</option>
                                            <option value="L" <?= set_select('gender', 'L', $gender == 'L'); ?>>1 - Laki - Laki</option>
                                            <option value="P" <?= set_select('gender', 'P', $gender == 'P'); ?>>2 - Perempuan</option>
                                        </select>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Phone</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm rounded-1" name="phone" value="<?= set_value('phone') ?>">
                                        <small class="form-text text-danger"><?= form_error('phone') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Email</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control form-control-sm rounded-1" name="email" value="<?= set_value('email') ?>" required>
                                        <small class="form-text text-danger"><?= form_error('email') ?></small>
                                    </div>
                                    <font style="font-size: 20px" color="red"><i>*</i></font>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label text-sm">Address</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-8">
                                        <textarea class="form-control form-control-sm rounded-1" name="address"><?= set_value('address') ?></textarea>
                                    </div>
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
                                            foreach ($category as $data) {
                                                $selected = set_select('category', $data->code, ($category_selected == $data->code));
                                            ?>
                                                <option value="<?= $data->code ?>" <?= $selected ?>>
                                                    <?= $num . ' - ' . $data->explanation ?>
                                                </option>
                                            <?php
                                                $num++;
                                            }
                                            ?>
                                        </select>
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