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
				.f-13 {
					font-size: 13px;
				}
				.f-12 {
					font-size: 12px;
				}
				.f-11 {
					font-size: 11px;
				}
				.f-10 {
					font-size: 10px;
					line-height: 10px;
				}
				.p-0 {
					padding: 0;
				}
				.border-top-none {
					border-top: none !important;
				}
				.border-bottom-none {
					border-bottom: none !important;
				}
				.border-right-none {
					border-right: none !important;
				}
				.border-left-none {
					border-left: none !important;
				}
				.custom-tr td {
					overflow: hidden !important;
					height: 14px !important;
					white-space: nowrap !important;
					line-height: 10px !important;
					padding: 0 !important;
				}
				.content td {
					vertical-align: top !important;
				}
    </style>
</head>
<body>
	@php
	function tanggal_indonesia($tanggal){
	$bulan = array (
		1 =>'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
		);

		$var = explode('-', $tanggal);

		return $var[2] . ' ' . $bulan[ (int)$var[1] ] . ' ' . $var[0];
		// var 0 = tanggal
		// var 1 = bulan
		// var 2 = tahun
	}		
	@endphp
    <table class="table-header" cellspacing="0" width="100%">
    	<tr>
            <td width="100">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_bumn.png' }}" style="width:100px;" />
    		</td>
    		<td width="70%" height="40">
    			<h3>RISK REGISTER INDHAN </h3>
    		</td>
    		<td width="100">
    			<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_INHAN.png' }}" style="width:100px;" />
    		</td>
    	</tr>
    </table>
    <table class="table-2" cellspacing="0" width="100%">
    	<tr>
    		<td width="13%" class="left">
    			Instansi
    		</td>
			<td width="49%" class="left pl-10p">
                INDHAN
    		</td>
    		<td width="16%" class="center">
    			Disusun Oleh
    		</td>
			<td width="20%" class="center">
    			Diperiksa &  Disetujui  Oleh
    		</td>
    	</tr>
    	<tr>
    		<td width="13%" class="left">
    			Tanggal Penyusunan
    		</td>
    		<td width="49%" class="left pl-10p">
    			@php echo tanggal_indonesia(date('Y-m-d', strtotime($header->created_at))); @endphp
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
    			@php echo tanggal_indonesia(date('Y-m-d')); @endphp
    		</td>
    	</tr>
		<tr>
    		<td width="13%" class="left">
    			Tahun Periode
    		</td>
    		<td width="49%" class="left pl-10p">
    			{{ $header->tahun }}
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
		<table class="table-4" cellspacing="0" width="100%">
    	<tr>
    		<td class="f-13 center" colspan="7">
    			IDENTIFIKASI
    		</td>
    		<td class="f-13 center" colspan="7">
    			PENGENDALIAN DAN PENILAIAN AWAL
    		</td>
    		<td class="f-13 center" colspan="2">
    			PENANGANAN
    		</td>
    		<td class="f-13 center" colspan="4">
    			PENILAIAN AKHIR
    		</td>
    	</tr>
    	<tr>
    		<td width="5%" height="70" class="center f-11" rowspan="2">
    			ID Risk
    		</td>
    		<td width="7%" class="center f-12" rowspan="2">
    			Konteks Organisasi
    		</td>
    		<td width="8%" class="center f-10" rowspan="2">
    			Persyaratan Perundangan, Kebutuhan dan Harapan
    		</td>
    		<td width="8%" class="center f-12" rowspan="2">
    			Indikator Risiko
    		</td>
    		<td width="6%" class="center f-12" rowspan="2">
    			Risiko
    		</td>
    		<td width="6%" class="center f-12" rowspan="2">
    			Penyebab Risiko
    		</td>
    		<td width="6%" class="center f-12" rowspan="2">
    			Dampak Risiko
    		</td>
    		<td width="3%" class="center f-11" rowspan="2">
    			UC/C
    		</td>
    		<td width="7%" class="center f-11" rowspan="2">
    			Pengendalian Risiko Saat Ini
    		</td>
    		<td width="10%" class="center f-11 p-0" colspan="3">
    			Level Risiko Awal
    		</td>
    		<td width="8%" class="center f-11" rowspan="2">
    			PELUANG
    		</td>
    		<td width="6%" class="center f-11" rowspan="2">
    			Rencana Tindak Lanjut
    		</td>
    		<td width="6%" class="center f-10" rowspan="2">
    			Jadwal Pelaksan aan
    		</td>
    		<td width="4%" class="center f-11" rowspan="2">
    			PIC
    		</td>
    		<td width="8%" class="center f-11" rowspan="2">
    			Dokumen Terkait
    		</td>
    		<td width="10%" class="center f-11 p-0" colspan="3">
    			Level Risiko Akhir
    		</td>
    	</tr>
			<tr class="custom-tr">
				<td style="height: 10px;" width="2%" class="center p-0 f-10">L</td>
				<td style="height: 10px;" width="2%" class="center p-0 f-10">C</td>
				<td style="height: 10px;" width="3%" class="center p-0 f-10">R</td>
				<td style="height: 10px;" width="2%" class="center p-0 f-10">L</td>
				<td style="height: 10px;" width="2%" class="center p-0 f-10">C</td>
				<td style="height: 10px;" width="4.5%" class="center p-0 f-10">R</td>
			</tr>
    	<tr>
    		<td width="3%" class="center f-11">
    			(1)
    		</td>
    		<td width="6%" class="center f-12">
    			(2)
    		</td>
    		<td width="7%" class="center f-10">
    			(3)
    		</td>
    		<td width="6%" class="center f-12">
    			(4)
    		</td>
    		<td width="6%" class="center f-12">
    			(5)
    		</td>
    		<td width="5.9%" class="center f-12">
    			(6)
    		</td>
    		<td width="5.9%" class="center f-12">
    			(7)
    		</td>
    		<td width="2.6%" class="center f-11">
    			(8)
    		</td>
    		<td width="7%" class="center f-11">
    			(9)
    		</td>
    		<td width="6%" class="center f-11 p-0"  colspan="3">
    			(10)
    		</td>
    		<td width="6.7%" class="center f-11">
    			(11)
    		</td>
    		<td width="7%" class="center f-11">
    			(12)
    		</td>
    		<td width="4.3%" class="center f-10">
    			(13)
    		</td>
    		<td width="7%" class="center f-11">
    			(14)
    		</td>
    		<td width="6%" class="center f-11">
    			(15)
    		</td>
    		<td width="7%" class="center f-11 p-0"  colspan="3">
    			(16)
    		</td>
    	</tr>
        @if($detail_risk != null )
			@foreach($detail_risk as $rd)
			<tr class="content">
    		<td width="5%" class="center f-11">
    			{{ $rd->id_risk }}
    		</td>
    		<td width="7%" class="center f-12">
    			{{ $rd->konteks }}
    		</td>
    		<td width="8%" class="center f-10">
    			{{ $rd->ppkh }}
    		</td>
    		<td width="8%" class="center f-12">
    			{!! wordwrap(nl2br($rd->indikator), 14, '<br />', true) !!}
    		</td>
    		<td width="6%" class="center f-12">
    			{!! wordwrap(nl2br($rd->s_risiko), 14, '<br />', true) !!}
    		</td>
    		<td width="6%" class="center f-12">
    			{!! wordwrap(nl2br($rd->sebab), 14, '<br />', true) !!}
    		</td>
    		<td width="6%" class="center f-12">
    			{!! nl2br($rd->dampak) !!}
    		</td>
    		<td width="3%" class="center f-11">
    			{{ $rd->uc }}
    		</td>
    		<td width="7%" class="center f-11">
    			{!! wordwrap(nl2br($rd->pengendalian), 14, '<br />', true) !!}
    		</td>
    		<td width="2%" class="center f-11">
    			{{ $rd->l_awal }}
    		</td>
				<td width="2%" class="center f-11">
    			{{ $rd->c_awal }}
    		</td>
				<td width="3%" class="center f-11">
    			{{ $rd->r_awal }}
    		</td>
    		<td width="8%" class="center f-11">
    			{!! nl2br($rd->peluang) !!}
    		</td>
    		<td width="6%" class="center f-11">
    			{!! nl2br($rd->tindak_lanjut) !!}
    		</td>
    		<td width="6%" class="center f-10">
    			{!! wordwrap(nl2br($rd->jadwal), 10, '<br />', true) !!}
    		</td>
    		<td width="4%" class="center f-11">
    			{{ $rd->pic }}
    		</td>
    		<td width="8%" class="center f-11">
    			{!! nl2br($rd->dokumen) !!}
    		</td>
    		<td width="2%" class="center f-11">
    			{{ $rd->l_akhir }}
    		</td>
				<td width="2%" class="center f-11">
    			{{ $rd->c_akhir }}
    		</td>
				<td width="3%" class="center f-11">
    			{{ $rd->r_akhir }}
    		</td>
    	</tr>
			@endforeach
        @endif
    </table>
</body>
