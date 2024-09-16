<style>
    /* styles.css */
    .star-rating {
        font-size: 1.2rem;
        /* Adjust size */
        color: #fbd600;
        /* Adjust color for full stars */
        display: inline-block;
    }

    .star-rating-container {
        margin-top: 5px;
        /* Add space between the name and stars */
    }

    .star-rating .filled {
        color: gold;
        /* Color for filled stars */
    }

    .star-rating .empty {
        color: #ddd;
        /* Color for empty stars */
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .justify-text {
        text-align: justify;
    }

    .profile-user-img {
        margin-right: 10px;
        /* Adjust as necessary */
    }

    .small-profile-pic {
        width: 60px;
        height: 60px;
    }

    .list-group-item {
        display: flex;
        align-items: flex-start;
        padding: 10px;
    }

    .review-content {
        flex: 1;
    }

    .custom-hr {
        border: none;
        border-top: 2px solid #ddd;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
<div class="content-wrapper bg-white">
    <section class="content">
        <div class="container-fluid">
            <div class="container mt-5">
                <!-- Product Details -->
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= base_url('uploads/product/' . $product->file_name); ?>" class="img-fluid" alt="<?= $product->name; ?>">

                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-6">
                        <h1 class="fontpoppins-detail"><?= $product->name; ?></h1>
                        <p class="lead fontpoppins"><?= indo_currency($product->price); ?>
                            <?php if ($product->is_point_exchange == 1) : ?>
                                / <?= $product->point; ?> Points Required
                            <?php endif; ?>
                        </p>
                        <p class="fontpoppins justify-text">
                            <?= !empty($product->description) ? $product->description : 'Description not available'; ?>
                        </p>
                        <div class="mt-4">
                            <h1 class="fontpoppins-detail">Overall Rating</h1>
                            <div>
                                <?php
                                $fullStars = floor($average_rating);
                                $halfStar = ($average_rating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;
                                ?>
                                <span class="star-rating"><?= str_repeat('<i class="fas fa-star "></i>', $fullStars); ?></span>
                                <span class="star-rating empty"><?= str_repeat('<i class="far fa-star empty"></i>', $emptyStars); ?></span>
                                <span class="fontpoppins"><?= $average_rating; ?> / 5.0 (<?= $total_reviews; ?> Reviews)</span>
                            </div>
                            <p></p>
                            <span class="fontpoppins text-bold">Based on <?= $total_reviews; ?> Reviews</span>
                            <div>
                                <?php
                                for ($i = 5; $i >= 1; $i--) {
                                    echo '<span class="star-rating">' . str_repeat('<i class="fas fa-star filled"></i>', $i) . '</span>';
                                    echo '<span class="star-rating empty">' . str_repeat('<i class="far fa-star empty"></i>', 5 - $i) . '</span>';
                                    echo ' (' . $rating_counts[$i] . ') </br>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Reviews Section -->
                <div class="mt-5">
                    <h1 class="fontpoppins-detail">Reviews</h1>
                    <?php if ($reviews) : ?>
                        <div class="list-group">
                            <?php foreach ($reviews as $review) : ?>
                                <div class="list-group-item  border-0">
                                    <img class="profile-user-img img-fluid img-circle small-profile-pic" src="<?= base_url('assets/'); ?>dist/img/avatar.jpg" alt="profile picture">
                                    <div class="review-content">
                                        <span class="mb-1 fontpoppins text-bold"> <?= $review->customer_name; ?></span>
                                        <div class="star-rating-container">
                                            <span class="star-rating">
                                                <?php
                                                $filledStars = str_repeat('<i class="fas fa-star filled"></i>', $review->grade);
                                                $emptyStars = str_repeat('<i class="far fa-star empty"></i>', 5 - $review->grade);
                                                echo $filledStars . $emptyStars;
                                                ?>
                                            </span>
                                        </div> </br>
                                        <p class="mb-1 fontpoppins"><?= $review->comment; ?></p>
                                        <hr class="custom-hr">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="fontpoppins">No reviews yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>