@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-9 offset-md-2 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <img src="{{ asset('storage/site/excel.png') }}" class="img-fluid" style="max-width: 150px;" alt="Upload Image">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title text-center mb-4">Загрузка файла</h5>
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="file" id="fileUpload" required>
                                    <label class="form-label" for="fileUpload">Выберите файл</label>
                                    @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Загрузить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection