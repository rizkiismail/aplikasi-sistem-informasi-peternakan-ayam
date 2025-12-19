<?php

namespace App\Controllers;

use App\Models\PanenModel;
use TCPDF;

class Panen extends BaseController
{
    protected $PanenModel;
    public function __construct()
    {
        $this->PanenModel = new PanenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Panen',
            'panen' => $this->PanenModel->getPanen(),
        ];

        return view('panen/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Panen',
            'validation' => \Config\Services::validation()
        ];

        return view('panen/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'data_supir' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'kg' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/panen/create')->withInput()->with('validation', $validation);
        }

        $this->PanenModel->save([
            'tanggal' => $this->request->getVar('tanggal'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'data_supir' => $this->request->getVar('data_supir'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kg' => $this->request->getVar('kg')

        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');

        return redirect()->to('/panen');
    }

    public function delete($id)
    {
        $this->PanenModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('/panen');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data Panen',
            'validation' => \Config\Services::validation(),
            'panen' => $this->PanenModel->getPanen($id)
        ];

        return view('panen/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'data_supir' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ],
            'kg' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus diisi.']
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->PanenModel->save([
            'id' => $id,
            'tanggal' => $this->request->getVar('tanggal'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'data_supir' => $this->request->getVar('data_supir'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kg' => $this->request->getVar('kg')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah!');

        return redirect()->to('/panen');
    }

    public function form_export()
    {
        $data = ['title' => 'Pilih Tanggal Untuk Ditampilkan'];
        return view('panen/form_export', $data);
    }

    public function report()
    {
        $data = [
            'title' => 'Laporan Data Panen',
            'panen' => $this->PanenModel->getPanen()
        ];

        return view('panen/report', $data);
    }

    public function export()
    {
        $tgl_awal = date('Y-m-d', strtotime($this->request->getVar('tanggal_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->request->getVar('tanggal_akhir')));
        $data = ['orders' => $this->PanenModel->get_all_with_date($tgl_awal, $tgl_akhir)];
        $html = view('panen/print', $data);
        $tanggal = date('d-m-Y');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetFont('', '', 12);
        $pdf->Cell(115, 0, "Laporan Panen - " . $tanggal, 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Awal: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_awal'))), 0, 1, 'L');
        $pdf->Cell(115, 0, "Tanggal Akhir: " . date('d-m-Y', strtotime($this->request->getVar('tanggal_akhir'))), 0, 1, 'L');
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetAutoPageBreak(true, 0);

        $tanggal = date('d-m-Y');
        $this->response->setContentType("application/pdf");
        $pdf->Output('Laporan Panen - ' . $tanggal . '.pdf');
    }
}
