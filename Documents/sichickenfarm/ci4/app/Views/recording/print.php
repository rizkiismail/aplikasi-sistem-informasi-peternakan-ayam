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
            <th><strong>Umur</strong></th>
            <th><strong>Tanggal</strong></th>
            <th><strong>Mati</strong></th>
            <th><strong>Habis Pakan</strong></th>
        </tr>
        <?php foreach ($orders->getResultArray() as $s) { ?>
            <tr>
                <td><?= $s['umur']; ?></td>
                <td><?= $s['tanggal']; ?></td>
                <td><?= $s['mati']; ?></td>
                <td><?= $s['habis_pakan']; ?></td>
            </tr>
        <?php  } ?>
    </table>
</body>