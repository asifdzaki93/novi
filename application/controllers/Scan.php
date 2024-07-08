<?php
class Scan extends Ci_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->in_group('Operator') && !$this->ion_auth->is_admin()) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$this->load->library('user_agent');
		$this->load->model('Gedung_model');
		$this->load->library('form_validation');
		$this->user = $this->ion_auth->user()->row();
		$this->load->model('Scan_model', 'Scan');
	}

	public function messageAlert($type, $title)
	{
		$messageAlert = "Swal.fire({
			type: '" . $type . "',
			title: '" . $title . "',
			showConfirmButton: false,
			timer: 3000
		});";
		return $messageAlert;
	}

	function index()
	{
		$user = $this->user;
		$data = array('user' => $user, 'users' => $this->ion_auth->user()->row());
		if ($this->agent->is_mobile('iphone')) {
			$this->template->load('template/template', 'scan/scan_mobile', $data);
		} elseif ($this->agent->is_mobile()) {
			$this->template->load('template/template', 'scan/scan_mobile', $data);
		} else {
			$this->template->load('template/template', 'scan/scan_desktop', $data);
		}
	}

	function cek_id()
	{
		$user = $this->user;
		$result_code = $this->input->post('id_karyawan');
		$tgl = date('Y-m-d');
		$jam_msk = date('H:i:s');
		$jam_klr = date('H:i:s');
		$cek_id = $this->Scan->cek_id($result_code);
		$cek_kehadiran = $this->Scan->cek_kehadiran($result_code, $tgl);

		// Tentukan shift saat ini dan waktu masuk shift
		$shift_start_time_1 = strtotime("08:00:00");
		$shift_end_time_1 = strtotime("19:00:00");
		$shift_start_time_2 = strtotime("19:00:00");
		$shift_end_time_2 = strtotime("08:00:00 +1 day"); // tambahkan +1 day untuk shift 2
		$current_time = strtotime($jam_msk);

		// Tentukan shift saat ini
		if ($current_time >= $shift_start_time_1 && $current_time < $shift_end_time_1) {
			$shift = "SHIFT 1";
			$shift_start = "08:00:00";
			$shift_end = "19:00:00";
		} else {
			$shift = "SHIFT 2";
			$shift_start = "19:00:00";
			$shift_end = "08:00:00 +1 day"; // tambahkan +1 day untuk shift 2
		}

		// Hitung keterlambatan dalam menit
		$shift_start_time = strtotime($shift_start);
		$late_minutes = ($current_time - $shift_start_time) / 60;
		$keterangan = $late_minutes > 0 ? "Terlambat " . round($late_minutes) . " menit" : "Tepat waktu";

		if (!$cek_id) {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'absen gagal data QR tidak ditemukan'));
			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($cek_kehadiran && $cek_kehadiran->jam_msk != '00:00:00' && $cek_kehadiran->jam_klr == '00:00:00' && $cek_kehadiran->id_status == 1) {
			$shift_end_time = strtotime($shift_end);
			$early_or_late_minutes = ($shift_end_time - strtotime($jam_klr)) / 60;
			if ($early_or_late_minutes > 0) {
				$keterangan_pulang = "Pulang : " . round(abs($early_or_late_minutes)) . " menit lebih awal";
			} else {
				$keterangan_pulang = "Pulang : " . round(abs($early_or_late_minutes)) . " menit lebih akhir";
			}

			$data = array(
				'jam_klr' => $jam_klr,
				'id_status' => 2,
				'ket' => $cek_kehadiran->ket . ", " . $keterangan_pulang,
			);
			$this->Scan->absen_pulang($result_code, $data);
			$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'absen ' . $keterangan_pulang));
			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($cek_kehadiran && $cek_kehadiran->jam_msk != '00:00:00' && $cek_kehadiran->jam_klr != '00:00:00' && $cek_kehadiran->id_status == 2) {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'sudah absen'));
			redirect($_SERVER['HTTP_REFERER']);
			return false;
		} else {
			$data = array(
				'id_karyawan' => $result_code,
				'tgl' => $tgl,
				'jam_msk' => $jam_msk,
				'id_khd' => 1,
				'id_status' => 1,
				'ket' => $keterangan,
			);
			$this->Scan->absen_masuk($data);
			$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'absen masuk - ' . $keterangan));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
