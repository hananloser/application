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
                    <table id="table" class="table table-hover table-striped " name="user_table">
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
                            <?php $no = 1;
                            foreach ($row->result() as $data) { ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?>.</th>
                                    <td><?= $data->user_username ?></td>
                                    <td><?= $data->user_company_name ?></td>
                                    <td><?= $data->user_email ?></td>
                                    <td><?= $data->user_level == 1 ? "Admin" : "User" ?></td>
                                    <td>
                                        <form action="<?= site_url('data_user/del_process') ?>" method="post">
                                            <a href="<?= site_url('data_user/edit/' . $data->user_id) ?>" class="btn btn-primary">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <input type="hidden" name="user_id" value="<?= $data->user_id ?>">
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
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
</script>