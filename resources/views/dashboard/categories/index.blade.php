@extends('layouts.mainDashboard')

@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="text-right mb-4">
        <a href="{{ route('categories.create') }}" class="btn btn-lg btn-outline-primary">
            Add New Category
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2">operations</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['parent_id'] }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $category['image']) }}" style="height: 50px; width: 50px"
                            alt="">
                    </td>
                    <td>{{ $category['status'] }}</td>
                    <td>{{ $category['created_at'] }}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-outline-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <h2 class="text-center">
                            There Is No Categories
                        </h2>
                    </td>
                </tr>
            @endforelse


        </tbody>
    </table>


@endsection
