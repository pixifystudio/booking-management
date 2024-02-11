<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25"> <i class="fa fa-book"></i>Libra<a class="ms-25" href="https://stin.ac.id/"></a></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="../base-app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../base-app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="../base-app-assets/vendors/js/charts/apexcharts.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/toastr.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/moment.min.js"></script>
<script src="../base-app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="../base-app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="../base-app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="../base-app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="../base-app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="../base-app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/polyfill.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/jstree.min.js"></script>
<script src="../vendors/dropzone/dist/dropzone.js"></script>

<script src="../base-app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/dataTables.keyTable.min.js"></script>
<!-- <script src="../base-app-assets/js/scripts/tables/table-datatables-advanced.js"></script> -->
<script src="../base-app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="../base-app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="../base-app-assets/vendors/js/pickers/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="../base-app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Page Vendor JS-->
<script src="../base-app-assets/vendors/js/pagination/jquery.bootpag.min.js"></script>
<script src="../base-app-assets/vendors/js/pagination/jquery.twbsPagination.min.js"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Page JS-->
<script src="../base-app-assets/js/scripts/pagination/components-pagination.js"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="../base-app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="../base-app-assets/vendors/js/extensions/swiper.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="../base-app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="../base-app-assets/vendors/js/extensions/wNumb.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/nouislider.min.js"></script>
<script src="../base-app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../base-app-assets/js/core/app-menu.js"></script>
<script src="../base-app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="../base-app-assets/js/scripts/extensions/swiper.js"></script>
<script src="../base-app-assets/js/scripts/pages/app-ecommerce.js"></script>
<script src="../base-app-assets/vendors/js/extensions/jquery.rateyo.min.js"></script>
<script src="../base-app-assets/js/scripts/extensions/ext-component-ratings.js"></script>

<?php if ($halaman != '') { ?>

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/moment/moment.js"></script>
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/app-academy-dashboard.js"></script>
<?php } ?>

<!-- END: Page JS-->
<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }

        $('.datatables-basic').DataTable({
            lengthMenu: [
                [50, 25, 10, -1],
                [50, 25, 10, "All"]
            ],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-50 mb-1"' +
                '<"col-sm-12 col-md-4 col-lg-6"l>' +
                '<"col-sm-12 col-md-8 col-lg-6 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-1"f><"user_role mt-50"B>>>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-5 d-flex"i><"col-sm-7"p>>',
            buttons: [{
                extend: 'collection',
                className: 'btn btn-sm btn-outline-secondary dropdown-toggle',
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Export',
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: 'dropdown-item',
                    }
                ],
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function() {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
            }]
        });
        $('.datatables-cek').DataTable({
            "ordering": false,
            lengthMenu: [
                [50, 25, 10, -1],
                [50, 25, 10, "All"]
            ],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-50 mb-1"' +
                '<"col-sm-12 col-md-4 col-lg-6"l>' +
                '<"col-sm-12 col-md-8 col-lg-6 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-1"f><"user_role mt-50"B>>>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-5 d-flex"i><"col-sm-7"p>>',
            buttons: [{
                extend: 'collection',
                className: 'btn btn-sm btn-outline-secondary dropdown-toggle',
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Export',
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        title: 'laporan_penjualan',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: 'dropdown-item',
                    }
                ],
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function() {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
            }]
        });
        $('.datatables-all').DataTable({
            lengthMenu: [
                [-1],
                ["All"]
            ],
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-50 mb-1"' +
                '<"col-sm-12 col-md-4 col-lg-6"l>' +
                '<"col-sm-12 col-md-8 col-lg-6 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-md-end justify-content-center flex-sm-nowrap flex-wrap"<"me-1"f><"user_role mt-50"B>>>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-5 d-flex"i><"col-sm-7"p>>',
            buttons: [{
                extend: 'collection',
                className: 'btn btn-sm btn-outline-secondary dropdown-toggle',
                text: feather.icons['share'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Export',
                buttons: [{
                        extend: 'print',
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'csv',
                        text: feather.icons['file-text'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Csv',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'excel',
                        text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'pdf',
                        text: feather.icons['clipboard'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Pdf',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'copy',
                        text: feather.icons['copy'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Copy',
                        className: 'dropdown-item',
                    }
                ],
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function() {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
            }]
        });
        $('div.dataTables_length select').addClass('form-select-sm');

        var select = $('.select2'),
            selectSm = $('.select2-size-sm');
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
        });
        selectSm.each(function() {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                dropdownAutoWidth: true,
                dropdownParent: $this.parent(),
                width: '100%',
                containerCssClass: 'select-sm'
            });
        });


    })
</script>