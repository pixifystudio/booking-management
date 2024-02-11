<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";


// ambil data filter
$date = date('Y-m-d');
$cat = isset($_GET['cat']) ? $_GET['cat'] : '';

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
            <h2 class="content-header-title float-start mb-0">Report</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a>Inventory Asset</a>
                </li>
                <li class="breadcrumb-item"><a></a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header border-bottom">
              <div class="content-header-left col-md-12">
                <div class="row">
                  <div class="col-8">
                    <h4 class="card-title">Inventory Asset</h4>

                  </div>
                  <div class="col-4">
                    <form role="form" action="?page=Validasi" method="POST" name="form3" target="_self" id="form3">
                      <div class="row">
                        <div class="col-md-8 col-12">

                          <label>Category</label>
                          <select name="txtCategory" class="form-control select2">
                            <?php
                            $dataQry = mysqli_query($koneksidb, "SELECT * from master_category where category_level_1='PHYSICAL'  order by category_level_2 asc");
                            while ($dataRow = mysqli_fetch_array($dataQry)) {
                              if ($dataRow['category_level_3'] == $cat) {
                                $cek = 'Selected';
                              } else {
                                $cek = '';
                              }
                              echo "<option value='$dataRow[category_level_3]' $cek>$dataRow[category_level_2] -  $dataRow[category_level_3] </option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-4 col-12">
                          <br>
                          <button type="submit" name="btnBookStock" class="btn btn-primary">Filter</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </div>


            </div>
            <div class="card-datatable">
              <table class="table datatables-basic table-striped table-bordered dt-responsive " cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Ver</th>
                    <th>Title</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $nomor = 0;
                  $mySql    = "SELECT document_id,document_version,document_title_id,SUM(qty) as qty, category_level_3 FROM `stock` s join view_document d on d.document_id=s.product_id";

                  if ($cat != '') {
                    $mySql .= " WHERE d.category_level_3='$cat' ";
                  }

                  $mySql .= " GROUP BY product_id";
                  $myQry    = mysqli_query($koneksidb, $mySql);
                  while ($myData = mysqli_fetch_array($myQry)) {
                    $nomor++;
                  ?>

                    <tr>
                      <td><?php echo $nomor; ?></td>
                      <td><?php echo $myData['document_id']; ?></td>
                      <td><?php echo $myData['document_version']; ?></td>
                      <td><?php echo $myData['document_title_id']; ?></td>
                      <td> <?php echo $myData['qty']; ?> </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->

<?php
include "footer_difan.php";
?>

<script src=" js_new/footer_default.js">
</script>