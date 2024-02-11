<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Manajemen Stok Buku</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a>Physical Book</a>
                </li>
                <li class="breadcrumb-item active"><a>Manajemen Stok Buku</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $code = isset($_GET['code']) ? $_GET['code'] : '';
    if ($code != "") {
      $expCode        = explode("|", $code);
      $warehouse_id   = $expCode[0];
      $warehouse_name = $expCode[1];
    }
    $category = isset($_GET['txtCategory']) ? $_GET['txtCategory'] : '';
    $subcategory = isset($_GET['txtSubCategory']) ? $_GET['txtSubCategory'] : '';
    $kemasan = isset($_GET['txtKemasan']) ? $_GET['txtKemasan'] : '';

    $subs = "";
    if ($subcategory != "") {

      $expSub = explode(",", $subcategory);
      $konmin1 = count($expSub) - 1;
      for ($i = 0; $i < $konmin1; $i++)
        $subs = $subs . "'" . $expSub[$i] . "',";
    }
    $subs = rtrim($subs, ",");

    $kem = "";
    if ($kemasan != "") {

      $expkem = explode(",", $kemasan);
      $konmin1 = count($expkem) - 1;
      for ($i = 0; $i < $konmin1; $i++)
        $kem = $kem . "'" . $expkem[$i] . "',";
    }
    $kem = rtrim($kem, ",");

    $dateMin1 = new DateTime(date('Y-m-d'));
    $dateMin1F = $dateMin1->format('Y-m-d');
    $dataMonth = isset($_GET['txtMonth']) ? $_GET['txtMonth'] : $dateMin1F;
    $dataMonthJS1 = new DateTime(date($dataMonth));
    $dataMonthJS2 = $dataMonthJS1->format('d/m/Y');

    $datePlus1 = new DateTime(date('Y-m-d'));
    $datePlus1F = $datePlus1->format('Y-m-d');
    $dataYear = isset($_GET['year']) ? $_GET['year'] : $datePlus1F;
    $dataYearJS1 = new DateTime(date($dataYear));
    $dataYearJS2 = $dataYearJS1->format('d/m/Y');
    ?>
    <div class="content-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header border-bottom">
              <div class="content-header-left col-md-6 col-12">
                <h4 class="card-title">Book Stock Management</h4>
              </div>
              <div class="content-header-right text-md-end col-md-6 col-12 d-md-block d-none">
                <form role="form" action="?page=Report-Validasi" method="POST" name="form1" target="_self" id="form1">
                  <div class="row">

                    <div class="col-md-10 col-12 px-25">
                      <div class="mb-1">
                        <select id="subcategory" class="form-control select2" multiple="multiple" tabindex="-1" name="txtSubCategoryArr[]">
                          <?php
                          $dataQry = mysqli_query($koneksidb, "SELECT category_level_1 FROM master_category
                                                    group by category_level_1");
                          while ($dataRow = mysqli_fetch_array($dataQry)) {
                            echo "<option value='$dataRow[category_level_1]' $cek>$dataRow[category_level_1]</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2 col-12 ps-25">
                      <div class="mb-1">
                        <button type="submit" class="btn btn-primary w-100" name="btnReportLogistikStokGudang"><i data-feather='filter'></i> Filter</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="card-datatable">
              <table class="table table-striped table-bordered dt-responsive dt-stok-gudang" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th>Kemasan</th>
                    <th>No. Barang</th>
                    <th>Deskripsi Persediaan</th>
                    <th>Stok</th>
                    <th>Fisik</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sum  = 0;
                  if ($code != "") {
                    $mySql = "SELECT
                                        s.stock_id,
                                        s.stock_order_id,
                                        s.stock_status,
                                        s.stock_date,
                                        s.document_id,
                                        SUM(IF(s.stock_status = 'OUT',(-1 * s.qty), s.qty )) AS qty,
                                        s.stock_note,
                                        s.racking_id,
                                        s.warehouse_id,
                                        s.updated_by,
                                        s.updated_date,
                                        w.warehouse_name,
                                        p.document_name,
                                        p.document_category,
                                        p.document_sub_category,
                                        p.document_note
                                        FROM
                                        stock s 
                                        JOIN master_warehouse w ON s.warehouse_id = w.warehouse_id 
                                        JOIN master_document p ON s.document_id = p.document_id
                                        WHERE s.stock_date <= '" . $dataMonth . "'
                                        AND s.warehouse_id = '" . $warehouse_id . "'                                        
                                        ";

                    if ($subcategory != '')
                      $mySql .= " AND p.document_category IN (" . $subs . ") ";


                    $mySql .= "  GROUP BY s.warehouse_id,s.document_id ORDER BY p.document_category ASC";
                    // echo $mySql;
                    $myQry = mysqli_query($koneksidb, $mySql);
                    while ($myData = mysqli_fetch_array($myQry)) {
                      $sum  = $sum + $myData['qty'];
                  ?>
                      <tr>
                        <td><?= $myData['product_category']; ?></td>
                        <td><?= $myData['product_note']; ?></td>
                        <td><?= $myData['product_id']; ?></td>
                        <td>
                          <b?><?= $myData['product_name']; ?></b>
                        </td>
                        <td class="text-end">
                          <b?><?= round($myData['qty'], 3); ?></b>
                        </td>
                        <td class="text-end">&nbsp;</td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th class="text-end">Total:</th>
                    <th class="text-end"><?= round($sum, 3) ?></th>
                    <th>&nbsp;</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- END: Content-->
<?php include "footer_difan.php"; ?>
<script src="footer_default.js"></script>
<script>
  $(document).ready(function() {
    var startDate = '<?= $dataMonthJS2 ?>';
    var gudang = '<?= $warehouse_name ?>';
    document.title = "Laporan Stok Gudang - " + gudang;

    var table = $('.dt-stok-gudang').DataTable({
      paging: false,
      "lengthMenu": [
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
            extend: 'excel',
            messageTop: 'per tanggal ' + startDate,
            footer: true,
            text: feather.icons['file'].toSvg({
              class: 'font-small-4 me-50'
            }) + 'Excel',
            className: 'dropdown-item'
          },
          {
            extend: 'pdf',
            title: '',
            footer: true,
            text: feather.icons['clipboard'].toSvg({
              class: 'font-small-4 me-50'
            }) + 'Pdf',
            className: 'dropdown-item',
            customize: function(doc) {
              doc.content.unshift({
                text: 'per tanggal ' + startDate,
                fontSize: 12,
                alignment: 'center'
              });
              doc.content.unshift({
                text: 'PT. DIFAN PRIMA PAINT\r\nLAPORAN STOK GUDANG - ' + gudang,
                fontSize: 16,
                bold: true,
                alignment: 'center'
              });
              doc.defaultStyle.fontSize = 10;
              doc.styles.tableHeader.fontSize = 11;
              doc.styles.tableFooter.fontSize = 11;
              doc.content[2].table.widths = ['*', '*', 'auto', '*', '*', '*'];
              doc.pageMargins = [10, 10];
              var rowCount = doc.content[2].table.body.length;
              for (i = 1; i < rowCount; i++) {
                doc.content[2].table.body[i][3].alignment = 'right';
              }
            }
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
  });
</script>
</body>

</html>