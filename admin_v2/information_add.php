<?php
$_SESSION['SES_TITLE'] = "Organization";
include_once "library/inc.seslogin.php";
include "header_difan.php";
$_SESSION['SES_PAGE'] = "?page=Organization";
?>
<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-12 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Add Organization</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="index.html">Master Data</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Organization</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Organization Add</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- Bootstrap Validation -->
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Bootstrap Validation</h4>
        </div>
        <div class="card-body">
          <form class="needs-validation" novalidate>
            <div class="mb-1">
              <label class="form-label" for="basic-addon-name">Name</label>

              <input type="text" id="basic-addon-name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon-name" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your name.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-email1">Email</label>
              <input type="email" id="basic-default-email1" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe@email.com" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter a valid email</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="basic-default-password1">Password</label>
              <input type="password" id="basic-default-password1" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your password.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="bsDob">DOB</label>
              <input type="text" class="form-control picker" name="dob" id="bsDob" required />
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please enter your date of birth.</div>
            </div>
            <div class="mb-1">
              <label class="form-label" for="select-country1">Country</label>
              <select class="form-select" id="select-country1" required>
                <option value="">Select Country</option>
                <option value="usa">USA</option>
                <option value="uk">UK</option>
                <option value="france">France</option>
                <option value="australia">Australia</option>
                <option value="spain">Spain</option>
              </select>
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">Please select your country</div>
            </div>
            <div class="mb-1">
              <label for="customFile1" class="form-label">Profile pic</label>
              <input class="form-control" type="file" id="customFile1" required />
            </div>
            <div class="mb-1">
              <label class="form-label" class="d-block">Gender</label>
              <div class="form-check my-50">
                <input type="radio" id="validationRadio3" name="validationRadioBootstrap" class="form-check-input" required />
                <label class="form-check-label" for="validationRadio3">Male</label>
              </div>
              <div class="form-check">
                <input type="radio" id="validationRadio4" name="validationRadioBootstrap" class="form-check-input" required />
                <label class="form-check-label" for="validationRadio4">Female</label>
              </div>
            </div>
            <div class="mb-1">
              <label for="validationCustomUsername" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required />
                <div class="invalid-feedback">Please choose a username.</div>
              </div>
            </div>
            <div class="mb-1">
              <label class="d-block form-label" for="validationBioBootstrap">Bio</label>
              <textarea class="form-control" id="validationBioBootstrap" name="validationBioBootstrap" rows="3" required></textarea>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="validationCheckBootstrap" required />
                <label class="form-check-label" for="validationCheckBootstrap">Agree to our terms and conditions</label>
                <div class="invalid-feedback">You must agree before submitting.</div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- /Bootstrap Validation -->

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