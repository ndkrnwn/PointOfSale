<div class="content-wrapper bg-white">

    <section class="content">
        <div class="container-fluid">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header text-center fontpoppins-header">
                                <h4 class="fontpoppins-title">Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="form-horizontal">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="<?= $row->customer_id ?>">
                                        <label for="name" class="fontpoppins">Name</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="text" class="form-control" name="name" value="<?= $row->name ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="fontpoppins">Gender</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <select class="form-control" name="gender" required>
                                            <option value="L" <?= "L" == $row->gender ? "selected" : null ?>>Laki-Laki</option>
                                            <option value="P" <?= "P" == $row->gender ? "selected" : null ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="fontpoppins">Phone</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="text" class="form-control" name="phone" value="<?= $row->phone ?>" required>
                                        <small class="form-text text-danger"><?= form_error('phone') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="fontpoppins">Email</label>
                                        <font style="font-size: 16px" color="red"><i>*</i></font>
                                        <input type="email" class="form-control " name="email" value="<?= $row->email ?>" required>
                                        <small class="form-text text-danger"><?= form_error('email') ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="fontpoppins">Address</label>
                                        <textarea class="form-control" name="address" rows="3"><?= $row->address ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block fontpoppins">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>