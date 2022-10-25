@extends('Admin.templates.layout')
@section('content')

    <div class="row p-3">
        <button class="btn btn-primary"><a style="color: red" href=" {{route('route_Admin_BE_Add_Danh_Muc')}}">Thêm</a></button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên danh mục </th>

                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $key++ }}</th>
                    <td> {{ $item->ten_danh_muc }}</td>
                    <td> <button class="btn btn-warning"><a
                                href="{{ route('route_Admin_BE_Edit_Danh_Muc', ['id' => $item->id]) }}"> Sửa
                            </a></button></td>
                    <td> <button class="btn btn-danger"><a
                                href="{{ route('route_Admin_BE_Xoa_Danh_Muc', ['id' => $item->id]) }}">
                                Xóa</a></button></td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('extParams')->links() }}
        </div>
    </div>
@endsection
