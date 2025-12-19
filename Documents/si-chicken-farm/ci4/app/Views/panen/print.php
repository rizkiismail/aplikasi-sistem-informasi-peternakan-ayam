<link href="<?= base_url('bootstrap4/css/bootstrap.min.css') ?>" rel="stylesheet">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #000000;
        text-align: left;
    }
</style>
<br>
<br>

<body>

    <table cellpadding="6">
        <tr>
            <th><strong>No</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Nama</strong></th>
            <th><strong>Alamat</strong></th>
            <th><strong>Data Supir</strong></th>
            <th><strong>Jumlah (ekor)</strong></th>
            <th><strong>Jumlah (kg)</strong></th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($orders->getResultArray() as $s) { ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $s['tanggal']; ?></td>
                <td><?= $s['nama']; ?></td>
                <td><?= $s['alamat']; ?></td>
                <td><?= $s['data_supir']; ?></td>
                <td><?= $s['jumlah']; ?></td>
                <td><?= $s['kg']; ?></td>
            </tr>
        <?php  } ?>
    </table>
</body>