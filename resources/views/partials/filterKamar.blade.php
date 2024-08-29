@foreach ($kamar as $k)
    @php
    $buttonClass = '';

    if (($k->status_transaksi === 'pending' || $k->status_transaksi === 'kosong') && $k->status_kamar === 'kosong') {
        $buttonClass = 'btn btn-success';
    } elseif ($k->status_transaksi === 'checkin' && $k->status_kamar === 'terisi') {
        $buttonClass = 'btn btn-danger';
    } elseif ($k->status_transaksi === 'terima' && $k->status_kamar === 'kosong') {
        $buttonClass = 'btn btn-warning';
    } elseif ($k->status_transaksi === 'kosong' && $k->status_kamar === 'perbaikan') {
        $buttonClass = 'btn btn-secondary';
    }
    @endphp
    <a type="button" class="{{ $buttonClass }} waves-effect waves-light p-1 m-2" style="width: 45px; height:30px;" href="#">
        <h5 class="text-white">{{ $k->nomor_kamar }}</h5>
    </a>
@endforeach