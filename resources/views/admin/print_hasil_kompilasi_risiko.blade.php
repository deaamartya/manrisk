<style>
    td {
        vertical-align: middle;
    }

    .first-table {
        width: 985px;
    }

    .first-table tr td[0] {
        width: 240px;
        border-left: 1px;
        border-top: 1px;
        font-size:12px;
    }

    .first-table tr td[1] {
        width: 505px;
        height: 40px;
        border-right: 1px;
        border-left: 1px;
        border-top: 1px;
        font-size:14px;
        padding-left: 10px;
        padding-right: 10px;
        line-height: 2px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .first-table tr td[2] {
        width: 240px;
        border-right: 1px;
        border-top: 1px;
    }

    .second-table {
        width: 997px;
    }

    .second-table tr td[0] {
        width: 40px;
        border-left: 1px;
        border-top: 1px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px;
    }

    .second-table tr td[1] {
        width: 194px;
        border-left: 1px;
        border-top: 1px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px;
    }

    .second-table tr td[2] {
        width: 524px;
        border-left: 1px;
        border-top: 1px;
        font-size:14px;
        padding-left: 10px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px;
    }

    .second-table tr td[3] {
        width: 75px;
        border-left: 1px;
        border-top: 1px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px;
    }

    .second-table tr td[4] {
        width: 76px;
        border-left: 1px;
        border-top: 1px;
        border-right: 1px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px;
    }

    .second-table tr td[5] {
        width: 76px;
        border-top: 1px;
        border-right: 1px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid;
    }

    .third-table {
        width: 997px;
    }
</style>

<table class="first-table" cellspacing="0">
    <tr>
        <td align="center">
            <img src="{{ asset('assets/images/logo/logo_company/logo_bumn.png') }}" style="width:120px;">
        </td>
        <td align="center">
            <b>Hasil Kompilasi Risiko</b>
            <p>Instansi {{ $instansi }} Tahun {{ $tahun }} </p>
        </td>
        <td align="center">
            <img src="{{ asset('assets/images/logo/logo_company/logo_PI.png') }}" style="width:90px;">
        </td>
    </tr>
</table>
<table class="second-table" cellspacing="0">
    <tr>
        <td align="center">
            No
        </td>
        <td align="center">
            Konteks Organisasi
        </td>
        <td align="center">
            Sumber Risiko
        </td>
        <td align="center">
            L
        </td>
        <td align="center">
            C
        </td>
        <td align="center">
            R
        </td>
    </tr>
</table>
{{-- <table class="third-table" cellspacing="0">
    <?php
    $no = 1;
    while ($data = mysqli_fetch_array($sql3)) {
        ?>
        <tr>
            <td width="40" style="border-left: 1px; border-bottom: 1px;font-size:14px; text-align: center;" align="center" valign="middle">
                <?php echo $no++; ?>
            </td>
            <td width="194" style="border-left: 1px; border-bottom: 1px; font-size:14px;" align="left" valign="middle">
               <b> <?php echo $data['id_risk']; ?></b> - <?php echo $data['konteks']; ?>
            </td>
            <td width="524" style="border-left: 1px; border-bottom: 1px; font-size:14px; padding-left: 10px;" align="left" valign="middle">
                <?php echo $data['s_risiko']; ?>
            </td>
            <td width="75" style="border-left: 1px; border-bottom: 1px; font-size:14px; " align="center" valign="middle">
                <?php echo round($data['l'],2); ?>
            </td>
            <td width="76" style="border-left: 1px; border-bottom: 1px; border-right: 1px; font-size:14px;" align="center" valign="middle">
                <?php echo round($data['c'],2); ?>
            </td>
            <td width="76" style="border-bottom: 1px; font-size:14px;border-right: 1px;" align="center" valign="middle">
                <?php echo number_format($data['l']*$data['c'],2); ?>
            </td>
        </tr>
    <?php }
    ?>

</table> --}}
