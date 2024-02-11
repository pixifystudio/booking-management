<?php

$dataGroup = isset($_SESSION['SES_GROUP']) ? $_SESSION['SES_GROUP'] : '';

# KONTROL MENU PROGRAM
if ($_GET) {
	if ($dataGroup == 'USER') {
		$mySql = "SELECT * FROM master_menu  WHERE menu_link='" . $_GET['page'] . "'";
		$myQry = mysqli_query($koneksidb, $mySql) or die("Query Salah : " . mysqli_error($koneksidb));
		$myData = mysqli_fetch_array($myQry);
		if (mysqli_num_rows($myQry) > 0) {
			die("Sorry Page is Blocked!");
		}
	}
	$halaman = '';
	// Jika mendapatkan variabel URL ?page
	switch ($_GET['page']) {
		case '':
			if (!file_exists("login.php")) die("Empty Main Page!");
			include "login.php";
			break;
		case 'Main':
			if (!file_exists("main.php")) die("Sorry Empty Page!");
			include "main.php";
			break;
		case 'Main-Digital':
			if (!file_exists("main_digital.php")) die("Sorry Empty Page!");
			include "main_digital.php";
			break;
		case 'Main-User':
			if (!file_exists("main_user.php")) die("Sorry Empty Page!");
			include "main_user.php";
			break;
		case 'Login':
			if (!file_exists("login.php")) die("Sorry Empty Page!");
			include "login.php";
			break;
		case 'Login-Validasi':
			if (!file_exists("login_validasi.php")) die("Sorry Empty Page!");
			include "login_validasi.php";
			break;
		case 'Logout':
			if (!file_exists("login_out.php")) die("Sorry Empty Page!");
			include "login_out.php";
			break;
		case 'Login-Failed':
			if (!file_exists("login_failed.php")) die("Sorry Empty Page!");
			include "login_failed.php";
			break;
		case 'Help':
			if (!file_exists("help.php")) die("Sorry Empty Page!");
			include "help.php";
			break;
		case 'Setting':
			if (!file_exists("setting.php")) die("Sorry Empty Page!");
			include "setting.php";
			break;
		case 'Profile':
			if (!file_exists("profile.php")) die("Sorry Empty Page!");
			include "profile.php";
			break;
		case 'Profile-User':
			if (!file_exists("profile_user.php")) die("Sorry Empty Page!");
			include "profile_user.php";
			break;
		case 'Profile-User-Password':
			if (!file_exists("profile_user_password.php")) die("Sorry Empty Page!");
			include "profile_user_password.php";
			break;


			// Book Management
		case 'Asset-Management-Physical':
			if (!file_exists("_book_physical/asset_management.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management.php";
			break;
		case 'Asset-Management-Physical-Print':
			if (!file_exists("_book_physical/asset_management_print.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_print.php";
			break;
		case 'Asset-Management-Physical-Add':
			if (!file_exists("_book_physical/asset_management_add.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_add.php";
			break;
		case 'Asset-Management-Physical-Edit':
			if (!file_exists("_book_physical/asset_management_edit.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_edit.php";
			break;
		case 'Asset-Management-Physical-Delete':
			if (!file_exists("_book_physical/asset_management_delete.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_Delete.php";
			break;
		case 'Asset-Management-Physical-View':
			if (!file_exists("_book_physical/asset_management_view.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_view.php";
			break;
		case 'Asset-Management-Physical-Version':
			if (!file_exists("_book_physical/asset_management_version.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_version.php";
			break;
		case 'Asset-Management-Physical-Status':
			if (!file_exists("_book_physical/asset_management_status.php")) die("Sorry Empty Page!");
			include "_book_physical/asset_management_status.php";
			break;
		case 'Asset-Management-Physical-Revise':
			if (!file_exists("_book_physical/book_management_revise.php")) die("Sorry Empty Page!");
			include "_book_physical/book_management_revise.php";
			break;

		case 'Book-Management-Physical-Report':
			if (!file_exists("_book_physical/book_management_report.php")) die("Sorry Empty Page!");
			include "_book_physical/book_management_report.php";
			break;

			# ASSET MANAGEMENT STOCK	
		case 'Asset-Management-Physical-Stock':
			if (!file_exists("_book_physical/book_stock/stock_adjustment.php")) die("Sorry Empty Page!");
			include "_book_physical/book_stock/stock_adjustment.php";
			break;
		case 'Asset-Management-Physical-Stock-IN':
			if (!file_exists("_book_physical/book_stock/stock_adjustment_add_in.php")) die("Sorry Empty Page!");
			include "_book_physical/book_stock/stock_adjustment_add_in.php";
			break;
		case 'Asset-Management-Physical-Stock-OUT':
			if (!file_exists("_book_physical/book_stock/stock_adjustment_add_out.php")) die("Sorry Empty Page!");
			include "_book_physical/book_stock/stock_adjustment_add_out.php";
			break;

		case 'Asset-Management-Physical-Stock-Trans':
			if (!file_exists("_book_physical/book_stock/stock_adjustment_trans.php")) die("Sorry Empty Page!");
			include "_book_physical/book_stock/stock_adjustment_trans.php";
			break;

			# ASSET BORROW - RETURN
		case 'Asset-Management-Physical-Borrow':
			if (!file_exists("_book_physical/borrowing/asset_management_borrow.php")) die("Sorry Empty Page!");
			include "_book_physical/borrowing/asset_management_borrow.php";
			break;

		case 'Asset-Management-Physical-Return':
			if (!file_exists("_book_physical/borrowing/asset_management_return.php")) die("Sorry Empty Page!");
			include "_book_physical/borrowing/asset_management_return.php";
			break;

			// Book Management Digital
		case 'Content-Management-Digital':
			if (!file_exists("_book_digital/content_management_digital.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital.php";
			break;
		case 'Content-Management-Digital-Add':
			if (!file_exists("_book_digital/content_management_digital_add.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_add.php";
			break;
		case 'Content-Management-Digital-Edit':
			if (!file_exists("_book_digital/content_management_digital_edit.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_edit.php";
			break;
		case 'Content-Management-Digital-Delete':
			if (!file_exists("_book_digital/content_management_digital_delete.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_Delete.php";
			break;
		case 'Content-Management-Digital-View':
			if (!file_exists("_book_digital/content_management_digital_view.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_view.php";
			break;
		case 'Content-Management-Digital-Version':
			if (!file_exists("_book_digital/content_management_digital_version.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_version.php";
			break;
		case 'Content-Management-Digital-Status':
			if (!file_exists("_book_digital/content_management_digital_status.php")) die("Sorry Empty Page!");
			include "_book_digital/content_management_digital_status.php";
			break;
		case 'Content-Management-Digital-Revise':
			if (!file_exists("_book_digital/book_management_digital_revise.php")) die("Sorry Empty Page!");
			include "_book_digital/book_management_digital_revise.php";
			break;


			// Book Management
		case 'Content-Management-Expiry':
			if (!file_exists("_book_management/expiry/content_management_expiry.php")) die("Sorry Empty Page!");
			include "_book_management/expiry/content_management_expiry.php";
			break;
		case 'Book-Management-Revisied':
			if (!file_exists("_book_management/approval/book_management_revisied.php")) die("Sorry Empty Page!");
			include "_book_management/approval/book_management_revisied.php";
			break;
		case 'Content-Management-Approval':
			if (!file_exists("_book_management/approval/content_management_approval.php")) die("Sorry Empty Page!");
			include "_book_management/approval/content_management_approval.php";
			break;
		case 'Content-Management-Approval-Detail':
			if (!file_exists("_book_management/approval/content_management_approval_detail.php")) die("Sorry Empty Page!");
			include "_book_management/approval/content_management_approval_detail.php";
			break;
		case 'Content-Management-Access':
			if (!file_exists("_book_management/access/content_management_access.php")) die("Sorry Empty Page!");
			include "_book_management/access/content_management_access.php";
			break;
		case 'Content-Management-Grant-Access':
			if (!file_exists("_book_management/access/content_management_grant_access.php")) die("Sorry Empty Page!");
			include "_book_management/access/content_management_grant_access.php";
			break;
		case 'Content-Management-Grant-Access-Delete':
			if (!file_exists("_book_management/access/document_privileges_delete.php")) die("Sorry Empty Page!");
			include "_book_management/access/document_privileges_delete.php";
			break;

			// Visitor

		case 'Guest-Book':
			if (!file_exists("guest_book.php")) die("Sorry Empty Page!");
			include "guest_book.php";
			break;

		case 'Report-Visitor':
			if (!file_exists("report_library_visitor.php")) die("Sorry Empty Page!");
			include "report_library_visitor.php";
			break;


			// Report

		case 'Activity-User':
			if (!file_exists("_report/activity_user.php")) die("Sorry Empty Page!");
			include "_report/activity_user.php";
			break;
		case 'Asset-History':
			if (!file_exists("_report/book_history.php")) die("Sorry Empty Page!");
			include "_report/book_history.php";
			break;
		case 'Asset-Stock':
			if (!file_exists("_report/book_stock.php")) die("Sorry Empty Page!");
			include "_report/book_stock.php";
			break;


			// BUKU
		case 'Buku-Fisik':
			if (!file_exists("buku_fisik.php")) die("Sorry Empty Page!");
			include "buku_fisik.php";
			break;
		case 'Buku-Detail':
			if (!file_exists("buku_detail.php")) die("Sorry Empty Page!");
			include "buku_detail.php";
			break;
		case 'Buku-Bookmark':
			if (!file_exists("buku_bookmark.php")) die("Sorry Empty Page!");
			include "buku_bookmark.php";
			break;
		case 'Buku-Detail-View':
			if (!file_exists("buku_detail_view.php")) die("Sorry Empty Page!");
			include "buku_detail_view.php";
			break;
			// BUKU
		case 'Buku-Digital':
			if (!file_exists("buku_digital.php")) die("Sorry Empty Page!");
			include "buku_digital.php";
			break;
		case 'Buku-Digital-Detail':
			if (!file_exists("buku_digital_detail.php")) die("Sorry Empty Page!");
			include "buku_digital_detail.php";
			break;
		case 'Buku-Digital-Detail-View':
			if (!file_exists("buku_digital_detail_view.php")) die("Sorry Empty Page!");
			include "buku_digital_detail_view.php";
			break;
		case 'Digital-Signage':
			if (!file_exists("digital_signage.php")) die("Sorry Empty Page!");
			include "digital_signage.php";
			break;
		case 'Buku-Digital-Detail-Read':
			if (!file_exists("buku_digital_detail_read.php")) die("Sorry Empty Page!");
			include "buku_digital_detail_read.php";
			break;
		case 'Information-User':
			if (!file_exists("_master/information/information_user.php")) die("Sorry Empty Page!");
			include "_master/information/information_user.php";
			break;
		case 'Information-User-Detail':
			if (!file_exists("_master/information/information_user_detail.php")) die("Sorry Empty Page!");
			include "_master/information/information_user_detail.php";
			break;
		case 'Information-Read':
			if (!file_exists("_master/information/information_read.php")) die("Sorry Empty Page!");
			include "_master/information/information_read.php";
			break;
		case 'Information-Read-Admin':
			if (!file_exists("_master/information/information_read_admin.php")) die("Sorry Empty Page!");
			include "_master/information/information_read_admin.php";
			break;
		case 'Information-Edit':
			if (!file_exists("_master/information/information_edit.php")) die("Sorry Empty Page!");
			include "_master/information/information_edit.php";
			break;
		case 'Information-Delete':
			if (!file_exists("_master/information/information_delete.php")) die("Sorry Empty Page!");
			include "_master/information/information_delete.php";
			break;
		case 'Test':
			if (!file_exists("test.php")) die("Sorry Empty Page!");
			include "test.php";
			break;
		case 'Favourite':
			if (!file_exists("favourite.php")) die("Sorry Empty Page!");
			include "favourite.php";
			break;
		case 'Dashboard':
			if (!file_exists("dashboard.php")) die("Sorry Empty Page!");
			include "dashboard.php";
			break;
		case 'Lang-ID':
			if (!file_exists("lang_id.php")) die("Sorry Empty Page!");
			die;
			include "lang_id.php";
			break;
		case 'Lang-EN':
			if (!file_exists("lang_en.php")) die("Sorry Empty Page!");
			include "lang_en.php";
			break;
		case 'Validasi':
			if (!file_exists("validasi.php")) die("Sorry Empty Page!");
			include "validasi.php";
			break;

			# USER LOGIN (Admin, User)
		case 'User':
			if (!file_exists("user.php")) die("Sorry Empty Page!");
			include "user.php";
			break;
		case 'User-Add':
			if (!file_exists("user_add.php")) die("Sorry Empty Page!");
			include "user_add.php";
			break;
		case 'User-Delete':
			if (!file_exists("user_delete.php")) die("Sorry Empty Page!");
			include "user_delete.php";
			break;
		case 'User-Edit':
			if (!file_exists("user_edit.php")) die("Sorry Empty Page!");
			include "user_edit.php";
			break;
		case 'User-Log':
			if (!file_exists("user_log.php")) die("Sorry Empty Page!");
			include "user_log.php";
			break;


			# MASTER ORGANIZATION
		case 'Organization':
			if (!file_exists("_master/organization/organization.php")) die("Sorry Empty Page!");
			include "_master/organization/organization.php";
			break;
		case 'Organization-Add':
			if (!file_exists("_master/organization/organization_add.php")) die("Sorry Empty Page!");
			include "_master/organization/organization_add.php";
			break;
		case 'Organization-Delete':
			if (!file_exists("_master/organization/organization_delete.php")) die("Sorry Empty Page!");
			include "_master/organization/organization_delete.php";
			break;
		case 'Organization-Edit':
			if (!file_exists("_master/organization/organization_edit.php")) die("Sorry Empty Page!");
			include "_master/organization/organization_edit.php";
			break;

			# ROLE MANAGEMENT
		case 'Role-Permission':
			if (!file_exists("_master/_roles/roles.php")) die("Sorry Empty Page!");
			include "_master/_roles/roles.php";
			break;
		case 'Role-Permission-Edit':
			if (!file_exists("_master/_roles/roles_edit.php")) die("Sorry Empty Page!");
			include "_master/_roles/roles_edit.php";
			break;

			# MASTER CATEGORY
		case 'Content-Categories':
			if (!file_exists("_master/category/content_category.php")) die("Sorry Empty Page!");
			include "_master/category/content_category.php";
			break;
		case 'Content-Categories-Add':
			if (!file_exists("_master/category/content_category_add.php")) die("Sorry Empty Page!");
			include "_master/category/content_category_add.php";
			break;
		case 'Content-Categories-Delete':
			if (!file_exists("_master/category/content_category_delete.php")) die("Sorry Empty Page!");
			include "_master/category/content_category_delete.php";
			break;
		case 'Content-Categories-Edit':
			if (!file_exists("_master/category/content_category_edit.php")) die("Sorry Empty Page!");
			include "_master/category/content_category_edit.php";
			break;
		case 'Import-Category-Files':
			if (!file_exists("_master/category/import_category_files.php")) die("Sorry Empty Page!");
			include "_master/category/import_category_files.php";
			break;


			# MASTER BOOKSHELF
		case 'Bookshelf':
			if (!file_exists("_master/bookshelf/bookshelf.php")) die("Sorry Empty Page!");
			include "_master/bookshelf/bookshelf.php";
			break;
		case 'Bookshelf-Add':
			if (!file_exists("_master/bookshelf/bookshelf_add.php")) die("Sorry Empty Page!");
			include "_master/bookshelf/bookshelf_add.php";
			break;
		case 'Bookshelf-Delete':
			if (!file_exists("_master/bookshelf/bookshelf_delete.php")) die("Sorry Empty Page!");
			include "_master/bookshelf/bookshelf_delete.php";
			break;
		case 'Bookshelf-Edit':
			if (!file_exists("_master/bookshelf/bookshelf_edit.php")) die("Sorry Empty Page!");
			include "_master/bookshelf/bookshelf_edit.php";
			break;

		case 'Bookshelf-Files':
			if (!file_exists("_master/bookshelf/bookshelf_files.php")) die("Sorry Empty Page!");
			include "_master/bookshelf/bookshelf_files.php";
			break;
			# MASTER INFORMATION
		case 'Information':
			if (!file_exists("_master/information/information.php")) die("Sorry Empty Page!");
			include "_master/information/information.php";
			break;
		case 'Information-Add':
			if (!file_exists("_master/information/information_add.php")) die("Sorry Empty Page!");
			include "_master/information/information_add.php";
			break;
		case 'Information-Delete':
			if (!file_exists("_master/information/information_delete.php")) die("Sorry Empty Page!");
			include "_master/information/information_delete.php";
			break;
		case 'Information-Edit':
			if (!file_exists("_master/information/information_edit.php")) die("Sorry Empty Page!");
			include "_master/information/information_edit.php";
			break;


			# MANAGEMENT ADMIN
		case 'Management-Admin':
			if (!file_exists("_user/management_admin.php")) die("Sorry Empty Page!");
			include "_user/management_admin.php";
			break;
		case 'Management-Admin-Add':
			if (!file_exists("_user/management_admin_add.php")) die("Sorry Empty Page!");
			include "_user/management_admin_add.php";
			break;
		case 'Management-Admin-Delete':
			if (!file_exists("_user/management_admin_delete.php")) die("Sorry Empty Page!");
			include "_user/management_admin_delete.php";
			break;
		case 'Management-Admin-Edit':
			if (!file_exists("_user/management_admin_edit.php")) die("Sorry Empty Page!");
			include "_user/management_admin_edit.php";
			break;

			# MANAGEMENT USER
		case 'Management-User':
			if (!file_exists("_user/management_user.php")) die("Sorry Empty Page, under development!");
			include "_user/management_user.php";
			break;
		case 'Management-User-Add':
			if (!file_exists("_user/management_user_add.php")) die("Sorry Empty Page, under development!");
			include "_user/management_user_add.php";
			break;
		case 'Management-User-Delete':
			if (!file_exists("_user/management_user_delete.php")) die("Sorry Empty Page, under development!");
			include "_user/management_user_delete.php";
			break;
		case 'Management-User-Edit':
			if (!file_exists("_user/management_user_edit.php")) die("Sorry Empty Page, under development!");
			include "_user/management_user_edit.php";
			break;

			// 	# MANAGEMENT USER
			// case 'Management-Reward':
			// 	if (!file_exists("_reward/management_reward.php")) die("Sorry Empty Page, under development!");
			// 	include "_reward/management_reward.php";
			// 	break;

			# HOME
		case 'Filter':
			if (!file_exists("filter.php")) die("Sorry Empty Page!");
			include "filter.php";
			break;
		case 'Search':
			if (!file_exists("search.php")) die("Sorry Empty Page!");
			include "search.php";
			break;
		case 'Search-Admin':
			if (!file_exists("search_admin.php")) die("Sorry Empty Page!");
			include "search_admin.php";
			break;

			# DOCUMENT
		case 'Document':
			if (!file_exists("document.php")) die("Sorry Empty Page!");
			include "document.php";
			break;
		case 'Document-List':
			if (!file_exists("document_list.php")) die("Sorry Empty Page!");
			include "document_list.php";
			break;
		case 'Document-Detail':
			if (!file_exists("document_detail.php")) die("Sorry Empty Page!");
			include "document_detail.php";
			break;
		case 'Document-Detail-PDF':
			if (!file_exists("document_detail_pdf.php")) die("Sorry Empty Page!");
			include "document_detail_pdf.php";
			break;
		case 'Document-Viewer':
			if (!file_exists("document_viewer.php")) die("Sorry Empty Page!");
			include "document_viewer.php";
			break;
		case 'Document-Open':
			if (!file_exists("document_open.php")) die("Sorry Empty Page!");
			include "document_open.php";
			break;

		case 'Document-Favourite':
			if (!file_exists("document_favourite.php")) die("Sorry Empty Page!");
			include "document_favourite.php";
			break;
		case 'Document-Favourite-Add':
			if (!file_exists("document_favourite_add.php")) die("Sorry Empty Page!");
			include "document_favourite_add.php";
			break;
		case 'Document-Favourite-Delete':
			if (!file_exists("document_favourite_delete.php")) die("Sorry Empty Page!");
			include "document_favourite_delete.php";
			break;
		case 'Document-Denied':
			if (!file_exists("document_denied.php")) die("Sorry Empty Page!");
			include "document_denied.php";
			break;
		case 'Document-Open-Denied':
			if (!file_exists("document_open_denied.php")) die("Sorry Empty Page!");
			include "document_open_denied.php";
			break;

			// Position
		case 'Position':
			if (!file_exists("_master/position/position.php")) die("Sorry Empty Page!");
			include "_master/position/position.php";
			break;
		case 'Position-Add':
			if (!file_exists("_master/position/position_add.php")) die("Sorry Empty Page!");
			include "_master/position/position_add.php";
			break;
		case 'Position-Edit':
			if (!file_exists("_master/position/position_edit.php")) die("Sorry Empty Page!");
			include "_master/position/position_edit.php";
			break;
		case 'Position-Delete':
			if (!file_exists("_master/position/position_delete.php")) die("Sorry Empty Page!");
			include "_master/position/position_delete.php";
			break;

			// Reward
		case 'Management-Reward':
			if (!file_exists("_master/_reward/management_reward.php")) die("Sorry Empty Page!");
			include "_master/_reward/management_reward.php";
			break;
		case 'Management-Reward-Add':
			if (!file_exists("_master/_reward/management_reward_add.php")) die("Sorry Empty Page!");
			include "_master/_reward/management_reward_add.php";
			break;
		case 'Management-Reward-Edit':
			if (!file_exists("_master/_reward/management_reward_edit.php")) die("Sorry Empty Page!");
			include "_master/_reward/management_reward_edit.php";
			break;
		case 'Management-Reward-Delete':
			if (!file_exists("_master/_reward/management_reward_delete.php")) die("Sorry Empty Page!");
			include "_master/_reward/management_reward_delete.php";
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

		case 'Management-Booking-Delete':
			if (!file_exists("management_booking_delete.php")) die("Sorry Empty Page!");
			include "management_booking_delete.php";
			break;

		case 'Panggil-Data':
			if (!file_exists("app-assets/data/data_booking.php")) die("Sorry Empty Page!");
			include "app-assets/data/data_booking.php";
			break;


		case 'Management-History':
			if (!file_exists("management_history.php")) die("Sorry Empty Page!");
			include "management_history.php";
			break;

			#MASTER

		case 'Master-Jadwal':
			if (!file_exists("master_jadwal.php")) die("Sorry Empty Page!");
			include "master_jadwal.php";
			break;

		case 'Master-Kategori':
			if (!file_exists("master_kategori.php")) die("Sorry Empty Page!");
			include "master_kategori.php";
			break;






		default:
			if (isset($_SESSION['SES_ADMIN'])) {
				if (!file_exists("main.php")) die("Sorry Empty Page!");
				include "main.php";
				break;
			}
			if (isset($_SESSION['SES_USER'])) {
				if (!file_exists("main2.php")) die("Sorry Empty Page!");
				include "main2.php";
				break;
			}
			break;
	}
} else {
	// Jika tidak mendapatkan variabel URL : ?page
	if (!file_exists("login.php")) die("Empty Main Page! Under Development");
	include "login.php";
}
