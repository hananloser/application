<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin / Manage DATA</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Manage DATA</li>
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
            <h3>EDIT DATA</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors(); ?>
                    <form action="<?= site_url('data/edit_database_process') ?>" method="post">
                        <div class="row">
                            <div class="col-md-4 offset-2">
                                <div class="from-group">
                                    <label for="Email_Addr ">Campaign ID</label>
                                    <input type="hidden" name="ID" class="form-control" value="<?= $row['ID']; ?>">
                                    <input type="text" name="Campaign_ID" class="form-control" value="<?= $row['Campaign_ID']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Date">Date</label>
                                    <input type="text" name="Date" class="form-control" value="<?= $row['Date']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Company_Name">Company_Name</label>
                                    <input type="text" name="Company_Name" class="form-control" value="<?= $row['Company_Name']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="First_Name ">First Name </label>
                                    <input type="text" name="First_Name" class="form-control" value="<?= $row['First_Name']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Last_Name">Last Name</label>
                                    <input type="text" name="Last_Name" class="form-control" value="<?= $row['Last_Name']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Job_Tittle">Job Title</label>
                                    <input type="text" name="Job_Tittle" class="form-control" value="<?= $row['Job_Tittle']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="from-group">
                                    <label for="Email_Addr">Email_Address</label>
                                    <input type="text" name="Email_Addr " class="form-control" value="<?= $row['Email_Addr']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Primary_Phone">Primary Phone</label>
                                    <input type="text" name="Primary_Phone" class="form-control" value="<?= $row['Primary_Phone']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Address ">Address</label>
                                    <input type="text" name="Address" class="form-control" value="<?= $row['Address']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="City">City</label>
                                    <input type="text" name="City" class="form-control" value="<?= $row['City']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="State">State</label>
                                    <input type="text" name="State" class="form-control" value="<?= $row['State']; ?>">
                                </div>
                                <div class="from-group">
                                    <label for="Zip">Zip Code</label>
                                    <input type="text" name="Zip" class="form-control" value="<?= $row['Zip']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 offset-2">
                            <hr>
                        </div>
                        <div class="col-md-8 offset-2">
                            <div class="from-group">
                                <label for="Country">Country</label>
                                <input type="text" name="Country" class="form-control" value="<?= $row['Country']; ?>">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2">
                            <div class="from-group">
                                <label for="Employee_Size">Employee Size</label>
                                <input type="text" name="Employee_Size" class="form-control" value="<?= $row['Employee_Size']; ?>">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2">
                            <div class="from-group">
                                <label for="Industry_Type">Industry Type</label>
                                <input type="text" name="Industry_Type" class="form-control" value="<?= $row['Industry_Type']; ?>">
                            </div>
                        </div>
                        <div class="col-md-8 offset-2">
                            <div class="from-group">
                                <label for="Linked_In_Link">LinkedIn Account</label>
                                <input type="text" name="Linked_In_Link" class="form-control" value="<?= $row['Linked_In_Link']; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="from-group mt-3 col col-md-4 offset-5">
                                <button type="submit" class="btn btn-success btn-flat">Submit</button>
                                <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                            </div>
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