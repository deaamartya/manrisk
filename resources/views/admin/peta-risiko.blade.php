@extends('layouts.user.table')
@section('title', 'Sumber Risiko')

@section('breadcrumb-title')
<h3>Lihat Sumber Risiko</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Sumber Risiko</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="display" id="basic-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Konteks</th>
                  <th>Sumber Risiko</th>
                  <th>L</th>
                  <th>C</th>
                  <th>R</th>
                </tr>
              </thead>
              <tbody>
                @if($s_risiko != null)
                  @foreach($s_risiko as $s)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $s->konteks->konteks }}</td>
                      <td>{{ $s->s_risiko }}</td>
                      <td>{{ number_format($s->l_awal, 2) + 0 }}</td>
                      <td>{{ number_format($s->c_awal, 2) + 0 }}</td>
                      <td>{{ number_format($s->r_awal, 2) + 0 }}</td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script>
  var options = {
    series: [{
    name: "",
    data: []
  },{
    name: "",
    data: []
  },{
    name: "",
    data: []
  }],
    chart: {
    height: 350,
    type: 'scatter',
    zoom: {
      enabled: true,
      type: 'xy'
    }
  },
  xaxis: {
    tickAmount: 10,
    labels: {
      formatter: function(val) {
        return parseFloat(val).toFixed(1)
      }
    }
  },
  yaxis: {
    tickAmount: 7
  }
  };
</script>
@endsection
