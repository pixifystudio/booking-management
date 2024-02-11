<?php
include_once "library/inc.seslogin.php";
include "header_wadaro.php";


require 'library/phpoffice/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

?>
<!-- page content -->
<div class="right_col" role="main">
    <?php
    # Tombol cancel
    if (isset($_POST['btnCancel'])) {
        echo "<meta http-equiv='refresh' content='0; url=?page=Purchase-Payment'>";
    }
    $dataSupplier    = isset($_GET['id']) ?  $_GET['id'] : '';
    $dataCode    = isset($_GET['id2']) ?  $_GET['id2'] : '';
    $dataVersion    = isset($_GET['v']) ?  $_GET['v'] : 1;



    if (isset($_POST['btnSubmit'])) {

        $pesanError = array();

        function autofalse()
        {
            global $koneksidb;
            mysqli_autocommit($koneksidb, FALSE);
        }
        function commit()
        {
            global $koneksidb;
            mysqli_commit($koneksidb);
        }
        function rollback()
        {
            global $koneksidb;
            mysqli_rollback($koneksidb);
        }

   


        $target_dir = "uploads/files/";
        $inputFileName = $target_dir . 'bookshelf_template.xlsx';
        // $bulkNumber = getDatetimeNow();
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadsheet = $reader->load($inputFileName);
        $allDataInSheet = $spreadsheet->getActiveSheet()->toArray();
        $arrayCount = count($allDataInSheet);
        //
        if (count($pesanError) >= 1) {
            echo "&nbsp;<div class='alert alert-warning'>";
            $noPesan = 0;
            foreach ($pesanError as $indeks => $pesan_tampil) {
                $noPesan++;
                echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
            }
            echo "</div>";
        } else {
            try {

        
                autofalse();
                $tgl        = date('Y-m-d H:i:s');

                $dataPONew = '';
                $dataPOYIMM   = '';
                for ($i = 1; $i < $arrayCount; $i++) {


                    $txtShelfID       = mysqli_real_escape_string($koneksidb, strtoupper(trim($allDataInSheet[$i]["0"])));
                    $txtCapacity      = mysqli_real_escape_string($koneksidb, trim(str_replace('.', '', $allDataInSheet[$i]["1"])));

                    $dataUrut       = $i;

                    // jika belum ada format nya, create
                    // exit;
                    // if ($dataPO != '') {

                    $dataProductName  = $myData['product_name'];
                    $dataPlant  = $myData['plant'];
                    $dataPrice  = $myData['price'];

                    $ses_nama  = $_SESSION['SES_NAMA'];
                    // if ($dataPONew != $dataPO) {
                    $mySql    = "INSERT INTO master_racking ( racking_number, racking_capacity, racking_status, updated_by ,updated_date)
						VALUES ('$txtShelfID','$txtCapacity','1', '$ses_nama',now())";
                    $myQry = mysqli_query($koneksidb, $mySql) or die("Error query " . mysqli_error($koneksidb));
                    if (!$myQry)
                        throw new Exception("code:so. " . $i . '|' . $dataPO . mysqli_error($koneksidb));
                    // }

                    // }
                }
             
                commit();
                echo "<meta http-equiv='refresh' content='0; url=?page=Bookshelf&msg=add'>";
                exit;
            } catch (Exception $e) {
                rollback();
                // echo "<meta http-equiv='refresh' content='0; url=?page=Marketing-DS-Add&id=" . $dataCode . "&status=" . $dataStatus . "&info=" . $e->getMessage() . "'>";
                echo "&nbsp;<div class='alert alert-warning'>";
                echo "&nbsp;&nbsp; Form gagal diinput. " . $e->getMessage() . "<br>";
                echo "</div>";
            }
        }
    }
    ?>


    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Import Book Location<small></small></h3>
            </div>
            <div class="title_right">
                <div class="form-group pull-right">
                    <a href="uploads/files/bookshelf_template.xlsx" class="btn btn-success btn-sm" role="button"><i class="fa fa-file-excel-o fa-fw"></i> Download Template</a>
                    <a href="?page=Bookshelf" class="btn btn-info btn-sm" role="button"><i class="fa fa-chevron-circle-left fa-fw"></i> Back</a>

                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Upload Supporting Files</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class=""><i class="fa fa-wrench"></i></a>

                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form action="upload_bulk_bookshelf.php" class="dropzone">
                            <input name="txtCode" type="hidden" value="<?php echo $dataCode; ?>" />
                            <input name="txtVersion" type="hidden" value="<?php echo $dataVersion; ?>" />
                            <input name="txtName" type="hidden" value="<?php echo $_SESSION['SES_NAMA']; ?>" />
                            <input name="txtType" type="hidden" value="purchase_payment" />
                        </form>
                        <br />
                        <!-- <p><b>Supporting Files</b> (<a href="?page=Purchase-Payment-Files&id=<?php echo $dataSupplier; ?>&id2=<?php echo $dataCode; ?>" role="button"><i class="fa fa-undo fa-fw"></i> Refresh</a>)</p> -->

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
                            <div class="col-xs-12">

                                <div class="ln_solid"></div>
                                <a href="?page=Bookshelf" class="btn btn-warning btn-sm" role="button"><i class="fa fa-undo fa-fw"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm" name="btnSubmit"><i class="fa fa-check-square-o fa-fw"></i> Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php
include "footer.php";
?>