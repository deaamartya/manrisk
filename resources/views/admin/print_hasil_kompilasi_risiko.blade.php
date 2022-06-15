<style>
    table th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    td {
        vertical-align: middle;
    }


    .table {
        width: 997px;
    }

    .table tbody tr td[0] {
        width: 20px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .table tbody tr td[1] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .table tbody tr td[2] {
        font-size:14px;
        padding-left: 10px;
        font-weight: bold;
        text-align: center;
    }

    .table tbody tr td[3] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .table tbody tr td[4] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .table tbody tr td[5] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid;
    }
</style>
<body backtop="2mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <table class="table" cellspacing="0">
        <thead>
            <tr>
                <td colspan="2">
                    <img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo_bumn.png' }}" style="width:120px;">
                </td>
                <td>
                    <b>Hasil Kompilasi Risiko</b>
                    <br>
                    @if (count($data) > 0) 
                    {{ $data[0]->company_code }} - {{ $data[0]->instansi }} Tahun {{ $data[0]->tahun_p }}
                    @endif
                </td>
                <td colspan="3">
                    @if (count($data) > 0) 
                    <img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_'.$data[0]->company_code.'.png' }}" style="max-width:120px;max-height:35px" />
                    @endif
                </td>
            </tr>
        </thead>
        <tbody>
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
            @foreach($data as $dt)
                <tr>
                    <td align="center" style="width: 40px">
                        {{ $loop->iteration }}
                    </td>
                    <td align="left">
                        <b> {{ $dt->id_risk }}</b> - {{ $dt->konteks }}
                    </td>
                    <td align="left">
                        {{ $dt->s_risiko }}
                    </td>
                    <td align="center">
                        {{ round($dt->l, 2) }}
                    </td>
                    <td align="center">
                        {{ round($dt->c, 2) }}
                    </td>
                    <td align="center">
                        {{ number_format(($dt->l * $dt->c), 2) + 0 }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>
