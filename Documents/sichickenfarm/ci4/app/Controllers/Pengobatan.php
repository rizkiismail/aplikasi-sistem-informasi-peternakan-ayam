<?php

namespace App\Controllers;

use App\Models\PengobatanModel;
use TCPDF;

class Pengobatan extends BaseController
{
    protected $PengobatanModel;
    public function __construct()
    {
        $this->PengobatanModel = new PengobatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengobatan',
            'pengobatan' => $this->PengobatanModel->getPengobatan(),
            'jenisobat' => $this->PengobatanModel->getJenisObat()
        ];

        return view('pengobatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Pengobatan',
            'validation' => \Config\Services::validation(),
            'jenisobat' => $this->PengobatanModel->getJenisObat()
        ];

        return view('pengobatan/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/pengobatan/create')->withInput()->with('validation', $validation);
        }

        $this->PengobatanModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/pengobatan');
    }

    public function delete($id)
    {
        $this->PengobatanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/pengobatan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Pengobatan',
            'validation' => \Config\Services::validation(),
            'pengobatan' => $this->PengobatanModel->getPengobatan($id),
            'jenisobat' => $this->PengobatanModel->getJenisObat()
        ];

        return view('pengobatan/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->PengobatanModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/pengobatan');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('pengobatan/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data Pengobatan',
            'pengobatan' => $this->PengobatanModel->getPengobatan()
        ];

        return view('pengobatan/report', $data);
    }

    public function export()
    {

        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->PengobatanModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('pengobatan/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Pengobatan - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Pengobatan - ' . $tanggal . '.pdf');
    }
}
