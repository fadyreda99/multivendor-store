@extends('layouts.mainDashboard')

@section('title', 'edit Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">edit Category</li>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occured</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" enctype="multipart/form-data" action="{{ route('categories.update', ['category' => $category->id]) }}"
        class="row g-3 needs-validation" novalidate>
        @csrf
        @method('patch')
        <div class="col-md-12 position-relative">
            <label for="validationTooltip01" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="validationTooltip01" name="name" value="{{ $category->name }}"
                required>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>



        <div class="col-md-12 position-relative mt-3">
            <label for="validationTooltip01" class="form-label">Category Parent</label>
            <select class="form-select col-12 form-select-lg" aria-label="Default select example" name="parent_id"
                style="height: 37px">
                <option selected value="">Main Category</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>


        <div class="form-floating col-md-12 mt-3">
            <label for="floatingTextarea">Category Description</label>
            <textarea class="form-control" name="description" id="floatingTextarea">{{ $category->description }}</textarea>
        </div>


        @if ($category->image)
            <div class="mt-3 col-md-12">
                <img src="{{ asset('storage/' . $category['image']) }}" style="height: 100px; width: 100px" alt="">
            </div>
        @endif
        <div class="mt-3 col-md-12">
            <label for="formFile" class="form-label">Category Image</label>
            <input class="form-control" type="file" id="formFile" name="image">
        </div>


        <div class="col-md-12 mt-3">
            <label for="formFile" class="form-label col-md-12">Category Status</label>
            <div class="form-check form-check-inline">
                <label class="form-check-label mr-2" for="inlineRadio1">Archived</label>
                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="archived"
                    @checked($category->status == 'archived') {{-- {{ $category->status == 'archived' ? 'checked' : '' }} --}}>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label mr-2" for="inlineRadio2">Active</label>
                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="active"
                    @checked($category->status == 'active') {{-- {{ $category->status == 'active' ? 'checked' : '' }} --}}>
            </div>
        </div>





        <div class="col-12 mt-5">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>


@endsection
