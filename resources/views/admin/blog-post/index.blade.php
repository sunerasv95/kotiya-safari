@extends('layouts.admin-app')
@section('page-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('main-content')
<div class="row mt-2">
    <div class="col-md-12">
        @include('partial-views.alerts.alert-danger')
        @include('partial-views.alerts.alert-success')
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Blog Posts</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('create-post') }}" class="btn btn-sm btn-success">
            New Post
        </a>
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5">
    <div class="btn-toolbar">
        <select class="form-select" aria-label="Default select example">
            <option selected>Filter by Status</option>
            <option value="3">All</option>
            <option value="1">Published</option>
            <option value="2">Unpublished</option>
        </select>
    </div>
</div>
<div class="table-responsive">
    <table id="blog-post-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Post Cover</th>
                <th scope="col">Post Title</th>
                <th scope="col">Status</th>
                <th scope="col">Pubished At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($posts))
            @foreach ($posts as $post)
            <tr>
                <td><img src="{{ $post['thumbnail_url'] }}" alt="cover_image" width="90px"></td>
                <td>{{ $post['post_title'] }}</td>
                <td>
                    @if ($post['is_published'] === 0 && $post['is_deleted'] !== 1)
                    <span class="badge bg-danger text-white">Unpublished</span>
                    @elseif($post['is_published'] === 1 && $post['is_deleted'] !== 1)
                    <span class="badge bg-success text-white">Published</span>
                    @else
                    <span class="badge bg-secondary text-dark">N/A</span>
                    @endif
                </td>
                <td>{{ $post['published_at'] }}</td>
                <td>
                    <a href="" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection

@section('page-scripts')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#blog-post-table').DataTable();
    });
</script>
@endsection
