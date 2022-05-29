<style>
    table th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    td {
        vertical-align: middle;
    }

    .first-table {
        width: 997px;
    }

    .first-table tr td[0] {
        width: 240px;
        font-size:12px;
    }

    .first-table tr td[1] {
        width: 505px;
        height: 40px;
        font-size:14px;
        padding-left: 10px;
        padding-right: 10px;
        line-height: 2px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .first-table tr td[2] {
        width: 240px;
    }

    .third-table {
        width: 997px;
    }

    .third-table tbody tr td[0] {
        width: 40px;
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .third-table tbody tr td[1] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .third-table tbody tr td[2] {
        font-size:14px;
        padding-left: 10px;
        font-weight: bold;
        text-align: center;
    }

    .third-table tbody tr td[3] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .third-table tbody tr td[4] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
    }

    .third-table tbody tr td[5] {
        font-size:14px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid;
    }
</style>
<body backtop="2mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <table class="first-table" cellspacing="0">
        <tr>
            <td align="center">
                <img src="{{ asset('assets/images/logo/logo_company/logo_bumn.png') }}" style="width:120px;">
            </td>
            <td align="center">
                <b>Hasil Kompilasi Risiko</b>
                <p>{{ $instansi->instansi }} Tahun {{ $tahun }} </p>
            </td>
            <td align="center">
                <img src="{{ asset('assets/images/logo/logo_company/logo_PI.png') }}" style="width:90px;">
            </td>
        </tr>
    </table>
    {{-- <table class="second-table" cellspacing="0">
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
    </table> --}}
    <table class="third-table" cellspacing="0">
        <thead>
            <tr>
                <th align="center">
                    No
                </th>
                <th align="center">
                    Konteks Organisasi
                </th>
                <th align="center">
                    Sumber Risiko
                </th>
                <th align="center">
                    L
                </th>
                <th align="center">
                    C
                </th>
                <th align="center">
                    R
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $dt)
                <tr>
                    <td align="center">
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
                        {{ number_format(($dt->l * $dt->c), 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
</body>
