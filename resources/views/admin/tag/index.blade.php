@extends('template_admin.home')
@section('sub-judul')
<div class="section-header">
    <h1>Tag</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Tag</div>
        </div>
</div>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
    <a href="{{ route('tag.create') }}" class="btn btn-info btn-sm">Tambah Tag</a>
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
				<th>Nama Tag</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tag as $result => $hasil)
			<tr>
				<td>{{ $result + $tag->firstitem() }}</td>
				<td>{{ $hasil->name }}</td>
				<td>
					<form method="POST" action="{{ route('tag.destroy', $hasil->id) }}">
					@csrf
					@method('delete')
						<a href="{{ route('tag.edit', $hasil->id) }}" class="btn btn-primary btn-sm">Edit</a>
						<button type="submit" class="btn btn-danger btn-sm">Delete</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
{{ $tag->onEachSide(1)->links() }}
@endsection
</div>