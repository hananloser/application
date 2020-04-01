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

                    <table id="table3" class="table table-hover table-striped display nowrap" name="user_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Token</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <script>
                                    $(document).ready(function() {
                                        $('#table3').DataTable({
                                            "processing": true,
                                            "serverSide": true,
                                            "ajax": {
                                                "url": "<?= site_url('upload/get_ajax') ?>",
                                                "type": "POST",
                                            },
                                            "scrollY": 200,
                                            "scroller": {   
                                                loadingIndicator: true,
                                            },
                                            "deferRender": true,
                                        });
                                    });
                                </script>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Company Name</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Token</th>
                            </tr>
                        </tfoot>
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