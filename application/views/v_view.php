<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin / View List DATABASE</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View List</li>
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
                <button class="btn note-btn-primary">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box">
                <div class="box-body table-responsive">
                    <!--  -->
                    <table id="table" class="table table-hover table-striped" name="user_table">
                        <thead class="table table-bordered">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Token</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($row as $u) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $u->Company_Name ?></td>
                                    <td><?php echo $u->First_Name ?></td>
                                    <td><?php echo $u->Last_Name ?></td>
                                    <td><?php echo $u->Valid_Check ?></td>
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