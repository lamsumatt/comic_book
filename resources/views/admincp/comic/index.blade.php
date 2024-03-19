@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liệt kê truyện</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-triped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Slug truyện</th>
                                    <th scope="col">Tóm tắt</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Kích hoạt</th>
                                    <th scope="col">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_comic as $key => $comic)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $comic->tentruyen }}</td>
                                        <td><img src="{{ asset('public/uploads/truyen/' . $comic->hinhanh) }}"
                                                width="200px" height="auto"></td>
                                        <td>{{ $comic->slug_truyen }}</td>
                                        <td>{{ $comic->tomtat }}</td>
                                        <td>{{ $comic->category->tendanhmuc }}</td>
                                        <td>
                                            @if ($comic->kichhoat == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-success">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('comic.edit', ['comic' => $comic->id]) }}"
                                                class="btn btn-primary">edit</a>
                                            <form action="{{ route('comic.destroy', ['comic' => $comic->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có chắc muốn xóa ?')"
                                                    class="btn btn-danger">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
