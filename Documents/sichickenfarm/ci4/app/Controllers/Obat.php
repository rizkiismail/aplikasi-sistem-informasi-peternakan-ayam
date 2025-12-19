<?php

namespace App\Controllers;

use App\Models\ObatModel;
use TCPDF;

class Obat extends BaseController
{
    protected $ObatModel;
    public function __construct()
    {
        $this->ObatModel = new ObatModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Obat',
            'obat' => $this->ObatModel->getObat()
        ];

        return view('obat/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Obat',
            'validation' => \Config\Services::validation()
        ];

        return view('obat/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
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
            return redirect()->to('/obat/create')->withInput()->with('validation', $validation);
        }

        $this->ObatModel->save([
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/obat');
    }

    public function delete($id)
    {
        $this->ObatModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/obat');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Obat',
            'validation' => \Config\Services::validation(),
            'obat' => $this->ObatModel->getObat($id)
        ];

        return view('obat/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
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

        $this->ObatModel->save([
            'id' => $id,
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/obat');
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Stok Obat',
            'obat' => $this->ObatModel->getObat()
        ];

        return view('obat/report', $data);
    }

    public function export()
    {
        $data = ['orders' => $this->ObatModel->getObat()];
        $html = view('obat/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Stok Obat - " . $tanggal, 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Stok Obat - ' . $tanggal . '.pdf');
    }
}
