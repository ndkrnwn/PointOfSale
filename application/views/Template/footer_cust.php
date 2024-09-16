<footer class="main-footer fontpoppins  bg-white">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2023 <a href="#">PointOfSale</a>.</strong> All rights reserved.
</footer>

</div>

<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- PopUp Survey -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .right-gap {
        margin-right: 0.5em;
        padding-left: 2.0em;
        padding-right: 2.0em;

    }
</style>

<script>
    $(document).ready(function() {
        // Cek jika modal sudah ditampilkan sebelumnya
        if (!localStorage.getItem('surveyModalShown')) {
            var surveyModal = new bootstrap.Modal(document.getElementById('surveyModal'), {
                keyboard: false
            });
            surveyModal.show();

            // Set localStorage untuk menandai modal sudah ditampilkan
            localStorage.setItem('surveyModalShown', 'true');
        }
    });

    function clearSurveyModalFlag() {
        localStorage.removeItem('surveyModalShown');
    }

    $(document).on('click', '#rating-modal-button', function() {
        $('#product-id').val($(this).data('product-id'))
        $('#sale-id').val($(this).data('sale-id'))
        $('#detail-id').val($(this).data('detail-id'))
        $('#name').text($(this).data('name'))
        var imageUrl = $(this).data('filename');

        // Mengatur src dari elemen gambar
        $('#productImage').attr('src', imageUrl);
    })

    $(document).on('click', '#review_product', function() {
        var sale_id = $('#sale-id').val();
        var detail_id = $('#detail-id').val();
        var product_id = $('#product-id').val();
        var product_comment = $('#product_comment').val();
        var rating = $('input[name="rating"]:checked').val(); // Mengambil nilai rating yang dipilih

        const swalLog = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        // Menggunakan SweetAlert untuk konfirmasi
        swalLog.fire({
            title: 'Are you sure you want to proceed with this review?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit Review!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url('transaction/process') ?>',
                    data: {
                        'review_process': true,
                        'sale_id': sale_id,
                        'detail_id': detail_id,
                        'product_id': product_id,
                        'comment': product_comment,
                        'rating': rating,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log('Success:', result); // Debugging
                        Swal.fire({
                            title: 'Success!',
                            text: 'Review has been successfully sent.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#rating-modal').modal('hide');
                            location.href = '<?= site_url('transaction') ?>'; // Pindahkan location.href ke dalam success callback
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error); // Debugging
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was a problem sending the review.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '#submit_survey', function() {
        var survey_type = $('#survey_type').val();
        var experience = $('#experience').val();
        var improvement = $('#improvement').val();
        var comments = $('#comments').val();

        const swalErr = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (!survey_type || !experience || !improvement || !comments) {
            swalErr.fire({
                title: 'Error!',
                text: 'All fields are required.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return; // Menghentikan proses jika ada input yang kosong
        }

        const swalLog = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        // Menggunakan SweetAlert untuk konfirmasi
        swalLog.fire({
            title: 'Are you sure you want to proceed with this survey?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Submit Survey!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url('submit_survey') ?>',
                    data: {
                        'submit_survey': true,
                        'survey_type': survey_type,
                        'experience': experience,
                        'improvement': improvement,
                        'comments': comments,
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log('Success:', result); // Debugging
                        Swal.fire({
                            title: 'Success!',
                            text: 'Survey has been successfully sent.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.href = '<?= site_url('home') ?>'; // Pindahkan location.href ke dalam success callback
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error); // Debugging
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was a problem sending the survey.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });
</script>

<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        var flashSuccess = $('#swalDefaultSuccess').data('flash');
        if (flashSuccess) {
            Toast.fire({
                icon: 'success',
                title: flashSuccess
            });
        }

        var flashLogin = $('#swalLogin').data('flash');
        if (flashLogin) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Toast.fire({
                icon: 'success',
                title: flashLogin
            })
        }

    });
</script>

<script type="text/javascript">
    $('.button-logout').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')


        const swalLog = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalLog.fire({
            title: 'Are you sure want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout Now!'
        }).then((result) => {
            if (result.value) {
                clearSurveyModalFlag();
                document.location.href = href;
            }
        })

    });
</script>

</body>

</html>