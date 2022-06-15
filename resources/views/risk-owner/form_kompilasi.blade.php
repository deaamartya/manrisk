<!DOCTYPE html>
<html>
    <head>
        <title>Hasil Kompilasi Risiko</title>
        <style>
            table,tr,th, td{
                border: 1pt solid black;
                border-collapse: collapse;
            }
            th, td{
                font-size: 14px;
                padding: 8px;
                vertical-align: middle;
            }
            th{
                color: black;
            }
            .text-center{
                text-align: center;
            }
            .text-bold{
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <table cellspacing="0" width="100%">
            <thead>
                <tr class="text-center">
                    <td colspan="2">
                        <img src="{{ public_path('assets/images/logo_bumn.png') }}" style="width:120px;">
                    </td>
                    <td>
                        <b>Hasil Kompilasi Risiko</b>
                        <br>
                        PI - PAL Indonesia Tahun 2022
                    </td>
                    <td colspan="3">
                        <img src="{{ public_path('assets/images/logo_pal.png') }}" style="width:90px;">
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center text-bold">
                    <td width="6%">
                        No
                    </td>
                    <td width="30%">
                        Konteks Organisasi
                    </td>
                    <td width="40%">
                        Sumber Risiko
                    </td>
                    <td width="8%">
                        L
                    </td>
                    <td width="8%">
                        C
                    </td>
                    <td width="8%">
                        R
                    </td>
                </tr>
                @php
                $no = 1;
                @endphp
                @foreach($data as $d)
                    <tr>
                        <td class="text-center">
                            {{ $no++; }}
                        </td>
                        <td>
                            <b>{{ $d->id_risk }}</b> - {{ $d->konteks }}
                        </td>
                        <td>
                            {{ $d->s_risiko }}
                        </td>
                        <td class="text-center">
                            {{ round($d->L, 2) }}
                        </td>
                        <td class="text-center">
                            {{ round($d->C, 2) }}
                        </td>
                        <td class="text-center">
                            {{ number_format($d->L * $d->C, 2) + 0 }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>