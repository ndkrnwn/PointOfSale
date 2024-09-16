<div class="content-wrapper  bg-white fontpoppins">

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-file mr-3"></i><b>Report </b><small><i class="fa  fa-angle-double-right"></i> Export Data</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Report</a></li>
                        <li class="breadcrumb-item active">Export Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4">
                </div>
                <div class="col-12 col-sm-4 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-bold fontpoppins-title">Export Data</span> <br><br>
                            <div class="col-lg-12">
                                <form method="POST" action="<?= site_url('admin/report/export'); ?>">
                                    <div class="form-group row" style="margin-bottom: 0;">
                                        <label class="col-sm-4 col-form-label" for="report">Report</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm select2" data-dropdown-css-class="select2" name="report" id="report" onchange="toggleReportFieldRow()" required>
                                                <option value="customer">1 - Customer Report</option>
                                                <option value="product">2 - Product Report</option>
                                                <option value="treatment">3 - Treatment Report</option>
                                                <option value="stock_in">4 - Stock In Product Report</option>
                                                <option value="stock_out">5 - Stock Out Product Report</option>
                                                <option value="transaction">6 - Transaction Report</option>
                                                <option value="detail_transaction">7 - Detailed Transaction Report</option>
                                                <option value="review">8 - Review Report</option>
                                                <option value="survey">9 - Survey Report</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom: 0; display:none;" id="typeFieldRow">
                                        <label class="col-sm-4 col-form-label" for="report_type">Report Type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm select2" data-dropdown-css-class="select2" id="typeSelect" onchange="toggleReportFieldRow()" name="type" required>
                                                <option disabled value="" selected>-- Select Type --</option>
                                                <option value="annual">1 - Annual Report</option>
                                                <option value="monthly">2 - Monthly Report</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-bottom: 0; display:none;" id="yearFieldRow">
                                        <label class="col-sm-4 col-form-label">Year </label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm select2" data-dropdown-css-class="select2" id="yearSelect" name="year">
                                                <option disabled value="" selected>-- Select Year --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 row" style="margin-bottom: 0; display:none;" id="monthFieldRow">
                                        <label class="col-sm-4 col-form-label">Month </label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm select2" data-dropdown-css-class="select2" id="monthSelect" name="month">
                                                <option disabled value="" selected>-- Select Month --</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class=" card-footer">
                            <div class="form-group mb-0 row">
                                <div class="col-sm-12">
                                    <button type="submit" name="export" class="btn btn-sm btn-outline-primary col-sm-3 float-right">
                                        <i class="fa fa-file-export"></i>&nbsp; Export
                                    </button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4">
            </div>
        </div>
    </section>
</div>