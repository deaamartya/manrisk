<head>
    {{-- <link rel="stylesheet" href="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/css/vendors/bootstrap/bootstrap.css' }}"> --}}
    <style>
        .table-header tr td {
            font-size: 12px;
            text-align: center;
            vertical-align: middle;
        }
        table tr td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table-2 tr td,
        .table-3 tr td {
            font-size: 14px;
            vertical-align: middle;
        }
        .left {
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .pl-10p {
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <table class="table-header" cellspacing="0" width="100%">
    	<tr>
            <td width="140">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo2.png' }}" style="width:90px;" />
    		</td>
    		<td width="70%" height="40">
    			<b>RISK REGISTER PT. PAL INDONESIA (PERSERO) </b>
    		</td>
    		<td width="143">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo2.png' }}" style="width:120px;" />
    		</td>
    	</tr>
    </table>
    <table class="table-2" cellspacing="0" width="100%">
    	<tr>
    		<td width="13%">
    			Divisi / Unit Kerja
    		</td>
    		<td width="49%" class="left pl-10p">
    			{{ $user->instansi }}
    		</td>
    		<td width="16%" class="center">
    			Disusun Oleh :
    		</td>
    		<td width="20%" class="center">
    			Diperiksa &  Disetujui  Oleh
    		</td>
    	</tr>
    </table>
    <table class="table-3" cellspacing="0" width="100%">
    	<tr>
    		<td width="13%" class="left">
    			Tanggal Penyusunan
    		</td>
    		<td width="49%" class="left pl-10p">
    			26 April 2022
    		</td>
    		<td rowspan="4" width="16%" class="center">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo2.png' }}" width="60"><br><br>
				{{ $header->penyusun }}
    		</td>
    		<td rowspan="4" width="20%" class="center">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo2.png' }}" width="60"><br><br>
				{{ $header->pemeriksa }}
    		</td>
    	</tr>
		<tr>
    		<td width="13%" class="left">
    			Tanggal Cetak
    		</td>
    		<td width="49%" class="left pl-10p">
    			26 April 2022
    		</td>

    	</tr>
		<tr>
    		<td width="13%" class="left">
    			Tahun Periode
    		</td>
    		<td width="49%" class="left pl-10p">
    			2022
    		</td>
    	</tr>
		<tr>
    		<td width="13%" class="left">
    			Sasaran / Target
    		</td>
    		<td width="49%" height="80" style="font-size:12px;" class="left pl-10p">
    			{!! $header->target !!}
    		</td>
    	</tr>
    </table>
</body>
