<?php
include_once "../../library/inc.connection.php";
if ((isset($_POST['UserId']))) {
    $UserId            = $_POST['UserId'];
    echo "<option value=''>Pilih</option>";

    # code...
    $mySql = "SELECT
	s1.* 
FROM
	`stock_order` s1 
WHERE
    s1.stock_order_reference='BORROWING'
    AND s1.stock_order_reference_id = '$UserId' 
	AND s1.stock_order_id NOT IN (SELECT s2.stock_order_reference_id FROM stock_order s2 WHERE stock_order_reference='RETURNING')";
    $query = mysqli_query($koneksidb, $mySql) or die(" ERP ERROR : " . mysqli_error($koneksidb));
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        while ($data = mysqli_fetch_array($query)) {
?>
            <option value="<?php echo $data['stock_order_id']; ?>"><?php echo $data['stock_order_id']; ?></option>
<?php
        }
    }
}
?>