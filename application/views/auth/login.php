<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ionicons-2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">

    <script>
        function displayTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();

            // Convert to WIB timezone (UTC+7)
            hours = hours + 0;
            if (hours >= 24) {
                hours = hours - 24;
            }

            // Add leading zeros to minutes and seconds
            minutes = (minutes < 10 ? '0' : '') + minutes;
            seconds = (seconds < 10 ? '0' : '') + seconds;

            var timeString = hours + ':' + minutes + ':' + seconds;
            document.getElementById('clock').innerHTML = timeString;

            // Display shift information
            var shiftInfo = document.getElementById('shift-info');
            if (hours >= 8 && hours < 19) {
                shiftInfo.innerHTML = 'SHIFT 1 (08:00 - 19:00 WIB)';
            } else {
                shiftInfo.innerHTML = 'SHIFT 2 (19:00 - 08:00 WIB)';
            }
        }

        // Update the clock and shift information every second
        setInterval(displayTime, 1000);
    </script>
</head>
<style>
    .login-logo a,
    .register-logo a {
        color: #fbfbfb;
    }

    body {
        background-image: url('https://img.antaranews.com/cache/1200x800/2022/10/18/IMG-20221018-WA0017.jpg.webp') !important;
        background-size: cover;
    }
</style>


<body class="hold-transition login-page">

    <style media="screen">

    </style>

    <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box pt-5">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <h3 class="text-center mt-0 mb-4">
                    <b>ABSENSI KARYAWAN</b><br>
                    <b>PT CPB Kendal</b>
                </h3>
                <h4 class="text-center" id="clock"></h4>
                <p class="text-center" id="shift-info"></p>
                <p class="login-box-msg">Login Untuk Memulai</p>

                <div id="infoMessage" class="text-center"><?php echo $message; ?></div>
                <?= form_open("auth/cek_login", array('id' => 'login')); ?>
                <div class="form-group has-feedback">
                    <?= form_input($identity); ?>
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <span class="help-block"></span>
                </div>
                <div class="form-group has-feedback">
                    <?= form_input($password); ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <span class="help-block"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <?= form_checkbox('remember', '', FALSE, 'id="remember"'); ?> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <?= form_submit('submit', lang('login_submit_btn'), array('id' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat')); ?>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close(); ?>
                <p align='center'><b><i>Gunakan User dibawah ini</i></b></p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>admin@admin.com</td>
                            <td>password</td>
                            <td>admin</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>operator@operator.com</td>
                            <td>password</td>
                            <td>operator</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>assets/app/js/login.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>
<script type="text/javascript">
    let base_url = '<?= base_url(); ?>';
</script>

</html>