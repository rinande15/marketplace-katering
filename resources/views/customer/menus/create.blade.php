<form method="POST" action="{{ route('merchant.menus.store') }}" enctype="multipart/form-data">

    @csrf

    <input type="text" name="name" placeholder="Nama menu" class="form-control mb-3">

    <input type="number" name="price" placeholder="Harga" class="form-control mb-3">

    <textarea name="description" placeholder="Deskripsi menu" class="form-control mb-3"></textarea>

    <input type="number" name="stock" placeholder="Stok" class="form-control mb-3">

    <input type="file" name="photo" class="form-control mb-3">

    <button class="btn btn-primary">
        Upload Menu
    </button>

</form>