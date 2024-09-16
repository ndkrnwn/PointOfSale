<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <?php $this->load->view('message') ?>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text ">Today's New Members</span>
                            <span class="info-box-number"><?= $member->total ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text ">Today's Transaction</span>
                            <span class="info-box-number"><?= $transaction->total ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fab fa-product-hunt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text ">Today's Product Sale</span>
                            <span class="info-box-number"><?= $product->total ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-spa"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text ">Today's Treatment Sale</span>
                            <span class="info-box-number"><?= $service->total ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <span class=" text-bold">Top 10 Selling Products This Month</span> <br><br>
                            <canvas id="top_product"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <span class=" text-bold">Top 10 Treatments This Month</span> <br><br>
                            <canvas id="top_service"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <span class=" text-bold">Total Monthly Sales Over the Course of a Year</span> <br><br>
                            <canvas id="year_sale" height="115"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <span class=" text-bold">Payment Methods for This Month</span> <br><br>
                            <canvas id="top_payment"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <!-- <div class="info-box mb-2"> -->
                    <!-- <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-spa"></i></span> -->

                    <div class="small-box bg-gradient-danger">
                        <div class="inner">
                            <h3 class=" text-lg text-bold"><?= indo_currency($income->total) ?></h3>
                            <p class="" style="font-size: 12px;">Total Income on This Month<br>
                                ( Product & Treatment)</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-rupiah-sign"></i>
                        </div>
                    </div>
                    <div class="small-box bg-gradient-blue">
                        <div class="inner">
                            <h3 class=" text-lg text-bold"><?= indo_currency($income_p->total) ?></h3>
                            <p class="" style="font-size: 12px;">Total Income on This Month <br>
                                ( Product )</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-product-hunt"></i>
                        </div>
                    </div>
                    <div class="small-box bg-gradient-pink">
                        <div class="inner">
                            <h3 class=" text-lg text-bold"><?= indo_currency($income_s->total) ?></h3>
                            <p class="" style="font-size: 12px;">Total Income on This Month <br>
                                ( Treatment )</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-spa"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <span class=" text-bold">15 Products with the Lowest Stock</span> <br><br>
                                <canvas id="stock" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <span class=" text-bold">Top 10 Customer with the Highest Point</span> <br><br>
                                <table class="table table-hover table-sm table-striped small">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Point</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($row->result() as $key => $data) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?> </td>
                                                <td><?= $data->name ?> </td>
                                                <td><span class="badge badge-primary "><?= $data->point ?></span> </td>
                                            </tr>
                                        <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>