<footer class="main-footer fontpoppins">
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
<!-- SUMMERNOTE -->
<script src="<?= base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- DATEPICKER -->
<script src="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetshow.js"></script>
<!-- Select 2 -->
<script src="<?= base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- input file  -->
<script src="<?= base_url('assets/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- CHART.JS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/chart.umd.js"></script>

<style>
    .right-gap {
        margin-right: 0.5em;
        padding-left: 2.0em;
        padding-right: 2.0em;

    }
</style>
<script>
    $(function() {
        bsCustomFileInput.init();

        $('.select2').select2()
    });

    $(function() {
        $('#compose-textarea').summernote()
    })

    $(document).ready(function() {
        calculate()
        togglePointRow()
    })

    // fn Auto Calculate "Change" - Sales Modul
    $(document).on('keyup mouseup', '#cash', function() {
        calculate()
    })

    // fn Auto Calculate on Update Cart Modal Product - Sales Modul
    $(document).on('keyup mouseup', '#product_edit_qty, #product_edit_discount_item', function() {
        count_edit_cart_product()
    })

    // fn Auto Calculate on Update Cart Modal Service - Sales Modul
    $(document).on('keyup mouseup', '#service_edit_qty, #service_edit_discount_item', function() {
        count_edit_cart_service()
    })


    //fn Toogle Payment Method Cash / Change - Sales Modul
    function toggleFieldRow() {
        var method = document.getElementById("method_payment").value;
        var cashFieldRow = document.getElementById("cashFieldRow");
        var changeFieldRow = document.getElementById("changeFieldRow");
        var pointPaymentFieldRow = document.getElementById("pointPaymentFieldRow");
        var cash = document.getElementById("cash");
        var customerPoint = document.getElementById("customer_point");

        var totalpoint = 0;
        $('#cart_table_item tr').each(function() {
            var pointValue = parseInt($(this).find('#totalpoint').text(), 10);
            if (!isNaN(pointValue)) {
                totalpoint += pointValue;
            }
        });

        if (method === 'CASH') {
            calculate();
            cashFieldRow.style.display = "flex";
            changeFieldRow.style.display = "flex";
            cash.setAttribute('required', 'required');
            pointPaymentFieldRow.style.display = "none";
        } else if (method === 'POINT') {
            pointPaymentFieldRow.style.display = "flex";
            var pointCustomer = $('#customer_point').val();
            $('#pointcustomer').val(pointCustomer);
            $('#pointrequired').val(isNaN(totalpoint) ? 0 : totalpoint);
            $('#sub_total').val(0);
            $('#disc_total').val(0);
            $('#total_price').val(0);
            $('#invoice_price').text(0);
            cashFieldRow.style.display = "none";
            changeFieldRow.style.display = "none";
            cash.removeAttribute('required'); // Hapus atribut required dari cash
        } else {
            calculate();
            pointPaymentFieldRow.style.display = "none";
            cashFieldRow.style.display = "none";
            changeFieldRow.style.display = "none";
            cash.removeAttribute('required'); // Hapus atribut required dari cash
        }

        document.getElementById('customer_point').addEventListener('input', function() {
            var pointCustomer = this.value;
            $('#pointcustomer').val(pointCustomer);
        });

    }

    function togglePointRow() {
        var checkbox = document.getElementById("point_toogle");
        var test = document.getElementById("pointFieldRow");

        if (checkbox.checked) {
            test.style.display = "flex";
            product_point.setAttribute('required', 'required');
        } else {
            test.style.display = "none";
            product_point.removeAttribute('required');
        }
    }
</script>

<!-- TOAST ALERT -->
<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        var flashSuccess = $('#swalDefaultSuccess').data('flash');
        if (flashSuccess) {
            Toast.fire({
                icon: 'success',
                title: flashSuccess
            });
        }

        var flashError = $('#swalDefaultError').data('flash');
        if (flashError) {
            Toast.fire({
                icon: 'error',
                title: flashError
            });
        }

        var flashDeleted = $('#swalDefaultDeleted').data('flash');
        if (flashDeleted) {
            Toast.fire({
                icon: 'success',
                title: flashDeleted
            })
        };

        var flashWarning = $('#swalDefaultWarning').data('flash');
        if (flashWarning) {
            Toast.fire({
                icon: 'warning',
                title: flashWarning
            })
        };

        var flashRelation = $('#swalRelation').data('flash');
        if (flashRelation) {
            Toast.fire({
                icon: 'warning',
                title: flashRelation
            })
        };

        var flashLogin = $('#swalLogin').data('flash');
        if (flashLogin) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                text: 'Welcome to POS System Apps',
                title: flashLogin
            })
        };

    });
</script>

<!-- SCRIPT Login & Logout -->
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
                document.location.href = href;
            }
        })

    });
