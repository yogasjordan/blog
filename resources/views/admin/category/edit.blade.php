@extends('template_admin.home')
@section('sub-judul')

<div class="section-header">
   	<div class="section-header-back">
        <a href="{{ route('category.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Kategori</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Kategori</a></div>
        <div class="breadcrumb-item">Edit Kategori</div>
    </div>
</div>

@endsection

@section('content')

<form action="{{ route('category.update', $category->id) }}" method="POST">
@csrf
@method('patch')
	<div class="form-group">
	    <label>Kategori</label>
		<input type="text" class="form-control" name="name" required="" value="{{ $category->name }}">
		@if(count($errors)>0)
	    	@foreach($errors->all() as $error)
	    		<span class="text-danger">{{ $error }}</span>
	    	@endforeach
	   	@endif
	</div>
	<div class="form-group">
		<button class="btn btn-primary btn-block">Update Kategori</button>
	</div>
</form>
@endsection