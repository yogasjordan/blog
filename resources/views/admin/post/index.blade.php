@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
    <h1>Post</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Post</div>
        </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
    <a href="{{ route('post.create') }}" class="btn btn-info btn-sm">Tambah Post</a>
    <br><br>

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
				<th>Creator</th>
				<th>Thumbnail</th>
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
						<h6><span class="badge badge-info">{{ $tag->name }}</span></h6>
					@endforeach
				</td>
				<td>{{ $hasil->users->name }}</td>
				<td><img src="{{ asset($hasil->gambar) }}" class="img-fluid" style="width: 100px"></td>
				<td>
					<form method="POST" action="{{ route('post.destroy', $hasil->id) }}">
					@csrf
					@method('delete')
						<a href="{{ route('post.edit', $hasil->id) }}" class="btn btn-primary btn-sm">Edit</a>
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