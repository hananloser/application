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
        <div class="card-header">
            <a href="<?= site_url('data/export_excel') ?>" class="btn btn-success btn-flat">
                <i class="fas fa-file-excel"></i> Export All Data
            </a>
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default">
                <i class="fas fa-file-excel"></i> Export With Date Filtering
            </button>
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default-2">
                <i class="fas fa-file-excel"></i> Export By User Uploaded
            </button>
            <button type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default-3">
                <i class="fas fa-file-excel"></i> Export By campaign ID
            </button>
        </div>
        <div class="card-body">
            <div class="box">
                <div class="box-body table-responsive">
                    <!--  -->
                    <table id="table1" class="table table-hover table-striped display nowrap" name="user_table" style="width:100%">
                        <thead>
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
                            <tr>
                                <script>
                                    $(document).ready(function() {
                                        $('#table1').DataTable({
                                            "processing": true,
                                            "serverSide": true,
                                            "pageLength" : 25,
                                            "ajax": {
                                                "url": "<?= site_url('upload/get_ajax') ?>",
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
<!-- /.modal -->
<div class="modal fade" id="modal-default-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export Data With User filter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('data/export_excel_by_user') ?>" method="post">
                    <div class="input-group">
                        <select class="custom-select" id="S
                        electOption" name="value">
                            <?php
                            $tempArr = array_unique(array_column($row, 'Uploaded_By'));
                            $arr = array_intersect_key($row, $tempArr);
                            foreach ($arr as $a) { ?>
                                # code...
                                <option value="<?php echo $a->Uploaded_By ?>"><?php echo $a->Uploaded_By ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Export</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- /.modal -->
<div class="modal fade" id="modal-default-3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export Data With Camp ID Filter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('data/export_excel_by_campaign_ID') ?>" method="post">
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04" name="value">
                            <?php
                            // $row = array_unique($row);
                            foreach ($row as $u) { ?>
                                # code...
                                <option value="<?php echo $u->Campaign_ID ?>"><?php echo $u->Campaign_ID ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Export</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->