<style>
    .product-card {
        border: 0px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .product-card img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .star-rating {
        /* Adjust size */
        color: #fbd600;
        /* Adjust color for full stars */
    }

    .star-rating .empty {
        color: #ddd;
        /* Adjust color for empty stars */
    }

    .pagination {
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        border-radius: 0.5rem;
        border: 1px solid #ddd;
        color: #007bff;
        background-color: #fff;
        padding: 10px 15px;
        transition: background-color 0.2s, color 0.2s;

    }

    .pagination .page-link:hover {
        background-color: #0056b3;
        color: #ffffff;
        border: 1px solid #0056b3;
    }

    .pagination .active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination .disabled .page-link {
        color: #6c757d;
        cursor: not-allowed;
        background-color: #fff;
    }

    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
    }

    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
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

    .form-inline {
        flex-shrink: 0;
    }

    .form-control {
        width: 200px;
        /* Adjust the width as needed */
    }

    .btn-outline-primary {
        margin-left: 10px;
    }

    .modal-content {
        border-radius: 8px;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .modal-footer .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        border: none;
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
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="tabs">
                        <ul class="nav nav-tabs fontpoppins">
                            <li class="nav-item">
                                <a class="nav-link <?= ($filter == 'all') ? 'active' : ''; ?>" href="<?= site_url('home/all'); ?>">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= ($filter == 'exchange') ? 'active' : ''; ?>" href="<?= site_url('home/exchange'); ?>">Redeemable Products</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Search Form -->
                    <form method="get" action="<?= base_url('home/' . $filter); ?>" class="form-inline my-2 my-lg-0 float-right">
                        <input class="form-control form-control-sm mr-sm-2" type="search" name="q" placeholder="Search" value="<?= isset($search_query) ? $search_query : ''; ?>">
                        <button class="btn  btn-sm btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>

                <?php if (!empty($no_products_message)) : ?>
                    <div class="alert alert-warning mt-3 fontpoppins" role="alert">
                        <?= $no_products_message; ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-3">
                            <div class="product-card">
                                <img src="<?= base_url('uploads/product/' . $product->filename); ?>" alt="Product Image" img>
                                <a href="<?= base_url('product/detail/' . $product->product_id); ?>" class="mt-2 fontpoppins text-bold link-black">
                                    <?= $product->name; ?>
                                </a> </br>
                                <?php if ($product->is_point_exchange == 1) { ?>
                                    <span class="mt-2 fontpoppins text-sm"><?= indo_currency($product->price); ?> / <?= $product->point; ?> points</span>
                                <?php } else {  ?>
                                    <span class="mt-2 fontpoppins text-sm"><?= indo_currency($product->price); ?> </span>
                                <?php }  ?>

                                <div class="star-rating">
                                    <?php
                                    if ($product->rating == null) { ?>
                                        <span class="mt-2 fontpoppins "> no review </span> </br>
                                    <?php } else {
                                        $average_rating = round($product->rating);
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $average_rating) {
                                                echo '<i class="fas fa-star filled"></i>';
                                            } else {
                                                echo '<i class="far fa-star empty"></i>';
                                            }
                                        }
                                    } // Display stars based on average rating
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal HTML -->
<div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="surveyModalLabel">Help Us Enhance Your Experience!!</h5>
            </div>
            <div class="modal-body">
                We would love to hear your feedback to help us improve our products, treatments, and services!
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('survey'); ?>" class="btn btn-primary">Yes</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>