<style>
    .star-rating {
        direction: rtl;
        font-size: 1rem;
        /* Adjust size */
        color: #fbd600;
        display: inline-block;
    }

    .star-rating input {
        display: none;
        /* Hides radio buttons */
    }

    .star-rating label {
        color: #d3d3d3;
        /* Gray color for unselected stars */
        font-size: 1.5rem;
        /* Size of stars */
        cursor: pointer;
        display: inline-block;
        margin: 0;
    }

    .star-rating input:checked~label {
        color: #ffd700;
        /* Gold color for selected stars */
    }

    .star-rating input:checked+label {
        color: #ffd700;
        /* Gold color for selected star */
    }

    .star-rating input:checked+label~label {
        color: #ffd700;
        /* Gold color for all previous stars */
    }

    .modal-header .close {
        margin-top: -10px;
    }

    .fontpoppins-header {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
    }

    .fontpoppins {
        font-family: 'Poppins', sans-serif;
    }

    .btn-rounded {
        border-radius: 50px;
    }

    .rounded {
        border-radius: 8px;
    }

    #product_comment {
        height: 100px;
        /* Atur sesuai kebutuhan */
    }

    .link-black {
        color: black;
        /* Set the color of the link text to black */
        text-decoration: none;
        /* Optional: remove underline from links */
    }

    .link-black:hover,
    .link-black:focus {
        color: black;
        /* Ensure the color stays black when hovering or focusing */
    }

    .profile-info {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 5px;
        /* Jarak antara label dan nilai */
        font-size: 0.875rem;
        /* Ukuran font kecil */
        text-align: left;
        /* Rata kiri */
    }

    .info-item {
        display: flex;
        align-items: center;
    }

    .info-item strong {
        margin-right: 10px;
        /* Jarak antara label dan titik dua */
        white-space: nowrap;
        /* Menghindari pemotongan teks */
    }
</style>

