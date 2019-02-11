<?php include_once dirname(__FILE__).'/../layouts/header.php';?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DETAIL SURAT MASUK
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo site_url('surat_masuk');?>">Surat Masuk</a></li>
        <li class="active">DETAIL SURAT MASUK</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">SURAT MASUK > DETAIL</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $data['nama_dokumen'];?></h3>
                <h5>From: <?php echo $data['nama_pengguna'];?>
                  <span class="mailbox-read-time pull-right"><?php echo date("d-m-Y", strtotime($data['send_date']));?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border">
                <!-- /.btn-group -->
                <a onclick="print()"><button type="button" class="btn btn-default btn-sm" title="Print">
                  <i class="fa fa-print"></i></button></a>
              </div>
              <!-- /.mailbox-controls -->
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td>Nama Dokumen </td><td><?php echo $data['nama_dokumen'];?></td>
                  </tr>
                  <tr>
                    <?php if($data['message'] == 'standart'){ ?>
                    <td>Pesan </td><td><small class="label bg-blue">standart</small></td>
                    <?php }elseif($data['message'] == 'perhatian'){ ?>
                    <td>Pesan </td><td><small class="label bg-yellow">perhatian</small></td>
                    <?php }elseif($data['message'] == 'sangat penting'){ ?>
                    <td>Pesan </td><td><small class="label bg-red">sangat penting</small></td>
                    <?php ;} ?>
                  </tr>
                </tbody>
              </table>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <ul class="mailbox-attachments clearfix">
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-cloud-download"></i></span>

                  <div class="mailbox-attachment-info">
                    <a onclick="location.href='<?php echo $path;?>dokumen/<?php echo $data['dokumen_file'];?>'" class="mailbox-attachment-name"><?php echo $data['dokumen_file'];?></a>
                        <span class="mailbox-attachment-size">
                          <a onclick="location.href='<?php echo $path;?>dokumen/<?php echo $data['dokumen_file'];?>'" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php include_once dirname(__FILE__).'/../layouts/footer.php';?>