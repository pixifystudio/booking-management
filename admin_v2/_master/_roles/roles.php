<?php
include_once "library/inc.seslogin.php";
include "header_difan.php";
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
                  <h2 class="content-header-title float-start mb-0">User Management</h2>
                  <div class="breadcrumb-wrapper">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a>Roles Permission</a>
                        </li>
                        <li class="breadcrumb-item"><a>Roles</a>
                        </li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>

      </div>

      <div class="content-body">
         <div class="row">
            <?php
            $head_menuQ = mysqli_query($koneksidb, "SELECT * FROM master_menu where parent_id = 0 order by menu_ordinal");
            while ($head_menu = mysqli_fetch_array($head_menuQ)) {
               $parentID   = $head_menu['menu_id'];
            ?>
               <div class="col-md-12 col-12">
                  <div class="col-md-12 col-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                              <div class="role-heading">
                                 <h4 class="fw-bolder"><?= $head_menu['menu_title']; ?></h4>
                                 <a href="?page=Role-Permission-Edit&id=<?= $head_menu['menu_id']; ?>&id2=<?= $head_menu['menu_title']; ?>" target="_BLANK">
                                    <small class="fw-bolder">Edit Role</small>
                                 </a>
                              </div>
                           </div>
                        </div>
                        <?php
                        $sub_menuQ = mysqli_query($koneksidb, "SELECT * FROM master_menu where parent_id = $parentID order by menu_ordinal");
                        while ($sub_menu = mysqli_fetch_array($sub_menuQ)) {
                           $parentID2   = $sub_menu['menu_id'];
                        ?>
                           <div class="card-body">
                              <div class="d-flex justify-content-between align-items-end pt-25" style="margin-top: -40px;">
                                 <div class="role-heading " style="margin-left: 30px;">
                                    <h4 class="fw-bolder"><?= $sub_menu['menu_title']; ?></h4>
                                    <a href="?page=Role-Permission-Edit&id=<?= $sub_menu['menu_id']; ?>&id2=<?= $sub_menu['menu_title']; ?>" target="_BLANK">
                                       <small class="fw-bolder">Edit Role </small>
                                    </a>
                                 </div>
                              </div>
                           </div>
                           <?php
                           $sub_menu2Q = mysqli_query($koneksidb, "SELECT * FROM master_menu where parent_id = $parentID2 order by menu_ordinal");

                           while ($sub_menu2 = mysqli_fetch_array($sub_menu2Q)) {
                           ?>
                              <div class="card-body">
                                 <div class="d-flex justify-content-between align-items-end pt-25" style="margin-top: -40px;">
                                    <div class="role-heading " style="margin-left: 60px;">
                                       <h4 class="fw-bolder"><?= $sub_menu2['menu_title']; ?></h4>
                                       <a href="?page=Role-Permission-Edit&id=<?= $sub_menu2['menu_id']; ?>&id2=<?= $sub_menu2['menu_title']; ?>" target="_BLANK">
                                          <small class="fw-bolder">Edit Role </small>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                        <?php }
                        } ?>

                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<!-- END: Content-->
<script>
   $('#editRoleModal').on('show.bs.modal', function(e) {
      var userid = $(e.relatedTarget).data('userid');
      var username = $(e.relatedTarget).data('username');
      $(e.currentTarget).find('input[name="user_group"]').val(username);
      $(e.currentTarget).find('input[name="user_group"]').val(userid);
   });
</script>
<?php
include "footer_difan.php";
?>