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
            <div class="card-tools pull-right">
                <a href="<?= site_url('dashboard/add_user') ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="box">
                <div class="box-body table-responsive">
                    <!--  -->
                    <table id="table2" class="table table-hover table-striped display nowrap" name="user_table">
                        <thead class="table table-bordered">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role Account</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <script>
                                    $(document).ready(function() {
                                        $('#table2').DataTable({
                                            "processing": true,
                                            "serverSide": true,
                                            "ajax": {
                                                "url": "<?= site_url('data_user/get_ajax') ?>",
                                                "type": "POST",
                                            },
                                            "scrollY": 200,
                                            "scroller": {
                                                loadingIndicator: true,
                                            },
                                            "deferRender": true,
                                            "responsive": true,
                                        });
                                    });
                                </script>
                            </tr>
                        </tbody>
                    </table>
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