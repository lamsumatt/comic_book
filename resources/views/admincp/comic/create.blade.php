@extends('layouts.app')
@section('content')
    @include('layouts.nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm truyện</div>
                    {{-- thông báo lỗi  --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('comic.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên truyện</label>
                                <input type="text" name="tentruyen" onkeyup="ChangeToSlug();"
                                    value="{{ old('tentruyen') }}" class="form-control" id="slug"
                                    aria-describedby="emailHelp" placeholder="Tên truyện...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug truyện</label>
                                <input type="text" name="slug_truyen" value="{{ old('slug_danhmuc') }}"
                                    class="form-control" id="convert_slug" aria-describedby="emailHelp"
                                    placeholder="slug truyện...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tóm tắt truyện</label>
                                <textarea class="form-control" rows="5" name="tomtat" id="tomtat" style="resize: none"></textarea>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục truyện</label>
                                <select name="danhmuc" class="custom-select">
                                    @foreach ($danhmuc as $key => $muc)
                                        <option value="{{ $muc->id }}">{{ $muc->tendanhmuc }}</option>\
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh truyện</label>
                                <input type="file" name="hinhanh" class="form-control-file" placeholder="hình ảnh...">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Kích hoạt</label>
                                <select name="kichhoat" class="custom-select">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>

                            <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
