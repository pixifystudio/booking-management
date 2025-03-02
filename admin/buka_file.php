<?php

// include "main_maintenance.php";
// exit;
# KONTROL MENU PROGRAM
if ($_GET) {
  // Jika mendapatkan variabel URL ?page
  switch ($_GET['page']) {
    case '':
      if (!file_exists("login.php")) die("Empty Main Page!");
      include "login.php";
      break;

    case 'Main':
      if (!file_exists("index.php")) die("Sorry Empty Page!");
      include "index.php";
      break;

    case 'Login':
      if (!file_exists("login.php")) die("Sorry Empty Page!");
      include "login.php";
      break;

    case 'Logout':
      if (!file_exists("logout.php")) die("Sorry Empty Page!");
      include "logout.php";
      break;

    case 'Login-Validasi':
      if (!file_exists("login_validasi.php")) die("Sorry Empty Page!");
      include "login_validasi.php";
      break;

      #MANAGEMENT

    case 'Management-Booking':
      if (!file_exists("management_booking.php")) die("Sorry Empty Page!");
      include "management_booking.php";
      break;

    case 'Test-Management-Booking':
      if (!file_exists("test_management_booking.php")) die("Sorry Empty Page!");
      include "test_management_booking.php";
      break;

    case 'Management-Booking-Update':
      if (!file_exists("management_booking_update.php")) die("Sorry Empty Page!");
      include "management_booking_update.php";
      break;

    case 'Management-Booking-Process':
      if (!file_exists("management_booking_process.php")) die("Sorry Empty Page!");
      include "management_booking_process.php";
      break;


    case 'Management-Booking-Gdrive':
      if (!file_exists("management_booking_gdrive.php")) die("Sorry Empty Page!");
      include "management_booking_gdrive.php";
      break;

    case 'Management-Booking-Process-Detail':
      if (!file_exists("management_booking_process_detail.php")) die("Sorry Empty Page!");
      include "management_booking_process_detail.php";
      break;

    case 'Management-Booking-QR':
      if (!file_exists("management_booking_qr.php")) die("Sorry Empty Page!");
      include "management_booking_qr.php";
      break;


    case 'Management-Booking-QR-Add':
      if (!file_exists("management_booking_qr_add.php")) die("Sorry Empty Page!");
      include "management_booking_qr_add.php";
      break;

    case 'Management-Booking-QR-Delete':
      if (!file_exists("management_booking_qr_delete.php")) die("Sorry Empty Page!");
      include "management_booking_qr_delete.php";
      break;

    case 'Management-Booking-QR-Detail':
      if (!file_exists("management_booking_qr_detail.php")) die("Sorry Empty Page!");
      include "management_booking_qr_detail.php";
      break;
    
      case 'Management-Booking-QR-Process':
      if (!file_exists("management_booking_qr_process.php")) die("Sorry Empty Page!");
      include "management_booking_qr_process.php";
      break;

    case 'Management-Booking-Process-Detail-Delete':
      if (!file_exists("management_booking_process_detail_delete.php")) die("Sorry Empty Page!");
      include "management_booking_process_detail_delete.php";
      break;
    case 'Management-Booking-Process-Detail-View':
      if (!file_exists("management_booking_process_detail_view.php")) die("Sorry Empty Page!");
      include "management_booking_process_detail_view.php";
      break;

    case 'Management-Booking-Process-Print':
      if (!file_exists("management_booking_process_print.php")) die("Sorry Empty Page!");
      include "management_booking_process_print.php";
      break;

    case 'Management-Booking-Rescheduled':
      if (!file_exists("management_booking_rescheduled.php")) die("Sorry Empty Page!");
      include "management_booking_rescheduled.php";
      break;

    case 'Management-Booking-Delete':
      if (!file_exists("management_booking_delete.php")) die("Sorry Empty Page!");
      include "management_booking_delete.php";
      break;

    case 'Management-Booking-Cancel':
      if (!file_exists("management_booking_cancel.php")) die("Sorry Empty Page!");
      include "management_booking_cancel.php";
      break;

    case 'Panggil-Data':
      if (!file_exists("app-assets/data/data_booking.php")) die("Sorry Empty Page!");
      include "app-assets/data/data_booking.php";
      break;
      

    case 'Management-History':
      if (!file_exists("management_history.php")) die("Sorry Empty Page!");
      include "management_history.php";
      break;

    case 'Management-Admin':
      if (!file_exists("management_admin.php")) die("Sorry Empty Page!");
      include "management_admin.php";
      break;

      #MASTER

    case 'Master-Jadwal':
      if (!file_exists("master_jadwal.php")) die("Sorry Empty Page!");
      include "master_jadwal.php";
      break;

    case 'Master-Product':
      if (!file_exists("master_product.php")) die("Sorry Empty Page!");
      include "master_product.php";
      break;

    case 'Master-Jadwal-Update-Status':
      if (!file_exists("master_jadwal_update_status.php")) die("Sorry Empty Page!");
      include "master_jadwal_update_status.php";
      break;

    case 'Master-Jadwal-Add':
      if (!file_exists("master_jadwal_add.php")) die("Sorry Empty Page!");
      include "master_jadwal_add.php";
      break;

    case 'Master-Jadwal-Edit':
      if (!file_exists("master_jadwal_edit.php")) die("Sorry Empty Page!");
      include "master_jadwal_edit.php";
      break;

    case 'Master-Jadwal-Delete':
      if (!file_exists("master_jadwal_delete.php")) die("Sorry Empty Page!");
      include "master_jadwal_delete.php";
      break;


      #MASTER Jadwal Hari

    case 'Master-Jadwal-Hari':
      if (!file_exists("master_jadwal_hari.php")) die("Sorry Empty Page!");
      include "master_jadwal_hari.php";
      break;

    case 'Master-Jadwal-Hari-Update-Status':
      if (!file_exists("master_jadwal_hari_update_status.php")) die("Sorry Empty Page!");
      include "master_jadwal_hari_update_status.php";
      break;

    case 'Master-Jadwal-Hari-Add':
      if (!file_exists("master_jadwal_hari_add.php")) die("Sorry Empty Page!");
      include "master_jadwal_hari_add.php";
      break;

    case 'Master-Jadwal-Hari-Edit':
      if (!file_exists("master_jadwal_hari_edit.php")) die("Sorry Empty Page!");
      include "master_jadwal_hari_edit.php";
      break;

    case 'Master-Jadwal-Hari-Delete':
      if (!file_exists("master_jadwal_hari_delete.php")) die("Sorry Empty Page!");
      include "master_jadwal_hari_delete.php";
      break;

      # MASTER JENIS

    case 'Master-Jenis':
      if (!file_exists("master_jenis.php")) die("Sorry Empty Page!");
      include "master_jenis.php";
      break;

    case 'Master-Jenis-Add':
      if (!file_exists("master_jenis_add.php")) die("Sorry Empty Page!");
      include "master_jenis_add.php";
      break;

    case 'Master-Jenis-Edit':
      if (!file_exists("master_jenis_edit.php")) die("Sorry Empty Page!");
      include "master_jenis_edit.php";
      break;

    case 'Master-Jenis-Delete':
      if (!file_exists("master_jenis_delete.php")) die("Sorry Empty Page!");
      include "master_jenis_delete.php";
      break;

      # MASTER PAKET

    case 'Master-Paket':
      if (!file_exists("master_paket.php")) die("Sorry Empty Page!");
      include "master_paket.php";
      break;

    case 'Master-Paket-Add':
      if (!file_exists("master_paket_add.php")) die("Sorry Empty Page!");
      include "master_paket_add.php";
      break;

    case 'Master-Paket-Edit':
      if (!file_exists("master_paket_edit.php")) die("Sorry Empty Page!");
      include "master_paket_edit.php";
      break;

    case 'Master-Paket-Delete':
      if (!file_exists("master_paket_delete.php")) die("Sorry Empty Page!");
      include "master_paket_delete.php";
      break;

      # MASTER BACKGROUND

    case 'Master-Background':
      if (!file_exists("master_background.php")) die("Sorry Empty Page!");
      include "master_background.php";
      break;

    case 'Master-Background-Add':
      if (!file_exists("master_background_add.php")) die("Sorry Empty Page!");
      include "master_background_add.php";
      break;

    case 'Master-Background-Edit':
      if (!file_exists("master_background_edit.php")) die("Sorry Empty Page!");
      include "master_background_edit.php";
      break;

    case 'Master-Background-Delete':
      if (!file_exists("master_background_delete.php")) die("Sorry Empty Page!");
      include "master_background_delete.php";
      break;


      #Master User

    case 'Master-User':
      if (!file_exists("master_user.php")) die("Sorry Empty Page!");
      include "master_user.php";
      break;

    case 'Master-User-Add':
      if (!file_exists("master_user_add.php")) die("Sorry Empty Page!");
      include "master_user_add.php";
      break;

    case 'Master-User-Edit':
      if (!file_exists("master_user_edit.php")) die("Sorry Empty Page!");
      include "master_user_edit.php";
      break;

    case 'Master-User-Delete':
      if (!file_exists("master_user_delete.php")) die("Sorry Empty Page!");
      include "master_user_delete.php";
      break;


      #Master Product

    case 'Master-Product':
      if (!file_exists("master_product.php")) die("Sorry Empty Page!");
      include "master_product.php";
      break;

    case 'Master-Product-Add':
      if (!file_exists("master_product_add.php")) die("Sorry Empty Page!");
      include "master_product_add.php";
      break;

    case 'Master-Product-Edit':
      if (!file_exists("master_product_edit.php")) die("Sorry Empty Page!");
      include "master_product_edit.php";
      break;

    case 'Master-Product-Delete':
      if (!file_exists("master_product_delete.php")) die("Sorry Empty Page!");
      include "master_product_delete.php";
      break;

    case 'Master-Product-Price':
      if (!file_exists("master_product_price.php")) die("Sorry Empty Page!");
      include "master_product_price.php";
      break;

    case 'Master-Product-Price-Edit':
      if (!file_exists("master_product_price_edit.php")) die("Sorry Empty Page!");
      include "master_product_price_edit.php";
      break;

    case 'Master-Product-Stock':
      if (!file_exists("master_product_stock.php")) die("Sorry Empty Page!");
      include "master_product_stock.php";
      break;

    case 'Master-Product-Stock-Adjustment':
      if (!file_exists("master_product_stock_adjustment.php")) die("Sorry Empty Page!");
      include "master_product_stock_adjustment.php";
      break;

      


    case 'Input-Pengeluaran':
      if (!file_exists("input_pengeluaran.php")) die("Sorry Empty Page!");
      include "input_pengeluaran.php";
      break;


    case 'Kas':
      if (!file_exists("kas.php")) die("Sorry Empty Page!");
      include "kas.php";
      break;

    case 'Dashboard':
      if (!file_exists("dashboard.php")) die("Sorry Empty Page!");
      include "dashboard.php";
      break;



    case 'Input-Pengeluaran-Add':
      if (!file_exists("input_pengeluaran_add.php")) die("Sorry Empty Page!");
      include "input_pengeluaran_add.php";
      break;


    case 'Input-Pemasukkan-Add':
      if (!file_exists("input_pemasukkan_add.php")) die("Sorry Empty Page!");
      include "input_pemasukkan_add.php";
      break;

   case 'Pindah-Nominal':
      if (!file_exists("pindah_nominal.php")) die("Sorry Empty Page!");
      include "pindah_nominal.php";
      break;








      # Master 
    case 'Master-Kategori':
      if (!file_exists("master_kategori.php")) die("Sorry Empty Page!");
      include "master_kategori.php";
      break;

      #VALIDASI


    case 'Validasi':
      if (!file_exists("validasi.php")) die("Sorry Empty Page!");
      include "validasi.php";
      break;

      #LUPA PASSWORD
    case 'Forgot-Password':
      if (!file_exists("lupa_password.php")) die("Sorry Empty Page!");
      include "lupa_password.php";
      break;
    case 'Forgot-Password-Validasi':
      if (!file_exists("lupa_password_validasi.php")) die("Sorry Empty Page!");
      include "lupa_password_validasi.php";
      break;

      # PRINT STRUK

    case 'Print-Struk':
      if (!file_exists("print_struk.php")) die("Sorry Empty Page!");
      include "print_struk.php";
      break;

    case 'Print-Struk-Non':
      if (!file_exists("print_struk_non.php")) die("Sorry Empty Page!");
      include "print_struk_non.php";
      break;

      # FINANCE

    case 'Finance-Laporan-Transaksi':
      if (!file_exists("finance_laporan_transaksi.php")) die("Sorry Empty Page!");
      include "finance_laporan_transaksi.php";
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
  if (!file_exists("login.php")) die("Empty Main Page! Under Development");
  include "login.php";
}
