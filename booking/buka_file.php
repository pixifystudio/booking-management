<?php
 error_reporting(0);
// include "main_maintenance.php";
// exit;
# KONTROL MENU PROGRAM
if ($_GET) {
  // Jika mendapatkan variabel URL ?page
  switch ($_GET['page']) {
    case '':
      if (!file_exists("booking.php")) die("Empty Main Page!");
      include "booking.php";
      break;


    case 'Main':
      if (!file_exists("index.php")) die("Sorry Empty Page!");
      include "index.php";
      break;

    case 'Greeting':
      if (!file_exists("greeting.php")) die("Sorry Empty Page!");
      include "greeting.php";
      break;

# Booking ======================================

    case 'Booking':
      if (!file_exists("booking.php")) die("Empty Main Page!");
      include "booking.php";
      break;

    case 'Booking-Process':
      if (!file_exists("booking_process.php")) die("Sorry Empty Page!");
      include "booking_process.php";
      break;

    case 'Booking-Success':
      if (!file_exists("booking_success.php")) die("Sorry Empty Page!");
      include "booking_success.php";
      break;

    case 'Booking-Cancel':
      if (!file_exists("booking_cancel.php")) die("Sorry Empty Page!");
      include "booking_cancel.php";
      break;


    case 'Booking-Notification':
      if (!file_exists("notification_30menitbooking.php")) die("Sorry Empty Page!");
      include "notification_30menitbooking.php";
      break;

      # Booking ======================================

    case 'Test-Booking':
      if (!file_exists("test_booking.php")) die("Empty Main Page!");
      include "test_booking.php";
      break;

    case 'Test-Booking-Process':
      if (!file_exists("test_booking_process.php")) die("Sorry Empty Page!");
      include "test_booking_process.php";
      break;

    case 'Test-Booking-Success':
      if (!file_exists("test_booking_success.php")) die("Sorry Empty Page!");
      include "test_booking_success.php";
      break;





      
    default:
      if (isset($_SESSION['SES_ADMIN'])) {
        if (!file_exists("main.php")) die("Sorry Empty Page!");
        include "main.php";
        break;
      }
      if (isset($_SESSION['SES_USER'])) {
        if (!file_exists("main_user.php")) die("Sorry Empty Page!");
        include "main_user.php";
        break;
      }
      break;
  }
} else {
  // Jika tidak mendapatkan variabel URL : ?page
  if (!file_exists("booking.php")) die("Empty Main Page! Under Development");
  include "booking.php";
}
