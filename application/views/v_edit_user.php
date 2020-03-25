<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin / Manage User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3>EDIT USER FORM</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 offset-4">
                    <?php echo validation_errors(); ?>
                    <form action="<?= site_url('data_user/edit_process') ?>" method="post">
                        <div class="from-group">
                            <label for="user_username">USERNAME</label>
                            <input type="text" name="user_username" class="form-control" value="<?= $row['user_username']; ?>">
                        </div>
                        <div class="from-group">
                            <label for="user_email">EMAIL</label>
                            <input type="hidden" name="user_id" class="form-control" value="<?= $row['user_id']; ?>">
                            <input type="text" name="user_email" class="form-control" value="<?= $row['user_email']; ?>">
                        </div>
                        <div class=" from-group">
                            <label for="user_company_name">COMPANY NAME</label>
                            <input type="text" name="user_company_name" class="form-control" value="<?= $row['user_company_name']; ?>">
                        </div>
                        <div class="from-group">
                            <label for="user_password">PASSWORD</label>
                            <input type="text" name="user_password" class="form-control" value="<?= $row['user_password']; ?>">
                        </div>
                        <div class="from-group">
                            <label for="user_level">Level</label>
                            <input type="text" class="form-control" value="<?= $row['user_level'] == 1 ? "Admin" : "User" ?>" disabled>
                        </div>
                        <div class="from-group mt-3">
                            <button type="submit" class="btn btn-success btn-flat">Submit</button>
                            <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Page rendered in {elapsed_time} second
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<script>
    $(document).ready(function() {
        var data = [];
        for (var i = 0; i < 50000; i++) {
            data.push([i, i, i, i, i]);
        }

        $('#table').DataTable({
            data: data,
            deferRender: true,
            scrollY: 200,
            scrollCollapse: true,
            scroller: true
        });
    });
</script>s