</script>

<!-- Javascript Delete Data  -->
<script type="text/javascript">
    // fn Delete Product on Product Modul
    $(document).on('click', '#delete-product', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        var img = $(this).data('img')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/product/del') ?>",
                    data: {
                        'delete': true,
                        id: id,
                        img: img,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/product/product') ?>'
            }
        });
    });

    // fn Delete Stock Product on Stock Product Modul
    $(document).on('click', '#delete-stock', function(event) {
        event.preventDefault();

        var stock_id = $(this).data('id')
        var product_id = $(this).data('product-id')
        var qty = $(this).data('qty')
        var type = $(this).data('type')
        var fn = $(this).data('fn')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/product/stock_del') ?>",
                    data: {
                        'delete': true,
                        stock_id: stock_id,
                        product_id: product_id,
                        qty: qty,
                        type: type,
                        fn: fn,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/product/') ?>' + fn;
            }
        });
    });

    // fn Delete Service on Service Modul
    $(document).on('click', '#delete-service', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/service/del') ?>",
                    data: {
                        'delete': true,
                        id: id,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/service') ?>'
            }
        });
    });

    // fn Delete Customer on Customer Modul
    $(document).on('click', '#delete-customer', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/customer/del') ?>",
                    data: {
                        'delete': true,
                        id: id,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/customer') ?>'
            }
        });
    });

    // fn Delete User on Customer Modul
    $(document).on('click', '#delete-user', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/user/del') ?>",
                    data: {
                        'delete': true,
                        id: id,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/user') ?>'
            }
        });
    });

    // fn Delete Parameter on Parameter Modul
    $(document).on('click', '#delete-parameter', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        var code = $(this).data('code')
        var fn = $(this).data('fn')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/parameter/del') ?>",
                    data: {
                        'delete': true,
                        id: id,
                        code: code,

                    },
                    async: false
                })
                location.href = '<?= site_url('admin/parameter/') ?>' + fn;
            }
        });
    });

    // fn Delete Stock Product on Stock Product Modul
    $(document).on('click', '#delete-sales', function(event) {
        event.preventDefault();

        var sale_id = $(this).data('id')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/sales/del_sales') ?>",
                    data: {
                        'delete': true,
                        sale_id: sale_id,
                    },
                    async: false
                })
                location.href = '<?= site_url('admin/sales/report_sales') ?>';
            }
        });
    });
</script>

<!-- Javascript Modal -->
<script>
    // Fn Detail Customer
    $(document).on('click', '#detail-customer', function() {
        $('#name').text($(this).data('name'))
        $('#gender').text($(this).data('gender'))
        $('#phone').text($(this).data('phone'))
        $('#email').text($(this).data('email'))
        $('#address').text($(this).data('address'))
        $('#category').text($(this).data('category'))
        $('#point').text($(this).data('point'))
        $('#createddate').text($(this).data('createddate'))
        $('#createdby').text($(this).data('createdby'))
        $('#modifydate').text($(this).data('modifydate'))
        $('#modifyby').text($(this).data('modifyby'))

    })

    // fn Select Product on Stock In / Out Form
    $(document).on('click', '#select-product-modal', function() {
        var product_id = $(this).data('id');
        var name = $(this).data('name');
        var stock = $(this).data('stock');
        $('#product_id').val(product_id);
        $('#name').val(name);
        $('#stock').val(stock);
        $('#product-modal').modal('hide');
    })
</script>

