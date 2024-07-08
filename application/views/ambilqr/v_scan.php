<div class="box box-widget">
    <?php
    $params['data'] = $id_karyawan;
    $params['level'] = 'H';
    $params['size'] = 4;
    $params['savename'] = FCPATH . "uploads/qr_image/" . $id_karyawan . 'code.png';
    $this->ciqrcode->generate($params);
    ?>

    <div id="print-area">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
                <center>

                    <div class="">
                        <img class="img-responsive" src="<?php echo base_url('uploads/qr_image/') . $id_karyawan . 'code.png'; ?>" style="width: 35%; height: auto;" onclick="showLargeQR(this)" />
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class=""><?php echo $nama_karyawan ?></h3>
                    <h5 class=""><?php echo $id_karyawan; ?></h5>
                </center>
                <button onclick="printDiv('print-area')" class='pull-right'><i class='fa fa-print'></i> Print</button>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="#">NAMA JABATAN : <?php echo $nama_jabatan; ?> </a></li>
                    <li><a href="#">SHIFT : <?php echo $nama_shift; ?> </a></li>
                    <li><a href="#">PENEMPATAN : <?php echo $nama_gedung; ?> </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<a href="<?php echo base_url('cetakKartu/index/') . $id; ?>" class="btn btn-primary" target="_blank">Cetak Kartu</a>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function showLargeQR(element) {
        var largeQR = document.createElement('div');
        largeQR.innerHTML = '<img src="' + element.src + '" style="width: 150%; height: auto;" />';
        largeQR.style.position = 'fixed';
        largeQR.style.top = '50%';
        largeQR.style.left = '50%';
        largeQR.style.transform = 'translate(-50%, -50%)';
        largeQR.style.zIndex = '9999';
        largeQR.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        largeQR.style.padding = '20px';
        largeQR.style.borderRadius = '10px';
        largeQR.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
        document.body.appendChild(largeQR);
        largeQR.onclick = function() {
            this.remove();
        };
    }
</script>