<div class="content-wrapper bg-white">

    <div class="content-header">
        <div class="container fontpoppins">
            <?php $this->load->view('message') ?>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/'); ?>dist/img/avatar.jpg" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center fontpoppins" style="margin-bottom: 0;"><?= $row->name ?>
                                <a href="<?= site_url('profile/' . $row->customer_id) ?>" title="Edit Profile">
                                    <i class="far fa-edit"></i>
                                </a>
                            </h3>
                            <div class="text-center fontpoppins">
                                <small>
                                    <a href="<?= site_url('password/' . $row->customer_id) ?>" title="Change Password">
                                        change password
                                    </a>
                                </small>
                            </div> </br>

                            <!-- Informasi Tambahan dengan CSS Kecil dan Rata Kiri -->
                            <div class="profile-info">
                                <div class="info-item fontpoppins-profile"><strong>Phone</strong></div>
                                <div class="info-item fontpoppins-profile">: <?= $row->phone ?></div>

                                <div class="info-item fontpoppins-profile"><strong>Email</strong></div>
                                <div class="info-item fontpoppins-profile">: <?= $row->email ?></div>

                                <div class="info-item fontpoppins-profile"><strong>Address</strong></div>
                                <div class="info-item fontpoppins-profile">: <?= $row->address ?></div>

                                <div class="info-item fontpoppins-profile"><strong>Gender</strong></div>
                                <div class="info-item fontpoppins-profile">: <?php
                                                                                // Array mapping gender
                                                                                $gender_labels = [
                                                                                    'P' => 'Perempuan',
                                                                                    'L' => 'Laki-laki',
                                                                                ];

                                                                                // Menampilkan label gender, dengan fallback ke 'Tidak Diketahui' jika tidak ditemukan
                                                                                echo isset($gender_labels[$row->gender]) ? $gender_labels[$row->gender] : 'Tidak Diketahui';
                                                                                ?></div>
                            </div>
                            </br>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item fontpoppins">
                                    Total Transaction <a class="float-right"><?= $ttl_transaction->total ?></a>
                                </li>
                                <li class="list-group-item fontpoppins">
                                    Total Point<a class="float-right"><?= $row->point ?></a>
                                </li>
                                <li class="list-group-item fontpoppins">
                                    Product Reviewed <a class="float-right"><?= $ttl_reviewed->total ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs fontpoppins" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">All Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Reviewed Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Unreviewed Products</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <div class="card-body">
                                    <table id="db_customer_trx1" class="table table-striped table-sm small">
                                        <thead>
                                            <tr>
                                                <th class="fontpoppins">No</th>
                                                <th class="fontpoppins">Invoice</th>
                                                <th class="fontpoppins">Date</th>
                                                <th class="fontpoppins"></th>
                                                <th class="fontpoppins">Product</th>
                                                <th class="fontpoppins">Qty</th>
                                                <th class="fontpoppins">Sub Price</th>
                                                <th class="fontpoppins">Discount</th>
                                                <th class="fontpoppins">Total</th>
                                                <th class="fontpoppins">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($trx_all->result() as $key => $data) { ?>

                                                <?php if ($data->file_name !== null) :
                                                    $src = base_url('uploads/product/') . $data->file_name;
                                                else :
                                                    $src = base_url('uploads/product/sample.jpg')  ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?= $no++ ?> </td>
                                                    <td><?= $data->invoice ?> </td>
                                                    <td><?= indo_date($data->date) ?> </td>
                                                    <td><img style="height: 60px; width: 60px" src="<?= $src ?>"></td>
                                                    <td><a href="<?= base_url('product/detail/' . $data->product_id); ?>" class="link-black">
                                                            <?= $data->name; ?>
                                                        </a> </br> </td>
                                                    <td><?= $data->qty ?> </td>
                                                    <td><?= indo_currency($data->subprice) ?> </td>
                                                    <td><?= indo_currency($data->disctotal) ?> </td>
                                                    <td><?= indo_currency($data->totalprice) ?> </td>
                                                    <td>
                                                        <?php if ($data->review !== '1') : ?>
                                                            <button data-toggle="modal" id="rating-modal-button" data-target="#rating-modal" data-sale-id="<?= $data->sale_id ?>" data-detail-id="<?= $data->detail_id ?>" data-product-id="<?= $data->product_id ?>" data-name="<?= $data->name ?>" data-filename="<?= $src ?>" class="btn btn-xs btn-outline-primary" data-toggle="tooltip" title="Rating Product">
                                                                <i class="fas fa-star"></i>
                                                            </button>
                                                        <?php endif; ?>

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <div class="card-body">
                                    <table id="db_customer_trx2" class="table table-striped table-sm small">
                                        <thead>
                                            <tr>
                                                <th class="fontpoppins">No</th>
                                                <th class="fontpoppins">Invoice</th>
                                                <th class="fontpoppins">Date</th>
                                                <th class="fontpoppins"></th>
                                                <th class="fontpoppins">Product</th>
                                                <th class="fontpoppins">Qty</th>
                                                <th class="fontpoppins">Sub Price</th>
                                                <th class="fontpoppins">Discount</th>
                                                <th class="fontpoppins">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($trx_reviewed->result() as $key => $data) { ?>

                                                <?php if ($data->file_name !== null) :
                                                    $src = base_url('uploads/product/') . $data->file_name;
                                                else :
                                                    $src = base_url('uploads/product/sample.jpg')  ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?= $no++ ?> </td>
                                                    <td><?= $data->invoice ?> </td>
                                                    <td><?= indo_date($data->date) ?> </td>
                                                    <td><img style="height: 60px; width: 60px" src="<?= $src ?>"></td>
                                                    <td><a href="<?= base_url('product/detail/' . $data->product_id); ?>" class="link-black">
                                                            <?= $data->name; ?>
                                                        </a> </br> </td>
                                                    <td><?= $data->qty ?> </td>
                                                    <td><?= indo_currency($data->subprice) ?> </td>
                                                    <td><?= indo_currency($data->disctotal) ?> </td>
                                                    <td><?= indo_currency($data->totalprice) ?> </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                <div class="card-body">
                                    <table id="db_customer_trx3" class="table table-striped table-sm small">
                                        <thead>
                                            <tr>
                                                <th class="fontpoppins">No</th>
                                                <th class="fontpoppins">Invoice</th>
                                                <th class="fontpoppins">Date</th>
                                                <th class="fontpoppins"></th>
                                                <th class="fontpoppins">Product</th>
                                                <th class="fontpoppins">Qty</th>
                                                <th class="fontpoppins">Sub Price</th>
                                                <th class="fontpoppins">Discount</th>
                                                <th class="fontpoppins">Total</th>
                                                <th class="fontpoppins">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($trx_unreviewed->result() as $key => $data) { ?>

                                                <?php if ($data->file_name !== null) :
                                                    $src = base_url('uploads/product/') . $data->file_name;
                                                else :
                                                    $src = base_url('uploads/product/sample.jpg')  ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td><?= $no++ ?> </td>
                                                    <td><?= $data->invoice ?> </td>
                                                    <td><?= indo_date($data->date) ?> </td>
                                                    <td><img style="height: 60px; width: 60px" src="<?= $src ?>"></td>
                                                    <td><a href="<?= base_url('product/detail/' . $data->product_id); ?>" class="link-black">
                                                            <?= $data->name; ?>
                                                        </a> </br> </td>
                                                    <td><?= $data->qty ?> </td>
                                                    <td><?= indo_currency($data->subprice) ?> </td>
                                                    <td><?= indo_currency($data->disctotal) ?> </td>
                                                    <td><?= indo_currency($data->totalprice) ?> </td>
                                                    <td>
                                                        <button data-toggle="modal" id="rating-modal-button" data-target="#rating-modal" data-sale-id="<?= $data->sale_id ?>" data-detail-id="<?= $data->detail_id ?>" data-product-id="<?= $data->product_id ?>" data-name="<?= $data->name ?>" data-filename="<?= $src ?>" class="btn btn-xs btn-outline-primary" data-toggle="tooltip" title="Rating Product">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL PRODUCT RATING -->
<div class="modal fade" id="rating-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fontpoppins-header">Product Rating</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sale-id">
                <input type="hidden" id="detail-id">
                <input type="hidden" id="product-id">
                <div class="form-group">
                    <div class="input-group">
                        <img id="productImage" class="rounded" style="height: 60px; width: 60px;" alt="Product Image">
                        <span id="name" class="fontpoppins ml-3 my-auto"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group align-items-center">
                        <label class="fontpoppins mb-0 mr-3">Product Quality</label>
                        <div class="star-rating" style="padding-left: 35%;">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="fontpoppins">Comments</label>
                    <textarea id="product_comment" class="form-control form-control-sm input-area bg-white"></textarea>
                </div>
                <div class="float-right">
                    <button type="button" id="review_product" class="btn btn-sm btn-outline-primary btn-rounded waves-effect fontpoppins">
                        Submit
                    </button>
                </div>
            </div>
        </div>

        <!-- /.modal-dialog -->
    </div>
</div>