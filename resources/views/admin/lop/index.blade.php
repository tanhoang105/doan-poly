@extends('Admin.templates.layout')
@section('content')
    <div class="row p-3">
        <a href="{{ route('route_BE_Admin_Add_Lop') }}">
            <button class='btn btn-success'>Thêm</button>
        </a>
    </div>
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Khóa học </th>
                <th scope="col">Tên Lớp </th>
                <th scope="col">Giá </th>
                <th scope="col">Số lượng học viên </th>
                <th scope="col">Ngày bắt đầu </th>
                <th scope="col">Ngày kết thúc </th>
                <th scope="col">Giảng viên </th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $key++ }}</th>
                    <td> {{ $item->ten_khoa_hoc }}</td>
                    <td> {{ $item->ten_lop }}</td>
                    <td> {{ $item->gia }}</td>
                    <td> {{ $item->so_luong }}</td>
                    <td> {{ $item->ngay_bat_dau }}</td>
                    <td> {{ $item->ngay_ket_thuc }}</td>
                    <td>
                        @foreach ($giangvien as $gv)
                            @if ($item->id_giang_vien == $gv->id)
                                {{ $gv->ten_giang_vien }}
                            @endif
                        @endforeach
                    </td>
                    <td> <button class="btn btn-warning">
                            <a href="{{ route('route_BE_Admin_Edit_Lop', ['id' => $item->id_lop]) }}"> Sửa
                            </a>
                        </button>
                    </td>
                    <td> <button onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"><a
                                href="{{ route('route_BE_Admin_Xoa_Lop', ['id' => $item->id_lop]) }}">
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