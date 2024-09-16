<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-cog mr-3"></i><b>Tool </b><small><i class="fa  fa-angle-double-right"></i> Broadcast Mail</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tool</a></li>
                        <li class="breadcrumb-item active">Broadcast Mail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <?php $this->load->view('message') ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-1 col-md-1">
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title fontpoppins">Compose Message</h3>
                        </div>
                        <form action="<?= site_url('admin/tool/kirim') ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm fontpoppins">Subject Mail</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control form-control-sm form-control-border" name="subject" value="Penawaran Spesial untuk Anda!">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm fontpoppins">Attachment</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="attachment">
                                            <label class="form-control form-control-border custom-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm fontpoppins">Message</label>
                                    <div class="col-form-label text-sm">
                                        :
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="compose-textarea" name="message" class="form-control" style="height:500px">
                                            <p>Kepada Pelanggan Setia,
                                                <p>Kami berharap Anda menikmati pengalaman berbelanja Anda dengan kami. Sebagai ungkapan terima kasih atas dukungan Anda, kami ingin memberikan penawaran spesial yang tidak ingin Anda lewatkan! </p>
                                                <p>Mulai dari hari ini, nikmati diskon eksklusif sebesar 20% untuk semua produk kami. Promo ini berlaku untuk semua pelanggan setia seperti Anda. </p>
                                                <p>Jangan lewatkan kesempatan ini untuk mendapatkan produk impian Anda dengan harga terbaik. Kunjungi situs web kami atau kunjungi toko fisik kami hari ini juga! </p>
                                                <br>
                                                <p>Detail Promo: </p>

                                                <p>Diskon: 20% off </p>
                                                <p>Kode Promo: SPESIAL20 </p>
                                                <br>    
                                                <p>Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut. Kami selalu siap membantu Anda.</p>
                                                <p>Terima kasih atas dukungan Anda dan selamat berbelanja!</p>

                                                <p>Salam Hangat,</p>
                                                <p>Point Of Sale</p>
                                            </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" name="send_message" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>