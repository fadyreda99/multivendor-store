@extends('layouts.mainDashboard')

@section('title', 'Add New Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Add New Category</li>
@endsection

@section('content')

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occured</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="row g-3 needs-validation"
        novalidate>
        @csrf
        <div class="col-md-12 position-relative">
            <label for="validationTooltip01" class="form-label">Category Name</label>
            <input type="text"
                class="form-control 
            @error('name')
                is-invalid
            @enderror"
                id="validationTooltip01" name="name" value="{{ old('name') }}" required>
            <div class="valid-tooltip">
                Looks good!
            </div>
            @error('name')
                <div class="text-danger">
                    {{ $errors->first('name') }}
                </div>
            @enderror
        </div>



        <div class="col-md-12 position-relative mt-3">
            <label for="validationTooltip01" class="form-label">Category Parent</label>
            <select class="form-select col-12 form-select-lg" aria-label="Default select example" name="parent_id"
                style="height: 37px">
                <option selected value="">Main Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" @selected(old('parent_id') == $category->id)>{{ $category['name'] }}</option>
                @endforeach
            </select>
            <div class="valid-tooltip">
                Looks good!
            </div>
        </div>


        <div class="form-floating col-md-12 mt-3">
            <label for="floatingTextarea">Category Description</label>
            <textarea class="form-control" name="description" id="floatingTextarea">{{ old('description') }}</textarea>
        </div>

        <div class="mt-3 col-md-12">
            <label for="formFile" class="form-label">Category Image</label>
            <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
        </div>


        <div class="col-md-12 mt-3">
            <label for="formFile" class="form-label col-md-12">Category Status</label>
            <div class="form-check form-check-inline">
                <label class="form-check-label mr-2" for="inlineRadio1">Archived</label>
                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="archived"
                    @checked(old('status') == 'archived')>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label mr-2" for="inlineRadio2">Active</label>
                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="active"
                    @checked(old('status') == 'active')>
            </div>
        </div>





        <div class="col-12 mt-5">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
    </form>


@endsection