<!-- Javascript on Sales Modul ( Select , Add, Edit, Delete ) -->
<script>
    // fn Calculate Sub, Discount, and Grand Total - Sales Modal
    function calculate() {

        // fn Count SubTotal
        var subtotal = 0;
        $('#cart_table_item tr').each(function() {
            subtotal += parseInt($(this).find('#subtotal').text())
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        // fn Count Discount Total
        var discount = 0;
        $('#cart_table_item tr').each(function() {
            discount += parseInt($(this).find('#disctotal').html())
        })
        isNaN(discount) ? $('#disc_total').val(0) : $('#disc_total').val(discount)

        // fn Count Total Price
        var totalprice = subtotal - discount
        if (isNaN(totalprice)) {
            $('#total_price').val(0)
            $('#invoice_price').text(0)
        } else {
            $('#total_price').val(totalprice)
            $('#invoice_price').text('Rp ' + totalprice)
        }

        // fn Count Change when input Cash
        var cash = $('#cash').val();
        cash != 0 ? $('#change').val(cash - totalprice) : $('#change').val(0)

    }

    // fn Calculate SubTotal, DiscountTotal, PriceTotal Product Modal on Sale Modul
    function count_edit_cart_product() {
        var product_price = $('#product_edit_price').val()
        var product_qty = $('#product_edit_qty').val()
        var product_point = $('#product_edit_item_point').val()
        var product_discount = $('#product_edit_discount_item').val()

        sub_total = product_price * product_qty
        $('#product_edit_sub_total').val(sub_total)

        disc_total = (product_price * (product_discount / 100)) * product_qty
        $('#product_edit_disc_total').val(disc_total)

        total_price = sub_total - disc_total
        $('#product_edit_total_price').val(total_price)

        total_point = product_point * product_qty
        $('#product_edit_total_point').val(total_point)

    }

    // fn Calculate SubTotal, DiscountTotal, PriceTotal Service Modal on Sale Modul
    function count_edit_cart_service() {
        var service_price = $('#service_edit_price').val()
        var service_qty = $('#service_edit_qty').val()
        var service_discount = $('#service_edit_discount_item').val()

        sub_total = service_price * service_qty
        $('#service_edit_sub_total').val(sub_total)

        disc_total = (service_price * (service_discount / 100)) * service_qty
        $('#service_edit_disc_total').val(disc_total)

        total_price = sub_total - disc_total
        $('#service_edit_total_price').val(total_price)
    }

    // fn Button Select Customer - Sales Modul
    $(document).on('click', '#select-customer-modal-sales', function() {
        var id = $(this).data('id');
        var point = $(this).data('point-cust');
        var name = $(this).data('name');
        $('#customer_id').val(id);
        $('#customer_point').val(point);
        $('#customer_name').val(name);
        $('#customer-modal-sales').modal('hide');
        toggleFieldRow();
    })

    // fn Button Select Product on Modal Product - Sales Modul
    $(document).on('click', '#select-product-modal-sales', function() {
        var item_type = 'product';
        var item_id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var stock = $(this).data('stock');
        var point = $(this).data('point');
        $('#item_type_product').val(item_type);
        $('#item_id_product').val(item_id);
        $('#name_product').val(name);
        $('#item_price_product').val(price);
        $('#stock_product').val(stock);
        $('#item_point_product').val(point);
        $('#product-modal-sales').modal('hide');
        $('#product-modal-cart').modal('show');

        get_cart_qty_product($(this).data('name'))

    })

    // fn Get Qty Product on Cart - Sales Modul 
    function get_cart_qty_product(item) {
        $('#cart_table_item tr').each(function() {
            var qty_cart = $("#cart_table_item td.item:contains('" + item + "')").parent().find("td").eq(3).html()
            if (qty_cart != null) {
                $('#qty_product_cart').val(qty_cart)
            } else {
                $('#qty_product_cart').val(0)
            }
        });
    }

    // fn Select Product on Cart Modal Service - Sales Modul
    $(document).on('click', '#select-product-sales', function() {
        $('#product-modal-cart').modal('hide');
        $('#product-modal-sales').css("overflow-y", "scroll"); // auto or scroll
    })

    $(document).on('click', '#name_product', function() {
        $('#product-modal-cart').modal('hide');
        $('#product-modal-sales').css("overflow-y", "scroll"); // auto or scroll
    })

    // fn Update Product on Cart Modal - Sales Modal
    $(document).on('click', '#update_cart_product', function() {
        $('#product_cart_id').val($(this).data('id'))
        $('#product_edit_name').val($(this).data('item-name'))
        $('#product_edit_price').val($(this).data('item-price'))
        $('#product_edit_qty').val($(this).data('item-qty'))
        $('#product_edit_stock').val($(this).data('item-stock'))
        $('#product_edit_item_point').val($(this).data('item-point'))
        $('#product_edit_total_point').val($(this).data('total-point'))
        $('#product_edit_discount_item').val($(this).data('item-discount'))
        // $('#product_edit_discount_item').val($(this).data('cart_price') * $(this).data('qty'))
        $('#product_edit_disc_total').val($(this).data('disc-total'))
        $('#product_edit_sub_total').val($(this).data('subtotal'))
        $('#product_edit_total_price').val($(this).data('total'))
    })

    // fn Update Service on Cart Modal - Sales Modal
    $(document).on('click', '#update_cart_service', function() {
        $('#service_cart_id').val($(this).data('id'))
        $('#service_edit_name').val($(this).data('item-name'))
        $('#service_edit_price').val($(this).data('item-price'))
        $('#service_edit_qty').val($(this).data('item-qty'))
        $('#service_edit_discount_item').val($(this).data('item-discount'))
        / $('#service_edit_discount_item').val($(this).data('cart_price') * $(this).data('qty'))
        $('#service_edit_disc_total').val($(this).data('disc-total'))
        $('#service_edit_sub_total').val($(this).data('subtotal'))
        $('#service_edit_total_price').val($(this).data('total'))
    })

    // fn Add Product to Cart - Sales Modul
    $(document).on('click', '#add_cart_product', function() {
        var item_id = $('#item_id_product').val();
        var item_type = $('#item_type_product').val();
        var item_price = $('#item_price_product').val();
        var item_point = $('#item_point_product').val();
        var discount_item = $('#discount_product').val();
        var stock = $('#stock_product').val();
        var qty = $('#qty_product').val();
        var qty_cart = $('#qty_product_cart').val();

        const swalPrc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (item_id === '') {
            swalPrc.fire({
                icon: 'warning',
                title: 'Product has not been selected.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#name_product').focus();
            });
        } else if (qty == 0) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Quantity cannot be 0.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#qty_product').focus();
            });
        } else if (qty_cart > 0) {
            swalPrc.fire({
                icon: 'info',
                title: 'Product is already in the Cart.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#qty_product_cart').val('1');
                $('#name_product').focus();
            });
        } else if (stock < 1 || parseInt(stock) < parseInt(qty)) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Stock is insufficient.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#qty_product').focus();
            });
        } else {
            $.ajax({
                type: 'post',
                url: '<?= site_url('admin/sales/process') ?>',
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'item_type': item_type,
                    'item_price': item_price,
                    'item_point': item_point,
                    'discount_item': discount_item,
                    'qty': qty
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                            calculate();
                            toggleFieldRow();
                        });
                        resetProductForm()
                        $('#product-modal-cart').modal('hide');
                    } else {
                        swalPrc.fire({
                            icon: 'error',
                            title: 'Failed to add item to cart.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    swalPrc.fire({
                        icon: 'error',
                        title: 'An error occurred while adding item to cart.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    function resetProductForm() {
        $('#item_id_product').val('');
        $('#item_type_product').val('');
        $('#item_price_product').val('');
        $('#name_product').val('');
        $('#qty_product').val('1');
        $('#stock_product').val('');
        $('#point_product').val('');
        $('#qty_product_cart').val('');
        $('#discount_product').val('0');
    }

    // fn Button Edit Cart Product - Sales Module
    $(document).on('click', '#edit_cart_product', function() {
        var cart_id = $('#product_cart_id').val();
        var edit_qty = $('#product_edit_qty').val();
        var edit_stock = $('#product_edit_stock').val();
        var edit_total_point = $('#product_edit_total_point').val();
        var edit_subtotal = $('#product_edit_sub_total').val();
        var edit_discount_item = $('#product_edit_discount_item').val();
        var edit_disc_total = $('#product_edit_disc_total').val();
        var edit_total_price = $('#product_edit_total_price').val();


        const swalPrc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (edit_qty === '' || edit_qty < 1) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Quantity cannot be 0.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#product_edit_qty').focus();
            });
        } else if (parseInt(edit_qty) > parseInt(edit_stock)) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Stock is insufficient.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#product_edit_qty').focus();
            });
        } else {
            $.ajax({
                type: 'post',
                url: '<?= site_url('admin/sales/process') ?>',
                data: {
                    'edit_cart': true,
                    'cart_id': cart_id,
                    'qty': edit_qty,
                    'total_point': edit_total_point,
                    'discount_item': edit_discount_item,
                    'sub_price': edit_subtotal,
                    'disc_total': edit_disc_total,
                    'total_price': edit_total_price
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                            calculate();
                        });
                        swalPrc.fire({
                            icon: 'success',
                            title: 'Cart has been successfully updated.',
                            confirmButtonText: 'OK'
                        });
                        $('#product-edit-modal-cart').modal('hide');
                    } else {
                        swalPrc.fire({
                            icon: 'info',
                            title: 'There are no updates from the Cart.',
                            confirmButtonText: 'OK'
                        });
                        $('#product-edit-modal-cart').modal('hide');
                    }
                },
                error: function() {
                    swalPrc.fire({
                        icon: 'error',
                        title: 'An error occurred while updating the cart.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    // fn Button Select Service on Modal Service - Sales Modul
    $(document).on('click', '#select-service-modal-sales', function() {
        var item_type = 'service';
        var item_id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        $('#item_type_service').val(item_type);
        $('#item_id_service').val(item_id);
        $('#item_price_service').val(price);
        $('#name_service').val(name);
        $('#service-modal-sales').modal('hide');
        $('#service-modal-cart').modal('show');

        get_cart_qty_service($(this).data('name'))
    })

    // fn Get Qty Service on Cart - Sales Modul 
    function get_cart_qty_service(item) {
        $('#cart_table_item tr').each(function() {
            var qty_cart = $("#cart_table_item td.item:contains('" + item + "')").parent().find("td").eq(3).html()
            if (qty_cart != null) {
                $('#qty_service_cart').val(qty_cart)
            } else {
                $('#qty_service_cart').val(0)
            }
        });
    }

    // fn Select Service on Cart Modal Service - Sales Modul
    $(document).on('click', '#select-service-sales', function() {
        $('#service-modal-cart').modal('hide');
        $('#service-modal-sales').css("overflow-y", "scroll"); // auto or scroll
    })

    $(document).on('click', '#name_service', function() {
        $('#service-modal-cart').modal('hide');
        $('#service-modal-sales').css("overflow-y", "scroll"); // auto or scroll
    })

    // fn Add Service to Cart - Sales Module
    $(document).on('click', '#add_cart_service', function() {
        var item_id = $('#item_id_service').val().trim();
        var item_type = $('#item_type_service').val().trim();
        var item_price = parseFloat($('#item_price_service').val()) || 0;
        var discount_item = parseFloat($('#discount_service').val()) || 0;
        var qty = parseInt($('#qty_service').val(), 10) || 0;
        var qty_cart = parseInt($('#qty_service_cart').val(), 10) || 0;

        const swalPrc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (item_id === '') {
            swalPrc.fire({
                icon: 'warning',
                title: 'Treatment has not been selected.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#name_service').focus();
            });
        } else if (qty <= 0) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Quantity cannot be 0.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#qty_service').focus();
            });
        } else if (qty_cart > 0) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Treatment is already in the Cart.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#qty_service_cart').val('1');
                $('#name_service').focus();
            });
        } else {
            $.ajax({
                type: 'post',
                url: '<?= site_url('admin/sales/process') ?>',
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'item_point': 0,
                    'item_type': item_type,
                    'item_price': item_price,
                    'discount_item': discount_item,
                    'qty': qty,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                            calculate();
                            toggleFieldRow();
                        });
                        resetServiceForm();
                        $('#service-modal-cart').modal('hide');
                    } else {
                        swalPrc.fire({
                            icon: 'error',
                            title: 'Failed to add item to cart.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function() {
                    swalPrc.fire({
                        icon: 'error',
                        title: 'An error occurred.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    function resetServiceForm() {
        $('#item_id_service').val('');
        $('#item_type_service').val('');
        $('#item_price_service').val('');
        $('#name_service').val('');
        $('#qty_service').val('1');
        $('#qty_service_cart').val('');
        $('#discount_service').val('0');
    }

    // fn Button Edit Cart Service - Sales Module
    $(document).on('click', '#edit_cart_service', function() {
        var cart_id = $('#service_cart_id').val();
        var edit_qty = $('#service_edit_qty').val();
        var edit_subtotal = $('#service_edit_sub_total').val();
        var edit_discount_item = $('#service_edit_discount_item').val();
        var edit_disc_total = $('#service_edit_disc_total').val();
        var edit_total_price = $('#service_edit_total_price').val();

        const swalPrc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (edit_qty === '' || edit_qty < 1) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Quantity cannot be 0.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#service_edit_qty').focus();
            });
        } else {
            $.ajax({
                type: 'post',
                url: '<?= site_url('admin/sales/process') ?>',
                data: {
                    'edit_cart': true,
                    'cart_id': cart_id,
                    'qty': edit_qty,
                    'total_point': 0,
                    'discount_item': edit_discount_item,
                    'sub_price': edit_subtotal,
                    'disc_total': edit_disc_total,
                    'total_price': edit_total_price
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                            calculate();
                        });
                        swalPrc.fire({
                            icon: 'success',
                            title: 'Cart has been successfully updated.',
                            confirmButtonText: 'OK'
                        });
                        $('#service-edit-modal-cart').modal('hide');
                    } else {
                        swalPrc.fire({
                            icon: 'info',
                            title: 'There are no updates from the Cart.',
                            confirmButtonText: 'OK'
                        });
                        $('#service-edit-modal-cart').modal('hide');
                    }
                },
                error: function() {
                    swalPrc.fire({
                        icon: 'error',
                        title: 'An error occurred while updating the cart.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });

    // fn Delete Item on Cart - Sales Modul
    $(document).on('click', '#del_cart', function(event) {
        event.preventDefault();

        var id = $(this).data('id')
        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Delete Data?',
            text: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({

                    type: "post",
                    url: "<?= site_url('admin/sales/cart_del') ?>",
                    data: {
                        'del_cart': true,
                        id: id,
                    },
                    async: false,
                    success: function() {
                        $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                            calculate();
                            toggleFieldRow(); // Memanggil toggleFieldRow() setelah data diperbarui
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }

                })
            }
        });

    });

    // fn Delete All Item on Cart - Sales Modul ( Cancel Payment )
    $(document).on('click', '#cancel_payment', function(event) {
        event.preventDefault();

        const swalDel = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        swalDel.fire({
            title: 'Cancel Transaction?',
            text: 'Confirming will result in the removal of all items from the cart. Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('admin/sales/cart_del') ?>",
                    data: {
                        'cancel_payment': true,
                        // id: id,
                    },
                    async: false
                })
                $('#cart_table_item').load('<?= site_url('admin/sales/cart_data') ?>', function() {
                    calculate()
                })
            }
        });

    });

    $(document).on('click', '#process_payment', function() {
        var customer_id = $('#customer_id').val().trim();
        var sub_total = parseFloat($('#sub_total').val()) || 0;
        var disc_total = parseFloat($('#disc_total').val()) || 0;
        var total_price = parseFloat($('#total_price').val()) || 0;
        var pointAward = 0;
        var cash = parseFloat($('#cash').val()) || 0;
        var change = parseFloat($('#change').val()) || 0;
        var method_payment = $('#method_payment').val().trim();
        var date = $('#date').val().trim();
        var pointRequired = parseFloat($('#pointrequired').val()) || 0;
        var pointCustomer = parseFloat($('#pointcustomer').val()) || 0;


        const swalPrc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary right-gap',
                cancelButton: 'btn btn-secondary right-gap',
            },
            buttonsStyling: false
        })

        if (total_price >= 200000) {
            pointAward = 200;
        } else if (total_price > 0 && total_price <= 199999) {
            pointAward = 100;
        } else {
            pointAward = 0;
        }

        $('#point').val(pointAward);


        if (sub_total < 1 && method_payment !== 'POINT') {
            swalPrc.fire({
                icon: 'warning',
                title: 'No item has been selected',
                text: 'Please add items to proceed.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#product_name').focus();
            });
        } else if (customer_id === '') {
            swalPrc.fire({
                icon: 'warning',
                title: 'Customer field cannot be empty',
                text: 'Please select or enter a customer.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#customer_id').focus();
            });
        } else if (method_payment === '') {
            swalPrc.fire({
                icon: 'warning',
                title: 'Payment method must not be empty',
                text: 'Please select a payment method.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#method_payment').focus();
            });
        } else if (method_payment === 'CASH' && cash <= 0) {
            swalPrc.fire({
                icon: 'warning',
                title: 'Cash field must not be empty',
                text: 'Please enter the amount of cash.',
                confirmButtonText: 'OK'
            }).then(() => {
                $('#cash').focus();
            });
        } else if (method_payment === 'POINT') {
            if (pointRequired > pointCustomer) {
                swalPrc.fire({
                    icon: 'warning',
                    title: 'Point isn\'t enough',
                    text: 'Please check your points.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    $('#pointcustomer').focus();
                });
            } else {
                // Check if there are any items with point value of 0
                var hasZeroPointItem = false;
                $('#cart_table_item tr').each(function() {
                    var pointValue = parseFloat($(this).find('#totalpoint').text()) || 0;
                    if (pointValue === 0) {
                        hasZeroPointItem = true;
                    }
                });

                if (hasZeroPointItem) {
                    swalPrc.fire({
                        icon: 'warning',
                        title: 'Some products can\'t be paid with points',
                        text: 'Please check the items in your cart.',
                        confirmButtonText: 'OK'
                    });
                } else {
                    proceedTransaction();
                }
            }
        } else {
            proceedTransaction();
        }

        function proceedTransaction() {
            swalPrc.fire({
                title: 'Are you sure you want to proceed with this transaction?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '<?= site_url('admin/sales/process') ?>',
                        data: {
                            'process_transaction': true,
                            'customer_id': customer_id,
                            'subtotal': sub_total,
                            'disctotal': disc_total,
                            'totalprice': total_price,
                            'point': pointAward,
                            'cash': cash,
                            'remaining': change,
                            'method_payment': method_payment,
                            'pay_point': pointRequired,
                            'date': date
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                swalPrc.fire({
                                    icon: 'success',
                                    title: 'Transaction successful',
                                    text: 'Your transaction has been processed.',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.open('<?= site_url('admin/sales/print/') ?>' + result.sale_id, '_blank');
                                    location.href = '<?= site_url('admin/sales/transaction') ?>';
                                });
                            } else {
                                swalPrc.fire({
                                    icon: 'error',
                                    title: 'Transaction failed',
                                    text: 'There was an error processing your transaction.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            swalPrc.fire({
                                icon: 'error',
                                title: 'Transaction failed',
                                text: 'There was an error processing your request.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        }
    });

    // fn Button Detail Transaction - Sales Modul
    $(document).on('click', '#detail-sales', function() {
        $('#invoice').text($(this).data('invoice'))
        $('#saledate').text($(this).data('date') + " " + $(this).data('time'))
        $('#cashier').text($(this).data('cashier'))
        $('#customer').text($(this).data('customer'))
        $('#subtotal').text($(this).data('subtotal'))
        $('#disctotal').text($(this).data('disctotal'))
        $('#totalprice').text($(this).data('totalprice'))
        $('#payment').text($(this).data('payment'))
        $('#cash').text($(this).data('cash'))
        $('#change').text($(this).data('change'))

        var item_data = '<table class="table table-sm table-hover no-margin text-sm text-primary">'
        item_data += '<tr><th>Name</th><th>Price</th><th>Qty</th><th>Disc / Item</th><th>Sub Price</th></th><th>Disc Total</th><th>Total</th></tr>'
        $.getJSON('<?= site_url('admin/sales/detail_report/') ?>' + $(this).data('id'), function(data) {
            $.each(data, function(key, val) {
                item_data +=
                    '<tr><td>' + val.item_name +
                    '</td><td>' + val.detail_price +
                    '</td><td>' + val.qty +
                    '</td><td>' + val.discount_item + '%' +
                    '</td><td>' + val.sub_price +
                    '</td><td>' + val.disc_total +
                    '</td><td>' + val.total_price +
                    '</td></tr>'
            })
            item_data += '</table>'
            $('#item_data').html(item_data)
        })
    })
</script>


<script>
    $(document).ready(function() {

        var currentURL = window.location.href;
        var dashboardURL = "<?php echo base_url('admin/dashboard'); ?>";
        var reportURL = "<?php echo base_url('admin/report'); ?>";

        if (currentURL === dashboardURL) {
            const base_url = "<?php echo base_url(); ?>"
            const canvasWidth = 50;
            const canvasHeight = 50;

            const topProductChart = () => {
                $.ajax({
                    url: base_url + 'admin/dashboard/top_product',
                    dataType: 'json',
                    method: 'get',
                    success: data => {
                        let chartX = [];
                        let chartY = [];
                        data.forEach(item => {
                            chartX.push(item.product_name);
                            chartY.push(item.total);
                        });
                        const chartData = {
                            labels: chartX,
                            datasets: [{
                                label: 'Top 10 Selling Products This Month',
                                data: chartY,
                                backgroundColor: ['skyblue'],
                                borderColor: ['skyblue'],
                                borderWidth: 2
                            }]
                        };
                        const ctx = document.getElementById('top_product').getContext('2d');
                        const config = {
                            type: 'line',
                            data: chartData,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        };
                        new Chart(ctx, config); // Menggunakan nama variabel myChart
                    }
                });
            };

            const topServiceChart = () => {
                $.ajax({
                    url: base_url + 'admin/dashboard/top_service',
                    dataType: 'json',
                    method: 'get',
                    success: data => {
                        let chartX = [];
                        let chartY = [];
                        data.forEach(item => {
                            chartX.push(item.service_name);
                            chartY.push(item.total);
                        });
                        const chartData = {
                            labels: chartX,
                            datasets: [{
                                label: 'Top 10 Treatments This Month',
                                data: chartY,
                                backgroundColor: ['rgb(255, 99, 132)'],
                                borderColor: ['rgb(255, 99, 132)'],
                                borderWidth: 2
                            }]
                        };
                        const ctx = document.getElementById('top_service').getContext('2d');
                        const config = {
                            type: 'line',
                            data: chartData,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        };
                        new Chart(ctx, config); // Menggunakan nama variabel myChart
                    }
                });
            };

            const topPaymentChart = () => {
                $.ajax({
                    url: base_url + 'admin/dashboard/top_payment',
                    dataType: 'json',
                    method: 'get',
                    success: data => {
                        let chartX = [];
                        let chartY = [];
                        data.forEach(item => {
                            chartX.push(item.payment_category);
                            chartY.push(item.total);
                        });
                        const chartData = {
                            labels: chartX,
                            datasets: [{
                                label: 'Total Payments',
                                data: chartY,
                                backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'aliceblue', 'pink', 'orange', 'gold', 'plum', 'darkcyan', 'wheat', 'silver', 'salmon'],
                                borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'aliceblue', 'pink', 'orange', 'gold', 'plum', 'darkcyan', 'wheat', 'silver', 'salmon'],
                                borderWidth: 2,
                                overOffset: 4
                            }]
                        };
                        const ctx = document.getElementById('top_payment').getContext('2d');
                        const config = {
                            type: 'polarArea',
                            data: chartData,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        };
                        new Chart(ctx, config); // Menggunakan nama variabel myChart

                    }
                });
            };

            const yearSaleChart = () => {
                $.ajax({
                    url: base_url + 'admin/dashboard/year_sale',
                    dataType: 'json',
                    method: 'get',
                    success: data => {
                        let chartX = [];
                        let chartY = [];
                        data.forEach(item => {
                            chartX.push(item.nama_bulan);
                            chartY.push(item.total);
                        });
                        const chartData = {
                            labels: chartX,
                            datasets: [{
                                label: 'Total Monthly Sales Over the Course of a Year',
                                data: chartY,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1,
                                overOffset: 4
                            }]
                        };
                        const ctx = document.getElementById('year_sale').getContext('2d');
                        const config = {
                            type: 'bar',
                            data: chartData,
                            options: {
                                indexAxis: 'y',
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        };
                        new Chart(ctx, config); // Menggunakan nama variabel myChart
                    }
                });
            };


            const dataStockChart = () => {
                $.ajax({
                    url: base_url + 'admin/dashboard/data_stock',
                    dataType: 'json',
                    method: 'get',
                    success: data => {
                        let chartX = [];
                        let chartY = [];
                        data.forEach(item => {
                            chartX.push(item.name);
                            chartY.push(item.stock);
                        });
                        const chartData = {
                            labels: chartX,
                            datasets: [{
                                label: '15 Products with the Lowest Stock',
                                data: chartY,
                                backgroundColor: ['skyblue'],
                                borderColor: ['rgb(54, 162, 235)'],
                                borderWidth: 1
                            }]
                        };
                        const ctx = document.getElementById('stock').getContext('2d');
                        const config = {
                            type: 'bar',
                            data: chartData,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        };
                        new Chart(ctx, config); // Menggunakan nama variabel myChart
                    }
                });
            };

            topProductChart();
            topServiceChart();
            dataStockChart();
            topPaymentChart();
            yearSaleChart();
        }

        if (currentURL === reportURL) {
            function generateMonthOptions() {
                const monthSelect = document.getElementById('monthSelect');
                const months = [
                    "1 - January", "2 - February", "3 - March", "4 - April",
                    "5 - May", "6 - June", "7 - July", "8 - August",
                    "9 - September", "10 - October", "11 - November", "12 -     December"
                ];

                for (let i = 0; i < months.length; i++) {
                    const option = document.createElement('option');
                    option.value = i + 1;
                    option.text = months[i];
                    monthSelect.appendChild(option);
                }
            }

            function generateYearOptions() {
                const yearSelect = document.getElementById('yearSelect');
                const currentYear = new Date().getFullYear();

                for (let i = currentYear - 10; i <= currentYear; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.text = (i - currentYear + 11) + ' - ' + i;
                    yearSelect.appendChild(option);
                }
            }

            generateMonthOptions();
            generateYearOptions();

            // Ambil elemen-elemen yang diperlukan

        }


    });

    function toggleReportFieldRow() {
        // var method = document.getElementById("method_payment").value;
        var reportSelect = document.getElementById('report').value;
        var typeFieldRow = document.getElementById('typeFieldRow');
        var monthFieldRow = document.getElementById('monthFieldRow');
        var yearFieldRow = document.getElementById('yearFieldRow');
        var typeSelect = document.getElementById('typeSelect');
        var yearSelect = document.getElementById('yearSelect');
        var monthSelect = document.getElementById('monthSelect');

        if (reportSelect === 'stock_in' || reportSelect === 'stock_out' || reportSelect === 'transaction' || reportSelect === 'detail_transaction' || reportSelect === 'review' || reportSelect === 'survey') {
            typeFieldRow.style.display = 'flex'; // Tampilkan elemen 'typeFieldRow'
            typeSelect.setAttribute('required', 'required');

            if (typeSelect.value === 'annual') {
                yearFieldRow.style.display = 'flex'; // Tampilkan elemen 'yearFieldRow'
                yearSelect.setAttribute('required', 'required');
                monthFieldRow.style.display = 'none'; // Sembunyikan elemen 'monthFieldRow'
                monthSelect.removeAttribute('required');
            } else if (typeSelect.value === 'monthly') {
                monthFieldRow.style.display = 'flex'; // Tampilkan elemen 'monthFieldRow'
                yearFieldRow.style.display = 'flex'; // Tampilkan elemen 'yearFieldRow'
                yearSelect.setAttribute('required', 'required');
                monthSelect.setAttribute('required', 'required');
            } else {
                monthFieldRow.style.display = 'none'; // Sembunyikan elemen 'monthFieldRow'
                yearFieldRow.style.display = 'none'; // Sembunyikan elemen 'yearFieldRow'
                yearSelect.removeAttribute('required');
                monthSelect.removeAttribute('required');
            }
        } else {
            typeFieldRow.style.display = 'none'; // Sembunyikan elemen 'typeFieldRow'
            monthFieldRow.style.display = 'none'; // Sembunyikan elemen 'monthFieldRow'
            yearFieldRow.style.display = 'none'; // Sembunyikan elemen 'yearFieldRow'
            typeSelect.removeAttribute('required');
            yearSelect.removeAttribute('required');
            monthSelect.removeAttribute('required');
        }


    }
</script>

</body>

</html>