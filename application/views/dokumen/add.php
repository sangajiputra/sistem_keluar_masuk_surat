<?php include_once dirname(__FILE__).'/../layouts/header.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dokumen Add
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('dokumen');?>">Dokumen</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Dokumen > Add</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('dokumen/actionadd');?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Dokumen</label>
                                            <input type="text" name="nama_dokumen" class="form-control" id="exampleInputUsername1" placeholder="Enter Nama Dokumen">
                                        </div>
                                        <div class="box-body no-padding">
                                          <div class="x_content">
                                            <div class="form-group">
                                              <label for="exampleInputFile">Input Image</label>
                                              <input type="file" name="file">
                                              <br/>
                                            </div>
                                          </div>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section>
    <!-- /.content -->
  </div>

<?php include_once dirname(__FILE__).'/../layouts/footer.php';?>