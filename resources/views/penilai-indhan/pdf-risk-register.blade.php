<head>
	{{-- <link rel="stylesheet" href="{{ $_SERVER['DOCUMENT_ROOT'].'/public/assets/css/vendors/bootstrap/bootstrap.css' }}"> --}}
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
				padding-left: 10px;
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
			.f-7 {
				font-size: 7px;
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
			.m-0 {
				margin: 0;
			}
			.border-bottom-1 {
				border-bottom: 1px solid black;
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
				<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/public/assets/images/logo/logo_company/logo_bumn.png' }}" style="max-width:120px;max-height:35px" />
			</td>
			<td height="40">
				<b>RISK REGISTER {{ $user->perusahaan->instansi }} </b>
			</td>
			<td width="171">
				<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/public/assets/images/logo/logo_company/logo_'.$header->perusahaan->company_code.'.png' }}" style="max-width:120px;max-height:35px" />
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
				<p class="f-10 m-1">Ditandangani secara elektronik oleh </p>
				<p class="f-10 m-0">{{ ($header->pemeriksa ? $header->pemeriksa->name : '') }}</p>
				<p class="f-10 m-1">{{ ($header->pemeriksa ? $header->pemeriksa->jabatan : '') }}</p>
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
			<td class="f-12 center border-top-none" colspan="10">
				IDENTIFIKASI
			</td>
			<td class="f-12 center border-top-none" colspan="5">
				PENGENDALIAN DAN PENILAIAN AWAL
			</td>
			<td class="f-12 center border-top-none" rowspan="3">
				PELUANG
			</td>
			<td class="f-12 center border-top-none" colspan="2">
				PENANGANAN
			</td>
			<td class="f-12 center border-top-none" colspan="5">
				PENGENDALIAN DAN PENILAIAN AKHIR
			</td>
			<td class="f-12 center border-top-none" rowspan="3">
				PIC
			</td>
			<td class="f-12 center border-top-none" rowspan="3">
				Dokumen Terkait
			</td>
		</tr>
		<tr>
			<td class="center f-11" rowspan="2">
				ID Risk
			</td>
			<td class="center f-11" rowspan="2">
				Sasaran Kinerja
			</td>
			<td class="center f-11" rowspan="2">
				Jenis Kategori Risiko
			</td>
			<td class="center f-11" rowspan="2">
				Konteks Organisasi
			</td>
			<td class="center f-11" rowspan="2">
				Persyaratan Perundangan, Kebutuhan dan Harapan
			</td>
			<td class="center f-11" rowspan="2">
				Peristiwa Risiko (Risk Event)
			</td>
			<td class="center f-11" rowspan="2">
				Penyebab Risiko
			</td>
			<td class="center f-11" rowspan="2">
				Dampak Risiko (IDR Kuantitatif)
			</td>
			<td class="center f-11" rowspan="2">
				Penjelasan Dampak Risiko
			</td>
			<td class="center f-11" rowspan="2">
				UC/C
			</td>
			<td class="center f-11" rowspan="2">
				Pengendalian Risiko Saat Ini
			</td>
			<td class="center f-11" rowspan="2">
				Penilaian Efektifitas Kontrol
			</td>
			<td class="center f-11 p-0" colspan="3">
				Level Risiko Awal
			</td>
			<td class="center f-11" rowspan="2">
				Rencana Penangan Risiko
			</td>
			<td class="center f-11" rowspan="2">
				Target Waktu Penanganan
			</td>
			<td class="center f-11 p-0" colspan="3">
				Level Risiko Residual
			</td>
			<td class="center f-11" rowspan="2">
				Dampak Risiko Kuantitatif (Residual)
			</td>
			<td class="center f-11" rowspan="2">
				Penjelasan Dampak Risiko (Residual)
			</td>
		</tr>
		<tr class="custom-tr">
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">L</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">C</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">R</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">L</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">C</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-11">R</td>
		</tr>
		<tr>
			<td class="center f-11">
				(1)
			</td>
			<td class="center f-11">
				(2)
			</td>
			<td class="center f-11">
				(3)
			</td>
			<td class="center f-11">
				(4)
			</td>
			<td class="center f-11">
				(5)
			</td>
			<td class="center f-11">
				(6)
			</td>
			<td class="center f-11">
				(7)
			</td>
			<td class="center f-11">
				(8)
			</td>
			<td class="center f-11">
				(9)
			</td>
			<td class="center f-11 p-0">
				(10)
			</td>
			<td class="center f-11">
				(11)
			</td>
			<td class="center f-11">
				(12)
			</td>
			<td class="center f-11" colspan="3">
				(13)
			</td>
			<td class="center f-11">
				(14)
			</td>
			<td class="center f-11">
				(15)
			</td>
			<td class="center f-11 p-0">
				(16)
			</td>
			<td class="center f-11" colspan="3">
				(17)
			</td>
			<td class="center f-11">
				(18)
			</td>
			<td class="center f-11">
				(19)
			</td>
			<td class="center f-11">
				(20)
			</td>
			<td class="center f-11">
				(21)
			</td>
		</tr>
		@foreach($header->risk_detail as $rd)
		<tr class="content">
			<td width="4%" class="center f-7">
				{{ $rd->sumber_risiko->konteks->id_risk }}
			</td>
			<td width="4%" class="f-7">
				{{ $rd->sasaran_kinerja}}
			</td>
			<td width="4%" class="center f-7">
				{{ $rd->sumber_risiko->konteks->risk->risk }}
			</td>
			<td width="4%" class="f-7">
				{{ $rd->sumber_risiko->konteks->konteks }}
			</td>
			<td width="4%" class="f-7">
				{{ $rd->ppkh }}
			</td>
			<td width="4%" class="f-7">
				{!! wordwrap(nl2br($rd->sumber_risiko->s_risiko), 14, '<br />', true) !!}
			</td>
			<td width="4%" class="f-7">
				{!! wordwrap(nl2br($rd->sebab), 14, '<br />', true) !!}
			</td>
			<td width="4%" class="center f-7">{{ number_format($rd->dampak_kuantitatif,2,',','.') }}</td>
			<td width="4%" class="f-7">
				{!! nl2br($rd->dampak) !!}
			</td>
			<td width="2%" class="center f-7">
				{{ $rd->uc }}
			</td>
			<td width="4%" class="f-7">
				{!! wordwrap(nl2br($rd->pengendalian), 14, '<br />', true) !!}
			</td>
			<td width="4%" class="center f-7">
				{!! wordwrap(nl2br($rd->penilaian), 14, '<br />', true) !!}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->l_awal, 2) + 0 }}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->c_awal, 2) + 0 }}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->r_awal, 2) + 0 }}
			</td>
			<td width="4%" class="f-7">
				{!! nl2br($rd->peluang) !!}
			</td>
			<td width="4%" class="f-7">
				{!! nl2br($rd->tindak_lanjut) !!}
			</td>
			<td width="4%" class="center f-7">
				{!! wordwrap(nl2br($rd->jadwal), 10, '<br />', true) !!}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->l_akhir, 2) + 0 }}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->c_akhir, 2) + 0 }}
			</td>
			<td width="1%" class="center f-7">
				{{ number_format($rd->r_akhir, 2) + 0 }}
			</td>
			<td width="4%" class="center f-7">{{ number_format($rd->dampak_kuantitatif_residu,2,',','.') }}</td>
			<td width="4%" class="f-7">{!! nl2br($rd->dampak_residu) !!}</td>
			<td width="4%" class="f-7" style="white-space: pre-line">
				{{ $rd->pic }}
			</td>
			<td width="4%" class="center f-7">
				{!! nl2br($rd->dokumen) !!}
			</td>
		</tr>
		@endforeach
	</table>
</body>
