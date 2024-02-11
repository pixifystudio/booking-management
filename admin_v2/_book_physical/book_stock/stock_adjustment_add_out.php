<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
$pesanError = array();

# Tombol Submit diklik
if (isset($_POST['btnSubmit'])) {
    # VALIDASI FORM, jika ada kotak yang kosong, buat pesan error ke dalam kotak $pesanError
    $pesanError = array();
    # BACA DATA DALAM FORM, masukkan datake variabel

    $Category = explode("|", $_POST['txtProduk']);
    $dataProduk        = $Category[0];
    $dataRak        = $Category[1];
    $dataStatus        = 'OUT';
    $dataQty        = $_POST['txtQty'];
    $dataQty        = $dataQty * -1;
    $dataNote        = 'STOCK ADJUSTMENT : ' . $_POST['txtNote'];

    $mySql    = "SELECT ifnull(sum(qty),0) as total FROM stock WHERE product_id='$dataProduk' AND racking_id='$dataRak'  ";
    $myQry    = mysqli_query($koneksidb, $mySql)  or die("BIBLIOTECA ERROR  : " . mysqli_error($koneksidb));
    $myData = mysqli_fetch_array($myQry);
    if ($myData['total'] < abs($dataQty)) {
        $pesanError[] = "Data stok di rak hanya<b> " . $myData['total'] . " </b>, stock adjustment tidak bisa dilakukan";
    }

    # JIKA ADA PESAN ERROR DARI VALIDASI
    if (count($pesanError) >= 1) {
        echo "&nbsp;<div class='alert alert-warning'>";
        $noPesan = 0;
        foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
        }
        echo "</div>";
    } else {


        $ses_nama    = $_SESSION['SES_NAMA'];
        $mySql      = "INSERT INTO stock (stock_order_id, stock_status, stock_date, product_id, qty, stock_note, racking_id, 
						warehouse_id, updated_by, updated_date)
						VALUES ('', '$dataStatus',NOW(),'$dataProduk','$dataQty','$dataNote','$dataRak','1','$ses_nama',now())";
        $myQry = mysqli_query($koneksidb, $mySql) or die("BIBLIOTECA ERROR  :  " . mysqli_error($koneksidb));
        if ($myQry) {
            echo "<meta http-equiv='refresh' content='0; url=?page=Asset-Management-Physical-Stock'>";
        }
        exit;
    }
} // Penutup Tombol Submit
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Asset Management</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a>Stock Asset Management</a>
                                </li>
                                <li class="breadcrumb-item">Adjust OUT</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (count($pesanError) >= 1) { ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Danger</h4>
                <div class="alert-body">
                    <?php
                    $noPesan = 0;
                    foreach ($pesanError as $indeks => $pesan_tampil) {
                        $noPesan++;
                        echo "<p>$noPesan. $pesan_tampil</p>";
                    }
                    ?>
                </div>
            </div>
        <?php } ?>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <div class="content-header-left col-12">
                                    <h4 class="card-title">Penyesuaian Stok : Adjust Out</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-1">
                                    <div class="col-md-6 col-12 pe-25">
                                        <div class="mb-1">
                                            <label>Rack | Asset Id</label>
                                            <select name="txtProduk" class="form-control select2">
                                                <?php
                                                $dataQry = mysqli_query($koneksidb, "SELECT d.document_id,d.racking_id,r.racking_number from document d join master_racking r on r.racking_id=d.racking_id where d.racking_id is not null");
                                                while ($dataRow = mysqli_fetch_array($dataQry)) {
                                                    echo "<option value='$dataRow[document_id]|$dataRow[racking_id]' $cek>[$dataRow[racking_number]] $dataRow[document_id] </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12 ps-25">
                                        <div class="mb-1">
                                            <label class="form-label">Qty *</label>
                                            <input class="form-control" placeholder="Qty" name="txtQty" type="number" value="" required />
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12 ps-25">
                                        <div class="mb-1">
                                            <label class="form-label">Keterangan *</label>
                                            <input class="form-control" placeholder="Keterangan" name="txtNote" type="text" value="" required />
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="?page=Asset-Management-Physical-Stock" class="btn btn-outline-warning">Batalkan</a>
                                        <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
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
<script>
    $(document).ready(function() {

    });
</script>
</body>

</html>