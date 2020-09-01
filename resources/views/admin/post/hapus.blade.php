@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
    <h1>Post Yang Sudah Dihapus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Post</div>
        </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

    @if(Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		{{ Session('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
   			<span aria-hidden="true">&times;</span>
  		</button>
	</div>
	@endif

	<table class="table table-striped table-hover table-sm table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Judul</th>
				<th>Kategori</th>
				<th>Tags</th>
				<th>Gambar</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($post as $result => $hasil)
			<tr>
				<td>{{ $result + $post->firstitem() }}</td>
				<td>{{ $hasil->judul }}</td>
				<td>{{ $hasil->category->name }}</td>
				<td>@foreach($hasil->tags as $tag)
					<ul>
						<li>{{ $tag->name }}</li>
					</ul>
					@endforeach
				</td>
				<td><img src="{{ asset($hasil->gambar) }}" class="img-fluid" style="width: 100px"></td>
				<td>
					<form method="POST" action="{{ route('post.kill', $hasil->id) }}">
					@csrf
					@method('delete')
						<a href="{{ route('post.restore', $hasil->id) }}" class="btn btn-info btn-sm">Restore</a>
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{{ $post->onEachSide(1)->links() }}
@endsection
</div>