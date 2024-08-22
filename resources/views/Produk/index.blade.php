@extends('components.app')

@section('content')

<!-- Modal -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Tambah Menu</h5>
                <button type="button" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times text-danger"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMenuForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <label for="productCategory" class="form-label me-2 mr-3">Kategori Produk</label>
                            <select class="form-select" id="productCategory" name="produk_kategori_id" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="productName" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="productStock" name="stok" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="productPrice" name="harga" step="0.001" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="productDescription" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPhoto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" id="productPhoto" name="foto" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <img id="photoPreview" src="#" alt="Preview Foto" style="display: none; max-width: 100%; height: auto;">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <div id="response" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>











<section class="food_section layout_padding-bottom">
    <div class="container">
        <div class="heading_container heading_center mt-5">
            <h2>
                Our Menu
            </h2>
        </div>

        <ul class="filters_menu">
            <li class="active" data-filter="*">All</li>
            <li data-filter=".burger">Burger</li>
            <li data-filter=".pizza">Pizza</li>
            <li data-filter=".pasta">Pasta</li>
            <li data-filter=".fries">Fries</li>

            <button class="ml-3 btn btn-success rounded-btn" data-bs-toggle="modal" data-bs-target="#addMenuModal">Tambah Menu</button>
        </ul>

        <div class="filters-content">
            <div class="row grid">
                @foreach ($data as $produk)
                    <div class="col-sm-6 col-lg-4 all {{ strtolower($produk->ProdukKategori->nama) }}">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="{{ url('asset_produk/foto_produk') }}/{{ $produk->foto }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $produk->nama }}
                                    </h5>
                                    <p>{{ $produk->deskripsi }}</p>
                                    <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                                    <div>
                                        <h6>
                                            RP. {{ number_format($produk->harga, 3) }}
                                        </h6>

                                        <div class="mt-3">
                                            <a href="#">
                                                <i class="fa fa-edit fa-lg text-warning mr-3"></i>
                                            </a>
                                            <a href="#">
                                                <i class="fa fa-trash fa-lg text-danger"></i>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="btn-box">
            <a href="">
                View More
            </a>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

<script>
    document.getElementById('addMenuForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this); // Mengambil data dari formulir
        const responseDiv = document.getElementById('response');
        responseDiv.innerHTML = 'Sending data...';

        try {
            const response = await fetch('{{ route('produk.store') }}', { // Gunakan route yang benar
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const result = await response.json();
            if (response.ok) {
                responseDiv.innerHTML = 'Data berhasil dikirim!';
                // Menutup modal
                $('#addMenuModal').modal('hide');
                // Mengalihkan pengguna ke halaman produk.index
                window.location.href = '{{ route('produk.index') }}'; // Ganti dengan route yang sesuai
            } else {
                responseDiv.innerHTML = 'Error: ' + result.message;
            }
        } catch (error) {
            responseDiv.innerHTML = 'Error: ' + error.message;
        }
    });

    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const photoPreview = document.getElementById('photoPreview');
            photoPreview.src = e.target.result;
            photoPreview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>


@endsection


