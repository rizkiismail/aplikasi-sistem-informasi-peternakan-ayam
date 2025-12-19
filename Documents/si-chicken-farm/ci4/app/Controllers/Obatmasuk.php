<?php

namespace App\Controllers;

use App\Models\ObatmasukModel;
use TCPDF;

class Obatmasuk extends BaseController
{
    protected $ObatmasukModel;
    public function __construct()
    {
        $this->ObatmasukModel = new ObatmasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Obat Masuk',
            'obatmasuk' => $this->ObatmasukModel->getObatmasuk(),
            'jenisobat' => $this->ObatmasukModel->getJenisObat()
        ];

        return view('obatmasuk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Stok Obat',
            'validation' => \Config\Services::validation(),
            'jenisobat' => $this->ObatmasukModel->getJenisObat()
        ];

        return view('obatmasuk/create', $data);
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
            return redirect()->to('/obatmasuk/create')->withInput()->with('validation', $validation);
        }

        $this->ObatmasukModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/obatmasuk');
    }

    public function delete($id)
    {
        $this->ObatmasukModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/obatmasuk');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Obat',
            'validation' => \Config\Services::validation(),
            'obatmasuk' => $this->ObatmasukModel->getObatmasuk($id),
            'jenisobat' => $this->ObatmasukModel->getJenisObat()
        ];

        return view('obatmasuk/edit', $data);
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

        $this->ObatmasukModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/obatmasuk');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('obatmasuk/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data Obat Masuk',
            'obatmasuk' => $this->ObatmasukModel->getObatmasuk()
        ];

        return view('obatmasuk/report', $data);
    }

    public function export()
    {

        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->ObatmasukModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('obatmasuk/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Obat Masuk - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);
        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Obat Masuk - ' . $tanggal . '.pdf');
    }
}
