<?= $this->extend('admin/layout/base') ?>

<?= $this->section('main') ?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $page_title ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $page_title ?>
                        </li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-8 ">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">  <?= $page_title ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="<?=site_url(ADMIN."edit_save/$user[id]")?>" method="post"> 
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?=set_value('username', isset($user['username']) ? esc($user['username']) : '') ?>" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" value="<?=set_value('email', isset($user['email']) ? esc($user['email']) : '') ?>" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" >
                                    </div>
                                 

                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="number"value="<?=set_value('mobile', isset($user['mobile']) ? esc($user['mobile']) : '') ?>" class="form-control" id="mobile" name="mobile" >
                                    </div>

                                    <div class="mb-3">
                                    <label for="user" class="form-label">Select User</label>
                                        <select name="user" class="form-select" id="validationCustom04" required>
                                           <option value="accoun" <?=getPermissionByUserId($user['id']) === "accoun" ? "selected":"" ?> >Accountant</option>
                                           <option value="stud"<?=getPermissionByUserId($user['id']) === "stud" ? "selected":"" ?>>Student</option>
                                         </select>
                                      
                                    </div>

                                </div> <!--end::Body--> 
                                <!--begin::Footer-->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary" >Reset</button>
                                </div>
                                <!--end::Footer-->
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

<?= $this->endSection() ?>
