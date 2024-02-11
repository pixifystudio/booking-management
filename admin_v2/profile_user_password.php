<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_user.php";
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
            <h2 class="content-header-title float-start mb-0">Password</h2>
            <div class="breadcrumb-wrapper">
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="content-body">
      <div class='row'>
        <div class="col-5 col-sm-3 mb-1">
        </div>
        <div class="col-12 col-sm-12 mb-1">
          <!-- profile -->
          <div class="card">
            <div class="card-header border-bottom">
            </div>
            <div class="card-body py-2 my-25">
              <!-- header section -->
              <div class="d-flex">
                <a href="#" class="me-25">
                  <img src="../app-assets/images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                </a>
                <!-- upload and reset button -->
                <div class="d-flex align-items-end mt-75 ms-1">
                  <div>
                    <label for="account-upload" class="btn btn-sm btn-danger mb-75 me-75">Ubah Foto Profil</label>
                    <input type="file" id="account-upload" hidden accept="image/*" />
                    <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                    <p class="mb-0">Hanya diperbolehkan format JPG, JPEG, dan PNG. Maksimal size 1 Mb</p>
                  </div>
                </div>
                <!--/ upload and reset button -->
              </div>
              <!--/ header section -->

              <!-- form -->
              <form class="validate-form mt-2 pt-50">
                <div class="row">
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountFirstName">Nama Lengkap</label>
                    <input type="text" class="form-control" id="accountFirstName" name="firstName" placeholder="John" value="John" data-msg="Please enter first name" />
                  </div>
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountLastName">Jabatan</label>
                    <input type="text" class="form-control" id="accountLastName" name="lastName" placeholder="Jabatan" value="" data-msg="Please enter last name" />
                  </div>
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountEmail">Tempat Lahir</label>
                    <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="" />
                  </div>
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountOrganization">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="accountOrganization" name="organization" placeholder="Organization name" value="PIXINVENT" />
                  </div>
                  <div class="col-12 col-sm-6 mb-1">
                    <label class="form-label" for="accountPhoneNumber">Tanggal Bergabung</label>
                    <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="phoneNumber" placeholder="Phone Number" value="2022-10-14" readonly />
                  </div>


                </div>
              </form>
              <!--/ form -->
            </div>
          </div>
          <center>
            <div class="col-6">
              <button type="submit" class="btn btn-warning mt-1 me-1">Simpan Perubahan</button>
              <a href="?page=Main-User" type="reset" class="btn btn-outline-secondary mt-1">Batalkan </a>
            </div>
          </center>



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
include "footer_user.php";
?>