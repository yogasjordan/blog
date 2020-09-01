@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
   	<div class="section-header-back">
        <a href="{{ route('tag.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Tag</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Tag</a></div>
        <div class="breadcrumb-item">Edit Tag</div>
    </div>
</div>@endsection

@section('content')

<form action="{{ route('tag.update', $tag->id) }}" method="POST">
@csrf
@method('patch')
	<div class="form-group">
	    <label>Tag</label>
		<input type="text" class="form-control" name="name" required="" value="{{ $tag->name }}">
		@if(count($errors)>0)
	    	@foreach($errors->all() as $error)
	    		<span class="text-danger">{{ $error }}</span>
	    	@endforeach
	   	@endif
	</div>
	<div class="form-group">
		<button class="btn btn-primary btn-block">Update Tag</button>
	</div>
</form>
@endsection