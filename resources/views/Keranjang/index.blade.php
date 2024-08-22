@extends('components.app')

@section('content')

    <br>
    <br>

    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card shadow-lg">
                    <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                        <div class="col">
                            <p class="text-muted space mb-0 shop">KERANJANG FEANE</p>
                        </div>
                        <div class="col">
                            <div class="row justify-content-start">
                                <div class="col">
                                    <img class="irc_mi img-fluid cursor-pointer"
                                        src="{{ asset('asset_produk/images/favicon.png') }}" width="5%" height="5%">
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-bell"></i>
                        </div>
                    </div>

                    <div class="row mx-auto justify-content-center text-center">
                        <div class="col-12 mt-3">
                            <nav aria-label="breadcrumb" class="second">
                                <ol class="breadcrumb indigo lighten-6 first">
                                    <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase"
                                            href="{{ url('/') }}"><span class="mr-md-3 mr-1">PILIH
                                                PRODUK</span></a><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </li>

                                    <li class="breadcrumb-item font-weight-bold"><a
                                            class="black-text text-uppercase active-2" href="#"><span
                                                class="mr-md-3 mr-1">KERANJANG</span></a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row justify-content-between mt-3 ml-3 mr-3">
                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                                <div class="card-header bg-white border-0">
                                    <h5 class="card-title mb-0 text-info">PESANAN ANDA</h5>
                                    <hr class="my-2">
                                </div>
                                <div class="card-body pt-0">
                                    @if ($keranjang->isEmpty())
                                        <p class="text-center">Keranjang belanja kosong.</p>
                                    @else
                                        @foreach ($keranjang as $data)
                                            <div class="row justify-content-between align-items-center mb-3">
                                                <div class="col-auto mb-3">
                                                    <div class="media">
                                                        <img class="img-fluid"
                                                            src="{{ url('asset_produk/foto_produk') }}/{{ $data->produk->foto }}"
                                                            width="50" height="50" alt="{{ $data->produk->nama }}">
                                                        <div class="media-body ml-2">
                                                            <h6 class="mt-0 mb-1">{{ $data->produk->nama }}</h6>
                                                            <p class="mb-0 text-muted" style="font-size: 10px;">
                                                                {{ $data->produk->deskripsi }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm btn-decrease"
                                                                data-id="{{ $data->id }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </span>
                                                        <p class="mx-2 my-0 boxed-1" id="qty-{{ $data->id }}">{{ $data->qty }}</p>
                                                        <span class="input-group-btn">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary btn-sm btn-increase"
                                                                data-id="{{ $data->id }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    
                                                    @php
                                                        $hargaSementara = $data->qty * $data->produk->harga;
                                                    @endphp
                                                    <p class="mb-0 ml-2" id="total-{{ $data->id }}"><b>Rp. {{ number_format($hargaSementara) }}</b></p>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                        @endforeach


                                        <div class="row justify-content-between">
                                            <div class="col-auto">
                                                <p><b>Total</b></p>
                                            </div>
                                            <div class="col-auto">
                                                <p class="mb-0"><b id="totalHarga">Rp. {{ number_format($totalHarga) }}</b></p>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="row">
                                            <div class="col-md-7 col-lg-6 mx-auto">
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="total" value="#">
                                                    <button type="submit" class="btn btn-block btn-outline-primary btn-lg">
                                                        BUAT PESANAN
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 mb-5">
                            <div class="card border-0 shadow-sm" style="border-radius: 10px;">
                                <div class="card-header bg-white border-0">
                                    <h5 class="card-title mb-0 text-info">PESANAN DETAIL :</h5>
                                    <hr class="my-2">
                                </div>
                                <div class="card-body">
                                    @if ($keranjang->isEmpty())
                                        <p class="text-center">Data kosong</p>
                                    @else
                                    <div class="row bg-light p-3" style="border-radius: 10px;">
                                        @foreach ($keranjang as $K)
                                            <div class="col-12" id="detail-{{ $K->id }}">
                                                <p class="mb-1 text-primary"><i class="fa fa-map-marker mr-2"></i><b>Produk:</b></p>
                                                <p class="ml-3">{{ $K->Produk->nama }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-success"><i class="fa fa-tag mr-2"></i><b>Kategori:</b></p>
                                                <p class="ml-3">{{ $K->Produk->ProdukKategori->nama }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-success"><i class="fa fa-cube mr-2"></i><b>Jumlah:</b></p>
                                                <p class="ml-3" id="detail-qty-{{ $K->id }}">{{ $K->qty }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-warning"><i class="fa fa-calendar mr-2"></i><b>Tanggal:</b></p>
                                                <p class="ml-3">{{ $K->created_at->format('d M Y') }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-1 text-info"><i class="fa fa-dollar mr-2"></i><b>Harga:</b></p>
                                                @php
                                                    $hargaSementara = $K->qty * $K->produk->harga;
                                                @endphp
                                                <p class="ml-3" id="detail-total-{{ $K->id }}">Rp. {{ number_format($hargaSementara) }}</p>
                                            </div>
                                        @endforeach
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengupdate kuantitas
            function updateQty(id, action) {
                $.ajax({
                    url: '{{ route('keranjang.updateQty') }}', // Ganti dengan route yang sesuai
                    method: 'POST',
                    data: {
                        id: id,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            if (response.itemDeleted) {
                                // Menghapus item dari tampilan jika dihapus
                                $('#item-' + id).remove();
                            } else {
                                // Mengupdate kuantitas di tampilan
                                $('#qty-' + id).text(response.qty);
                                $('#total-' + id).text('Rp. ' + response.totalPrice);
                            }
                            $('#totalHarga').text('Rp. ' + response.grandTotal);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            }

            // Klik ikon plus
            $('.btn-increase').on('click', function() {
                var id = $(this).data('id');
                updateQty(id, 'increase');
            });

            // Klik ikon minus
            $('.btn-decrease').on('click', function() {
                var id = $(this).data('id');
                updateQty(id, 'decrease');
            });
        });
    </script>






@endsection
