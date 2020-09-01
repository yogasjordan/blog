@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
   	<div class="section-header-back">
        <a href="{{ route('post.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah Post</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Post</a></div>
        <div class="breadcrumb-item">Tambah Post</div>
    </div>
</div>

@endsection

@section('content')

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
@csrf
		@if(count($errors)>0)
	    	@foreach($errors->all() as $error)
	    		<span class="text-danger">{{ $error }}</span>
	    	@endforeach
	   	@endif
	<div class="form-group">
	    <label>Judul</label>
		<input type="text" class="form-control" name="judul" required="">
	</div>
	<div class="form-group">
		<label>Kategori</label>
        	<select name="category_id" class="form-control selectric" required>
                <option value="" disabled selected>-- Pilih Kategori --</option>
                @foreach($category as $result)
				<option value="{{ $result->id }}">{{ $result->name }}</option>
				@endforeach
            </select>
	</div>
	<div class="form-group">
        <label>Pilih Tags</label>
            <select class="form-control selectric" multiple="" name="tags[]" required>
                <option value="" disabled selected>-- Pilih Tags --</option>
            	@foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
    </div>
	<div class="form-group">
	    <label>Konten</label>
		<textarea class="form-control" name="content" required></textarea>
	</div>
	<div class="form-group row mb-4">
        <label class="col-form-label col-12">Thumbnail</label>
            <div class="col-sm-12">
                <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="gambar" id="image-upload" required />
                </div>
            </div>
    </div>
	<div class="form-group">
		<button class="btn btn-primary btn-block">Simpan Post</button>
	</div>
</form>
@endsection