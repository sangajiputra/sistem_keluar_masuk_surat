<?php include_once dirname(__FILE__).'/../layouts/header.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Surat Masuk Forward
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('surat_masuk');?>">surat_masuk</a></li>
        <li class="active">Forward</li>
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
                                    <h3 class="box-title">Surat Masuk > Forward</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" enctype="multipart/form-data" method="post" action="<?php echo site_url('surat_masuk/action_kirim');?>">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">"<?php echo $data['nama_dokumen'];?>" dikirim ke: </label>
                                            <select class="select2_group form-control" name="to">
                                              <?php
                                              foreach($user as $a) {
                                              ?>
                                              <option value="<?php echo $a['id_pengguna'];?>"> <?php echo $a['nama_pengguna'];?></option>
                                                <?php ;}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Pesan </label>
                                            <select class="select2_group form-control" name="message">
                                              <option value="standart">Standart</option>
                                              <option value="perhatian">Perhatian</option>
                                              <option value="sangat penting">Sangat Penting</option>
                                            </select>
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="hidden" name="id" value="<?php echo $data['id_dokumen'];?>">
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