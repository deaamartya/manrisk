<head>
    {{-- <link rel="stylesheet" href="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/css/vendors/bootstrap/bootstrap.css' }}"> --}}
    <style>
				@page {
					size: 29.7cm 21cm;
					margin: 0.25in;
					padding: .5in;
				}
				.table-header tr td {
					font-size: 12px;
					text-align: center;
					vertical-align: middle;
				}
				table tr td {
					border: 1px solid black;
					border-collapse: collapse;
				}
				.table-header tr td {
					border-bottom: none;
				}
				.table-2 tr td,
				.table-3 tr td {
					font-size: 13px;
					vertical-align: middle;
				}
				.table-2 tr td {
					white-space: nowrap;
					height: 12px;
				}
				.qrcode-row {
					height: 60px;
					text-align: center;
					font-size: 10px;
				}
				.row-target td {
					height: auto !important;
					padding: 5px;
					padding-left: 10px !important;
				}
				.table-4 tr td {
					border-right: 1px solid black;
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
				.p-10p {
					padding: 10px;
				}
				.m-1 {
					margin: 8px;
				}
				.f-13 {
					font-size: 13px;
				}
				.f-12 {
					font-size: 10px;
				}
				.f-11 {
					font-size: 9px;
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
				<td width="15%">
					<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_bumn.png' }}" style="max-width:120px;max-height:35px" />
				</td>
    		<td height="40">
    			<b>RENCANA PENGELOLAAN RISIKO (MITIGASI PLAN)</b>
    			{{-- <b>MITIGASI PLAN {{ $user->perusahaan->instansi }} </b> --}}
    		</td>
				<td width="171">
					<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_'.$user->perusahaan->company_code.'.png' }}" style="max-width:120px;max-height:35px" />
				</td>
			</tr>
		</table>
		<table class="table-2" cellpadding="0" cellspacing="0" width="100%" height="128">
			<tr style="min-height:12px;" height="12">
				<td width="15%" class="left pl-10p">
					Instansi
				</td>
				<td class="left pl-10p">
					{{ $header->perusahaan->instansi }}
				</td>
				<td width="15%" class="left pl-10p">
					Diperiksa &  Disetujui  Oleh
				</td>
			</tr>
			<tr>
				<td width="15%" class="left pl-10p">
					Tanggal Penyusunan
				</td>
				<td class="left pl-10p">
					@php echo tanggal_indonesia(date('Y-m-d', strtotime($header->tanggal))); @endphp
				</td>
				<td rowspan="5" class="qrcode-row">
					<img src="data:image/png;base64,{{ $qrcode }}" style="max-height:90px; border: 1px solid black;">
					<p class="f-10 m-1">Ditandangani secara elektronik oleh {{ ($header->pemeriksa ? $header->pemeriksa->name : '-') }}</p>
				</td>
			</tr>
			<tr>
				<td width="15%" class="left pl-10p">
					Tanggal Cetak
				</td>
				<td class="left pl-10p">
					@php echo tanggal_indonesia(date('Y-m-d')); @endphp
				</td>
			</tr>
			<tr>
				<td width="15%" class="left pl-10p">
					Tahun Periode
				</td>
				<td class="left pl-10p">
					{{ $header->tahun }}
				</td>
			</tr>
			<tr class="row-target">
				<td width="15%" class="left pl-10p">
					Sasaran / Target
				</td>
				<td class="left pl-10p">
					@php echo nl2br($header->target) @endphp
				</td>
			</tr>
			<tr>
				<td width="15%" class="left pl-10p">
					Disusun Oleh
				</td>
				<td class="left pl-10p">
					{{ ($header->penyusun ? $header->penyusun->name : '-') }}
				</td>
			</tr>
		</table>
		<table class="table-4" cellspacing="0" width="100%">
    	<tr>
    		<td width="3%" height="30" class="center f-11">
    			ID Risk
    		</td>
    		<td width="7%" class="center f-12">
    			Peristiwa yang mengganggu target / sasaran
    		</td>
    		<td width="3%" class="center f-10">
    			Level Risiko Awal
    		</td>
    		<td class="center f-12">
    			Opsi Mitigasi
    		</td>
    		<td width="6%" class="center f-12">
    			Penanggung Jawab
    		</td>
    		<td width="6%" class="center f-12">
    			Jadwal Pelaksanaan
    		</td>
    		<td width="6%" class="center f-12">
    			% Realisasi
    		</td>
    		<td width="3%" class="center f-11">
    			Level Risiko Akhir
    		</td>
    		<td width="7%" class="center f-11">
    			Keterangan
    		</td>
    	</tr>
    	<tr>
    		<td class="center f-11">
    			(1)
    		</td>
    		<td class="center f-12">
    			(2)
    		</td>
    		<td class="center f-10">
    			(3)
    		</td>
    		<td class="center f-12">
    			(4)
    		</td>
    		<td class="center f-12">
    			(5)
    		</td>
    		<td class="center f-12">
    			(6)
    		</td>
    		<td class="center f-12">
    			(7)
    		</td>
    		<td class="center f-11">
    			(8)
    		</td>
    		<td class="center f-11">
    			(9)
    		</td>
    	</tr>
		@foreach($header->risk_detail as $rd)
		<tr class="content">
			<td width="5%" class="center f-11">
				{{ $rd->sumber_risiko->konteks->id_risk }}
			</td>
			<td class="center f-11">
                {{ $rd->indikator }}
			</td>
            <td class="center f-11">
                {{ round(($rd->l_awal*$rd->c_awal), 0) }}
            </td>
			<td width="6%" class="center f-11">
				{!! nl2br($rd->tindak_lanjut) !!}
			</td>
			<td width="4%" class="center f-11">
				{{ $rd->pic }}
			</td>
			<td width="6%" class="center f-10">
                @if($rd->jadwal_mitigasi)
				    {{ date('d F Y', strtotime($rd->jadwal_mitigasi)) }}
                @else
                    -
                @endif
			</td>
            <td class="center f-11">
                {{ $rd->realisasi }}
            </td>
            <td class="center f-11">
                {{ round(($rd->l_akhir*$rd->c_akhir), 0) }}
            </td>
            <td class="center f-11">
                {{ $rd->keterangan }}
            </td>
		</tr>
		@endforeach
    </table>
</body>
