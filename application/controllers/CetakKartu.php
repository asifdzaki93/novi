<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CetakKartu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $this->load->library('form_validation');
        $this->load->library('Pdf'); // Memanggil library yang kita buat tadi
        $this->load->model('Karyawan_model'); // Pastikan model Karyawan di-load
        $this->load->helper('url');
        $this->user = $this->ion_auth->user()->row();
    }

    public function index($id_karyawan = null)
    {
        if ($id_karyawan === null) {
            show_error('ID karyawan tidak disertakan', 400);
        }

        // Ambil data karyawan berdasarkan id karyawan
        $karyawan = $this->Karyawan_model->get_karyawan_by_nomor($id_karyawan);

        if (!$karyawan) {
            show_404();
        }

        error_reporting(0); // Agar error masalah versi PHP tidak muncul

        // Inisialisasi PDF dengan ukuran credit card (85.60 mm x 53.98 mm)
        $pdf = new FPDF('L', 'mm', array(85.60, 53.98));
        $pdf->AddPage();
        $pdf->Image(base_url('assets/images/cbsp.png'), 0, 0, 85.60, 53.98, 'png'); // Sesuaikan dengan ukuran halaman

        // Atur margin dan padding
        $margin = 3;
        $pdf->SetMargins($margin, $margin, $margin);
        $pdf->SetAutoPageBreak(false);

        // Informasi perusahaan
        $pdf->SetFont('Arial', 'BU', 10);
        $pdf->SetTextColor(0, 0, 0); // Warna teks hitam
        $pdf->SetXY(2, 2); // Posisikan lebih ke atas
        $pdf->Cell(0, 5, 'PT. Central Pertiwi Bahari', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        //$pdf->SetXY(5, 10); // Posisikan alamat lebih dekat dengan nama perusahaan
        $pdf->SetXY(2, 6); // Posisikan lebih ke atas
        $pdf->Cell(0, 5, 'Wonorejo - Kaliwungu - Kendal', 0, 1, 'L');
        $pdf->Ln(3); // Memberikan jarak kosong

        // Tambahkan QR code

        $pdf->Image(base_url('uploads/qr_image/') . $karyawan['id_karyawan'] . 'code.png', 5, 29, 20, 20, 'png'); // Sesuaikan dengan posisi yang diinginkan

        // Informasi karyawan - Sesuaikan posisi teks
        $pdf->SetXY(43, 12);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 6, ucwords($karyawan['nama_karyawan']), 0, 1);

        $pdf->SetXY(7, 48);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, $karyawan['id_karyawan'], 0, 1);

        $pdf->SetXY(50, 22);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(255, 255, 255); // Warna teks putih
        $pdf->Cell(0, 6, ucwords(strtolower($karyawan['nama_jabatan'])), 0, 1, 'L');

        $pdf->SetXY(50, 29);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(255, 255, 255); // Warna teks putih
        //$pdf->Cell(0, 6, ucwords($karyawan['nama_shift']), 0, 1, 'L');
        $pdf->SetXY(39, 40);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 6, 'Penempatan:', 0, 0, 'L');


        $pdf->SetXY(39, 44);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, ucwords(strtolower($karyawan['nama_gedung'] . ' - (' . $karyawan['alamat'] . ')')), 0, 1, 'L');

        $pdf->AddPage();
        $pdf->Image(base_url('assets/images/csbp.png'), 0, 0, 85.60, 53.98, 'png'); // Sesuaikan dengan ukuran halaman

        // Output PDF
        $pdf->Output('I', $karyawan['id_karyawan'] . '-' . $karyawan['nama_karyawan'] . "-QR.pdf");
    }
}
