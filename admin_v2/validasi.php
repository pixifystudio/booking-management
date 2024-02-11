<?php
$id  = isset($_POST['cari']) ?  $_POST['cari'] : '';
$cat  = isset($_POST['txtCategory']) ?  $_POST['txtCategory'] : '';
$date  = isset($_POST['txtDate']) ?  $_POST['txtDate'] : '';
$date2  = isset($_POST['txtDate2']) ?  $_POST['txtDate2'] : '';


$branch  = isset($_POST['txtBranch']) ?  $_POST['txtBranch'] : '';
$division  = isset($_POST['txtDivision']) ?  $_POST['txtDivision'] : '';
$department  = isset($_POST['txtDepartment']) ?  $_POST['txtDepartment'] : '';
$unit  = isset($_POST['txtUnit']) ?  $_POST['txtUnit'] : '';


if (isset($_POST['btnCari'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Search&id=" . $id . "'>";
}
if (isset($_POST['btnCariAdmin'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Search-Admin&id=" . $id . "'>";
}
if (isset($_POST['btnBookBorrow'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Book-Management-Physical-Stock-Trans&cat=" . $cat . "'>";
}
if (isset($_POST['btnBookStock'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Book-Stock&cat=" . $cat . "'>";
}
if (isset($_POST['btnBookHistory'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Book-History&cat=" . $cat . "&date=" . $date . "&date2=" . $date2 . "'>";
}
if (isset($_POST['btnActivityUser'])) {
  echo "<meta http-equiv='refresh' content='0; url=?page=Activity-User&branch=" . $branch . "&division=" . $division . "&department=" . $department . "&unit=" . $unit . "&date=" . $date . "&date2=" . $date2 . "'>";
}
