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
			.table-header tr td {
				border-bottom: none;
			}
			.table-2 tr td,
			.table-3 tr td {
				font-size: 14px;
				vertical-align: middle;
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
			<td width="140">
				<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_bumn.png' }}" style="width:90px;max-height:60px" />
			</td>
			<td width="70%" height="40">
				<b>RISK REGISTER {{ $user->perusahaan->instansi }} </b>
			</td>
			<td width="140">
				<img src="{{ $_SERVER['DOCUMENT_ROOT'].'/assets/images/logo/logo_company/logo_'.$user->perusahaan->company_code.'.png' }}" style="max-width:120px;max-height:35px" />
			</td>
		</tr>
	</table>
	<table class="table-2" cellspacing="0" width="100%">
			<tr style="height: 10px;">
				<td class="left pl-10p">
					Instansi
				</td>
				<td class="left pl-10p" height="5">
					{{ $header->perusahaan->instansi }}
				</td>
				<td class="left">
					Diperiksa &  Disetujui  Oleh
				</td>
			</tr>
			<tr style="height: 10px;">
				<td width="13%" class="left pl-10p">
					Tanggal Penyusunan
				</td>
				<td width="49%" height="5" class="left pl-10p">
					@php echo tanggal_indonesia(date('Y-m-d', strtotime($header->tanggal))); @endphp
				</td>
				<td rowspan="5" width="20%" height="" class="center">
					<img src="data:image/png;base64,{{ $qrcode }}" width="100"><br><br>
					<p class="f-10">Ditandangani secara elektronik oleh {{ ($header->pemeriksa ? $header->pemeriksa->name : '-') }}</p>
				</td>
			</tr>
			<tr style="height: 10px;">
				<td width="13%" class="left pl-10p">
					Tanggal Cetak
				</td>
				<td width="49%" height="5" class="left pl-10p">
					@php echo tanggal_indonesia(date('Y-m-d')); @endphp
				</td>
			</tr>
			<tr style="height: 10px;">
				<td width="13%" class="left pl-10p" style="height: 10px;">
					Tahun Periode
				</td>
				<td width="49%" height="5" class="left pl-10p" style="height: 10px;">
					{{ $header->tahun }}
				</td>
			</tr>
			<tr>
				<td width="13%" class="left pl-10p">
					Sasaran / Target
				</td>
				<td width="49%" height="80" style="font-size:12px;" class="left pl-10p">
					@php echo nl2br($header->target) @endphp
				</td>
			</tr>
			<tr style="height: 10px;">
				<td width="13%" class="left pl-10p">
					Disusun Oleh
				</td>
				<td width="49%" height="5" class="left pl-10p">
					{{ ($header->penyusun ? $header->penyusun->name : '-') }}
				</td>
			</tr>
	</table>
	<table class="table-4" cellspacing="0" width="100%">
		<tr>
			<td class="f-13 center border-top-none" colspan="10">
				IDENTIFIKASI
			</td>
			<td class="f-13 center border-top-none" colspan="5">
				PENGENDALIAN DAN PENILAIAN AWAL
			</td>
			<td class="f-13 center border-top-none"></td>
			<td class="f-13 center border-top-none" colspan="2">
				PENANGANAN
			</td>
			<td class="f-13 center border-top-none" colspan="5">
				PENGENDALIAN DAN PENILAIAN AKHIR
			</td>
			<td class="border-top-none"></td>
			<td class="border-top-none"></td>
		</tr>
		<tr>
			<td class="center f-11" rowspan="2">
				ID Risk
			</td>
			<td class="center f-12" rowspan="2">
				Sasaran Kinerja
			</td>
			<td class="center f-12" rowspan="2">
				Jenis Kategori Risiko
			</td>
			<td class="center f-12" rowspan="2">
				Konteks Organisasi
			</td>
			<td class="center f-10" rowspan="2">
				Persyaratan Perundangan, Kebutuhan dan Harapan
			</td>
			<td class="center f-12" rowspan="2">
				Peristiwa Risiko (Risk Event)
			</td>
			<td class="center f-12" rowspan="2">
				Penyebab Risiko
			</td>
			<td class="center f-12" rowspan="2">
				Dampak Risiko (IDR Kuantitatif)
			</td>
			<td class="center f-12" rowspan="2">
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
				PELUANG
			</td>
			<td class="center f-11" rowspan="2">
				Rencana Penangan Risiko
			</td>
			<td class="center f-10" rowspan="2">
				Target Waktu Penanganan
			</td>
			<td class="center f-11 p-0" colspan="3">
				Level Risiko Residual
			</td>
			<td class="center f-12" rowspan="2">
				Dampak Risiko Kuantitatif (Residual)
			</td>
			<td class="center f-12" rowspan="2">
				Penjelasan Dampak Risiko (Residual)
			</td>
			<td class="center f-11" rowspan="2">
				PIC
			</td>
			<td class="center f-11" rowspan="2">
				Dokumen Terkait
			</td>
		</tr>
		<tr class="custom-tr">
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">L</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">C</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">R</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">L</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">C</td>
			<td style="height: 10px;" width="1.5%" class="center p-0 f-10">R</td>
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
			<td class="center f-11 p-0">
				(10)
			</td>
			<td class="center f-11">
				(11)
			</td>
			<td class="center f-11">
				(12)
			</td>
			<td class="center f-10" colspan="3">
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
			<td class="center f-10">
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
			<td width="4%" class="center f-11">
				{{ $rd->sumber_risiko->konteks->id_risk }}
			</td>
			<td width="4%" class="center f-11">
			</td>
			<td width="4%" class="center f-12">
				{{ $rd->sumber_risiko->konteks->id_risk }}-{{ $rd->sumber_risiko->konteks->no_k }}
			</td>
			<td width="4%" class="f-12">
				{{ $rd->sumber_risiko->konteks->konteks }}
			</td>
			<td width="4%" class="f-10">
				{{ $rd->ppkh }}
			</td>
			<td width="4%" class="f-12">
				{!! wordwrap(nl2br($rd->sumber_risiko->s_risiko), 14, '<br />', true) !!}
			</td>
			<td width="4%" class="f-12">
				{!! wordwrap(nl2br($rd->sebab), 14, '<br />', true) !!}
			</td>
			<td width="4%"></td>
			<td width="4%" class="f-12">
				{!! nl2br($rd->dampak) !!}
			</td>
			<td width="2%" class="center f-11">
				{{ $rd->uc }}
			</td>
			<td width="4%" class="f-11">
				{!! wordwrap(nl2br($rd->pengendalian), 14, '<br />', true) !!}
			</td>
			<td width="4%" class="center f-11"></td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->l_awal, 2) + 0 }}
			</td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->c_awal, 2) + 0 }}
			</td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->r_awal, 2) + 0 }}
			</td>
			<td width="4%" class="center f-11">
				{!! nl2br($rd->peluang) !!}
			</td>
			<td width="4%" class="center f-11">
				{!! nl2br($rd->tindak_lanjut) !!}
			</td>
			<td width="4%" class="center f-10">
				{!! wordwrap(nl2br($rd->jadwal), 10, '<br />', true) !!}
			</td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->l_akhir, 2) + 0 }}
			</td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->c_akhir, 2) + 0 }}
			</td>
			<td width="1%" class="center f-11">
				{{ number_format($rd->r_akhir, 2) + 0 }}
			</td>
			<td width="4%"></td>
			<td width="4%"></td>
			<td width="4%" class="center f-11">
				{{ $rd->pic }}
			</td>
			<td width="4%" class="center f-11">
				{!! nl2br($rd->dokumen) !!}
			</td>
		</tr>
		@endforeach
	</table>
</body>
