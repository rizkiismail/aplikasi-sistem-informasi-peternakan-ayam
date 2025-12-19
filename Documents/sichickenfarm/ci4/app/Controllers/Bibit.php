<?php

namespace App\Controllers;

use App\Models\BibitModel;
use TCPDF;

class Bibit extends BaseController
{
    protected $BibitModel;
    public function __construct()
    {
        $this->BibitModel = new BibitModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Bibit',
            'bibit' => $this->BibitModel->getBibit()
        ];

        return view('bibit/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Bibit',
            'validation' => \Config\Services::validation()
        ];

        return view('bibit/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/bibit/create')->withInput()->with('validation', $validation);
        }

        $this->BibitModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/bibit');
    }

    public function delete($id)
    {
        $this->BibitModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/bibit');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data bibit',
            'validation' => \Config\Services::validation(),
            'bibit' => $this->BibitModel->getBibit($id)
        ];

        return view('bibit/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tanggal' => [
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

        $this->BibitModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/bibit');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('bibit/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data bibit',
            'bibit' => $this->BibitModel->getbibit()
        ];

        return view('bibit/report', $data);
    }

    public function export()
    {

        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->BibitModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('bibit/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Bibit Masuk - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Bibit Masuk - ' . $tanggal . '.pdf');
    }
}
