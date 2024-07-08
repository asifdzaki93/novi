<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Absensi Karyawan</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $this->load->view('template/css'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        <?php $this->load->view('template/header'); ?>
        <?php $this->load->view('template/sidebar'); ?>
        <div class="content-wrapper">
            <?php echo $contents; ?>
            <!-- Tambahkan elemen untuk menampilkan jam dan keterangan shift -->
            <div id="clock" style="font-size: 24px; font-weight: bold;"></div>
            <div id="shift-info" style="font-size: 18px; margin-top: 10px;"></div>
        </div><!-- /.content-wrapper -->
        <?php $this->load->view('template/footer'); ?>
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">
                </div>
            </div>
        </aside>
        <?php $this->load->view('template/js'); ?>
        <div class="control-sidebar-bg"></div>
    </div>
</body>


</html>