<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <h1 class="h1 mb-1 text-gray-800 text-center">Tambah Data Kategori</h1>
              
               
            </div>
        <div class="card-body">
            
          <form method="post" action="" >
            @csrf
            {{-- @csrf ditambahkan ke codingan form view jika berhubungan dengan database
                    seperti ingin input data ke database --}}

            <div class="form-group">
                <label for="nama">Nama Kategori : </label>
                <input type="text" class="form-control" id="nama" name="kategori" value="{{ old('nama') }}">
            </div>
            
            <input type="submit" class="btn btn-success">
            <a href="{{ route('data-kategori.index') }}" class="btn btn-danger">Kembali</a>
        </form>  
        </div>
    </div>
    </div>
</div>
@endsection