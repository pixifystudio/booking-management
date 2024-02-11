<?php
$_SESSION['SES_LOGIN'] = '';
$_SESSION['SES_USERID'] = '';
$_SESSION['SES_NAMA'] = '';
$_SESSION['SES_PHOTO'] = '';
$_SESSION['SES_BRANCH'] = '';
$_SESSION['SES_GROUP'] = '';
session_unset();
session_destroy();
echo "<meta http-equiv='refresh' content='0; url=?page=Login'>";
exit;
