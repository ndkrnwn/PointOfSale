<div class="content-wrapper bg-white">

    <section class="content">
        <div class="container-fluid">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header text-center fontpoppins-header">
                                <h4 class="fontpoppins-title">Edit Password</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="form-horizontal">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $row->customer_id ?>">
                                        <label for="password" class="fontpoppins">Old Password</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="password" class="form-control" name="old-password" value="<?= $this->input->post('old-password') ?>" required>
                                        <small class="form-text text-danger"><?= form_error('old-password') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="fontpoppins">Password</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="password" class="form-control" name="password" value="<?= $this->input->post('password') ?>" required>
                                        <small class="form-text text-danger"><?= form_error('password') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="pass-conf" class="fontpoppins">Confirm Password</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="password" class="form-control" name="pass-conf" value="<?= $this->input->post('pass-conf') ?>" required>
                                        <small class="form-text text-danger"><?= form_error('pass-conf') ?></small>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block fontpoppins">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>