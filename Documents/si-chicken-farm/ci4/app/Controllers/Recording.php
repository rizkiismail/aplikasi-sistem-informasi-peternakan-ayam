<?php

namespace App\Controllers;

use App\Models\RecordingModel;
use App\Models\StokModel;
use TCPDF;

class Recording extends BaseController
{
    protected $RecordingModel;
    protected $StokModel;
    public function __construct()
    {
        $this->RecordingModel = new RecordingModel();
        $this->StokModel = new StokModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Recording',
            'recording' => $this->RecordingModel->getRecording(),
            'stokpakan' => $this->StokModel->hitungStokPakan(),
            'sisaayam' => $this->StokModel->hitungAyam()
        ];

        return view('recording/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Recording',
            'validation' => \Config\Services::validation()
        ];

        return view('recording/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'umur' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'mati' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'habis_pakan' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/recording/create')->withInput()->with('validation', $validation);
        }

        $this->RecordingModel->save([
            'umur' => $this->request->getVar('umur'),
            'tanggal' => $this->request->getVar('tanggal'),
            'mati' => $this->request->getVar('mati'),
            'habis_pakan' => $this->request->getVar('habis_pakan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/recording');
    }

    public function delete($id)
    {
        $this->RecordingModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/recording');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data recording',
            'validation' => \Config\Services::validation(),
            'recording' => $this->RecordingModel->getRecording($id)
        ];

        return view('recording/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'umur' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'mati' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'habis_pakan' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->RecordingModel->save([
            'id' => $id,
            'umur' => $this->request->getVar('umur'),
            'tanggal' => $this->request->getVar('tanggal'),
            'mati' => $this->request->getVar('mati'),
            'habis_pakan' => $this->request->getVar('habis_pakan')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/recording');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('recording/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data Recording',
            'recording' => $this->RecordingModel->getRecording()
        ];

        return view('recording/report', $data);
    }

    public function export()
    {

        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->RecordingModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('recording/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Recording - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Recording - ' . $tanggal . '.pdf');
    }
}
