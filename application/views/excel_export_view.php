<html>
<head>
    <title>Export FED to Excel</title>
    
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
 <div class="container box">
  <h3 align="center">Export FED Data to Excel</h3>
  <br />
  <div class="table-responsive">
  <table class="table table-bordered">
        <thead class="thead-dark">
            <tr style="color: black; font-size: small;">
                <th rowspan="2">
                    <center>No</center>
                </th>
                <th rowspan="2">
                    <center>Kegiatan Tugas Jabatan</center>
                </th>
                <th colspan="5">
                    <center>Target</center>
                </th>
                <th colspan="5">
                    <center>Realisasi</center>
                </th>
                <th rowspan="2">
                    <center>Nilai Capaian SKP</center>
                </th>
                <th rowspan="2">
                    <center>Aksi</center>
                </th>
            </tr>
            <tr style="color: black;">
                <th>
                    <center>AK</center>
                </th>
                <th>
                    <center>Output (KUAN)</center>
                </th>
                <th>
                    <center>Mutu (KUAL)</center>
                </th>
                <th>
                    <center>Waktu</center>
                </th>
                <th>
                    <center>Biaya</center>
                </th>
                <th>
                    <center>AK</center>
                </th>
                <th>
                    <center>Output (KUAN)</center>
                </th>
                <th>
                    <center>Mutu (KUAL)</center>
                </th>
                <th>
                    <center>Waktu</center>
                </th>
                <th>
                    <center>Biaya</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
        <?php 
            
            foreach ($Fed as $row) : ?>
             <tr>
            <th>
                <?= $i ?>
            </th>
            <th>
                <?= $row->pendidikan; ?>
                <?= $row->penelitian; ?>
                <?= $row->pengabdian; ?>
                <?= $row->publikasi; ?>
                <?= $row->lainnya; ?>
            </th>
            <th><?= $row->ak; ?></th>
            <th><?=  $row->output; ?></th>
            <th><?= $row->mutu; ?></th>
            <th><?= $row->waktu; ?></th>
            <th><?= $row->biaya; ?></th>
            <th><?= $row->fed_ak; ?></th>
            <th><?= $row->fed_output; ?></th>
            <th><?= $row->fed_mutu; ?></th>
            <th><?= $row->fed_waktu; ?></th>
            <th><?= $row->fed_biaya; ?></th>
            <th><?= $row->skp; ?></th>
            <th>
            <?php 
            if(empty($e['fed_ak'])){ ?>
            <a href="<?= base_url('admin/ubahfed/'); ?><?= $e['fed_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="border-radius: 20px; width:100%"><i class="fas fa-plus fa-sm text-white-50"></i>Add</a>
            <?php } else {?> 
            <a href="<?= base_url('admin/ubahfed/'); ?><?= $e['fed_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" style="border-radius: 20px; width:100%"><i class="fas fa-edit fa-sm text-white-50"></i>Edit</a>   
            <?php } ?>
            </th>
        </tr> 
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
       
        

    </table>
   <div align="center">
    <form method="post" action="<?php echo base_url(); ?>excel_export/action">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
   </div>
   <br />
   <br />
  </div>
 </div>
</body>
</html>
