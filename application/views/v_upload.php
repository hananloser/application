<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User / Upload</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Upload</li>
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
            <h3 class="card-title">Upload</h3>
            <div class="card-tools">
                <button class="btn btn-outline-primary"><a href="assets/sample/sample_format.xlsx">Download Format</a></button> </div>
        </div>
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('upload/import') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail">Upload File</label>
                    <input type="file" name="userfile" class="form-control"></input>

                </div>
                <button type="submit" class="btn btn-success">UPLOAD</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Page rendered in {elapsed_time} second
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
