@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
   	<div class="section-header-back">
        <a href="{{ route('user.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">User</a></div>
        <div class="breadcrumb-item">Tambah User</div>
    </div>
</div>
@endsection

@section('content')

<form action="{{ route('user.update', $user->id) }}" method="POST">
@csrf
@method('PUT')
	<div class="form-group">
	    <label>Nama User</label>
		<input type="text" class="form-control" name="name" required="" value="{{ $user->name }}">
		@if(count($errors)>0)
	    	@foreach($errors->all() as $error)
	    		<span class="text-danger">{{ $error }}</span>
	    	@endforeach
	   	@endif
	</div>
	<div class="form-group">
	    <label>Email</label>
		<input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly="">
	</div>
	<div class="form-group">
	    <label>Tipe User</label>
		<select class="form-control selectric" name="tipe" required="">
			<option value="" selected="" disabled="">-- Pilih Tipe User --</option>
			<option value="1"
			@if($user->tipe == 1)
			selected
			@endif
			>Administrator</option>
			<option value="0"
			@if($user->tipe == 0)
			selected
			@endif>Author</option>
		</select>
	</div>
	<div class="form-group">
	    <label>Password</label>
		<input type="text" class="form-control" name="password">
	</div>
	<div class="form-group">
		<button class="btn btn-primary btn-block">Update User</button>
	</div>
</form>
@endsection