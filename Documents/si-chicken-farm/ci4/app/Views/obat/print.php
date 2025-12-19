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
            <th><strong>Jenis</strong></th>
            <th><strong>Jumlah</strong></th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($orders as $s) { ?>
            <tr>
                <th scope="row"><?= $i++; ?></th>
                <td><?= $s['jenis']; ?></td>
                <td><?= $s['jumlah']; ?></td>
            </tr>
        <?php  } ?>
    </table>
</body>