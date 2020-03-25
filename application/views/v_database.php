<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ADMIN / All Data </h1>
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
        <!--hapus-->
        <!--<div class="card-header">
            <a href="<?= site_url('data/export_excel') ?>" class="btn btn-success btn-flat">
                <i class="fas fa-file-excel"></i> Excell
            </a>
        </div>-->
        <div class="card-header">
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-file-excel"></i> Export To Excell
            </button>
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
                                <th scope="col">Uploaded By</th>
                                <th scope="col">Uploaded At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($row as $u) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?>.</th>
                                    <td><?php echo $u->Company_Name ?></td>
                                    <td><?php echo $u->First_Name ?></td>
                                    <td><?php echo $u->Last_Name ?></td>
                                    <td><?php echo $u->Valid_Check ?></td>
                                    <td><?php echo $u->Uploaded_By ?></td>
                                    <td><?php echo date('d F Y', strtotime($u->Created_At)) ?></td>
                                    <td>
                                        <form action="<?= site_url('data/del_process') ?>" method="post">
                                            <a href="<?= site_url('data/edit_database/' . $u->ID) ?>" class="btn btn-primary btn-flat">
                                                <i class="fas fa-pen-alt"></i>
                                            </a>
                                            <input type="hidden" name="id" value="<?= $u->ID ?>">
                                            <button class="btn btn-danger btn-flat">
                                                <i class="fas fa-trash-alt"></i>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('data/export_excel_by_date') ?>" method="post">
                    <table>
                        <tr>
                            <td>
                                <div class="form_group">FROM</div>
                            </td>
                            <td> : </td>
                            <td align="center" width="5%">
                                <div class="form_group">
                                    <input type="date" class="form-control" name="tgl_a" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form_group">TO</div>
                            </td>
                            <td> : </td>
                            <td align="center" width="5%">
                                <div class="form_group">
                                    <input type="date" class="form-control" name="tgl_b" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <button type="submit" name="cetak" class="btn btn-blue-grey btn-flat mt-3"><i class="fas fa-file-excel"></i> FILTER</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class=" modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <a href="<?= site_url('data/export_excel') ?>" class="btn btn-success btn-flat">
                    <i class="fas fa-file-excel"></i> Export All Data
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->