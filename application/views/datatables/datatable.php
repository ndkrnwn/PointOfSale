<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function() {
        $('#db_user').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 4],
                },
                {
                    "width": "8 %",
                    "targets": [4],
                },
                {
                    "className": "text-center",
                    "targets": [0, 4]
                },
            ],
        });
        $('#db_product').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [2, 3, 4, 5, 6, 7],
                },
                {
                    "width": "8%",
                    "targets": [6, 7],
                },
                {
                    "className": "text-center",
                    "targets": [0, 2, 6]
                },
            ],
        });
        $('#db_service').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5],
                },
                {
                    "width": "8%",
                    "targets": [0, 5],
                },
                {
                    "className": "text-center",
                    "targets": [0, 5]
                },
            ],
        });
        $('#db_customer_trx1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5],
                },
                {
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 5, 6, 7, 8]
                },
            ],
        });
        $('#db_customer_trx2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5],
                },
                {
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 5, 6, 7, 8]
                },
            ],
        });
        $('#db_customer_trx3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5],
                },
                {
                    "className": "text-center",
                    "targets": [0, 1, 2, 3, 5, 6, 7, 8]
                },
            ],
        });
        $('#db_customer').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [6],
                },
                {
                    "width": "12%",
                    "targets": [6],
                },
                {
                    "className": "text-center",
                    "targets": [0, 6]
                },
            ],
        });
        $('#db_parameter').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 3],
                },
                {
                    "width": "5%",
                    "targets": [3],
                },
                {
                    "className": "text-center",
                    "targets": [0, 3]
                },
            ],
        });
        $('#db_stock').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 5],
                },
                {
                    "width": "5%",
                    "targets": [5],
                },
                {
                    "className": "text-center",
                    "targets": [0, 5]
                },
            ],
        });
        $('#tb_product_modal').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 3],
                },
                {
                    "width": "5%",
                    "targets": [3],
                },
                {
                    "className": "text-center",
                    "targets": [0, 3]
                },
            ],
        });
        $('#tb_service_modal').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 3],
                },
                {
                    "width": "5%",
                    "targets": [3],
                },
                {
                    "className": "text-center",
                    "targets": [0, 3]
                },
            ],
        });
        $('#db_report_sales').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 8],
                },
                {
                    "width": "10%",
                    "targets": [8],

                },
                {
                    "className": "text-center",
                    "targets": [0, 8]
                },
            ],
        });
    });
</script>

</body>

</html>