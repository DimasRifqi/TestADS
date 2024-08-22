@extends('components.app')

@section('content')
    <!-- Modal Tambah -->
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
                            <label for="productCategory" class="form-label">Kategori Produk</label>
                            <select class="form-select" id="productCategory" name="produk_kategori_id" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
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
                            <input type="number" class="form-control" id="productPrice" name="harga" step="0.001"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="productDescription" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productPhoto" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="productPhoto" name="foto" accept="image/*"
                                onchange="previewImage(event)">
                        </div>
                        <div class="mb-3">
                            <img id="photoPreview" src="#" alt="Preview Foto"
                                style="display: none; max-width: 100%; height: auto;">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="response" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Produk</h5>
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editMenuForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editProductId" name="id">
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">Kategori Produk</label>
                            <select class="form-select" id="editProductCategory" name="produk_kategori_id" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="editProductName" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductStock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="editProductStock" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="editProductPrice" name="harga"
                                step="0.001" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editProductDescription" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPhoto" class="form-label">Foto Produk</label>
                            <input type="file" class="form-control" id="editProductPhoto" name="foto"
                                accept="image/*" onchange="previewEditImage(event)">
                        </div>
                        <div class="mb-3">
                            <img id="editPhotoPreview" src="#" alt="Preview Foto"
                                style="display: none; max-width: 100%; height: auto;">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                    <div id="editResponse" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Produk -->
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center mt-5">
                <h2>Our Menu</h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                <li data-filter=".burger">Burger</li>
                <li data-filter=".pizza">Pizza</li>
                <li data-filter=".pasta">Pasta</li>
                <li data-filter=".fries">Fries</li>
                <button class="ml-3 btn btn-success rounded-btn" data-bs-toggle="modal"
                    data-bs-target="#addMenuModal">Tambah Menu</button>
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    @foreach ($data as $produk)
                        <div class="col-sm-6 col-lg-4 all {{ strtolower($produk->ProdukKategori->nama) }}">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img src="{{ url('asset_produk/foto_produk') }}/{{ $produk->foto }}"
                                            alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>{{ $produk->nama }}</h5>
                                        <p>{{ $produk->deskripsi }}</p>
                                        <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                                        <div>
                                            <h6>RP. {{ number_format($produk->harga) }}</h6>
                                            <div class="mt-3">
                                                <a href="#" onclick="openEditModal({{ json_encode($produk) }})"><i
                                                        class="fa fa-edit fa-lg text-warning mr-3"></i></a>
                                                <a href="#" onclick="deleteProduct({{ $produk->id }})"><i
                                                        class="fa fa-trash fa-lg text-danger"></i></a>
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
                <a href="">View More</a>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

    <script>
        document.getElementById('addMenuForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const responseDiv = document.getElementById('response');
            responseDiv.innerHTML = 'Sending data...';

            try {
                const response = await fetch('{{ route('produk.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const result = await response.json();
                if (response.ok) {
                    responseDiv.innerHTML = 'Product added successfully!';
                    location.reload();
                } else {
                    responseDiv.innerHTML = `Error: ${result.message}`;
                }
            } catch (error) {
                responseDiv.innerHTML = `Error: ${error.message}`;
            }
        });

        document.getElementById('editMenuForm').addEventListener('submit', async function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const productId = document.getElementById('editProductId').value;
            const responseDiv = document.getElementById('editResponse');
            responseDiv.innerHTML = 'Sending data...';

            try {
                const response = await fetch(`/produk/${productId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'X-HTTP-Method-Override': 'PUT'
                    }
                });

                const result = await response.json();
                if (response.ok) {
                    responseDiv.innerHTML = 'Product updated successfully!';
                    location.reload();
                } else {
                    responseDiv.innerHTML = `Error: ${result.message}`;
                }
            } catch (error) {
                responseDiv.innerHTML = `Error: ${error.message}`;
            }
        });

        // Menangani preview gambar
        function previewImage(event) {
            const photoPreview = document.getElementById('photoPreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        function previewEditImage(event) {
            const editPhotoPreview = document.getElementById('editPhotoPreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editPhotoPreview.src = e.target.result;
                    editPhotoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        function openEditModal(product) {
            document.getElementById('editProductId').value = product.id;
            document.getElementById('editProductName').value = product.nama;
            document.getElementById('editProductStock').value = product.stok;
            document.getElementById('editProductPrice').value = product.harga;
            document.getElementById('editProductDescription').value = product.deskripsi;
            document.getElementById('editProductCategory').value = product.produk_kategori_id;

            const editPhotoPreview = document.getElementById('editPhotoPreview');
            editPhotoPreview.src = `/asset_produk/foto_produk/${product.foto}`;
            editPhotoPreview.style.display = 'block';

            const editMenuModal = new bootstrap.Modal(document.getElementById('editMenuModal'));
            editMenuModal.show();
        }

        async function deleteProduct(id) {
            if (!confirm('Are you sure you want to delete this product?')) {
                return;
            }

            const responseDiv = document.getElementById('response'); // Menampilkan pesan

            try {
                const response = await fetch(`/produk/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    responseDiv.innerHTML = 'Product deleted successfully!';
                    // Hapus elemen produk dari daftar jika berhasil
                    const productItem = document.querySelector(`.box[data-id="${id}"]`);
                    if (productItem) {
                        productItem.remove();
                    }
                } else {
                    const result = await response.json();
                    responseDiv.innerHTML = `Error: ${result.message}`;
                }
            } catch (error) {
                responseDiv.innerHTML = `Error: ${error.message}`;
            }
        }

        }
    </script>
@endsection
