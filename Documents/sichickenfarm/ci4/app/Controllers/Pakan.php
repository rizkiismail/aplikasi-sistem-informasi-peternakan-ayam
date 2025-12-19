<?php

namespace App\Controllers;

use App\Models\PakanModel;
use App\Models\StokModel;
use TCPDF;

class Pakan extends BaseController
{
    protected $PakanModel;
    protected $StokModel;
    public function __construct()
    {

        $this->PakanModel = new PakanModel();
        $this->StokModel = new StokModel();
    }

    public function index()
    {
        //$pakan = $this->PakanModel->findAll();
        $data = [
            'title' => 'Data Pakan',
            'pakan' => $this->PakanModel->getPakan(),
            'stokpakan' => $this->StokModel->hitungStokPakan(),
        ];

        return view('pakan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Pakan',
            'validation' => \Config\Services::validation()
        ];

        return view('pakan/create', $data);
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
            return redirect()->to('/pakan/create')->withInput()->with('validation', $validation);
        }

        $this->PakanModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/pakan');
    }

    public function delete($id)
    {
        $this->PakanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/pakan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Pakan',
            'validation' => \Config\Services::validation(),
            'pakan' => $this->PakanModel->getPakan($id)
        ];

        return view('pakan/edit', $data);
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

        $this->PakanModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'jenis' => $this->request->getVar('jenis'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/pakan');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('pakan/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data Pakan',
            'pakan' => $this->PakanModel->getPakan()
        ];

        return view('pakan/report', $data);
    }

    public function export()
    {

        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->PakanModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('pakan/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 14);
        $pdf->Cell(115, 0, "Laporan Pakan Masuk - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);
        // Add Header
        //$pdf->Ln(10);
        //$pdf->SetFont('', 'B', 12);
        //$pdf->Cell(10, 8, "No", 1, 0, 'C');
        //$pdf->Cell(35, 8, "Tanggal", 1, 0, 'C');
        //$pdf->Cell(35, 8, "Jenis", 1, 0, 'C');
        //$pdf->Cell(35, 8, "Jumlah", 1, 1, 'C');
        //$pdf->SetFont('', '', 12);

        //foreach ($orders->getResultArray() as $k => $order) {
        //$this->addRow($pdf, $k++, $order);
        //}

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Pakan Masuk - ' . $tanggal . '.pdf');
    }

    //private function addRow($pdf, $no, $order)
    //{
    //$pdf->Cell(10, 8, $no, 1, 0, 'C');
    //$pdf->Cell(35, 8, date('d-m-Y', strtotime($order['tanggal'])), 1, 0, 'C');
    //$pdf->Cell(35, 8, $order['jenis'], 1, 0, 'C');
    //$pdf->Cell(35, 8, $order['jumlah'], 1, 0, 'C');
    //}
}
