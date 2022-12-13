@extends('Admin.templates.layout')

@section('form-search')
    {{route('route_BE_Admin_Banner')}}
@endsection
@section('content')
    <div class="row p-3">
        <a href=" {{ route('route_BE_Admin_Add_Chinh_Sach') }} "><button class="btn btn-primary">Thêm</button></a>
    </div>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif


    {{-- hiển thị message đc gắn ở session::flash('success') --}}

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Đối tượng áp dụng </th>
                <th scope="col"> Xem nội dung </th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <th scope="row"> {{ $loop->iteration }}</th>
                    <td> {{$item->doi_tuong_ap_dung}} </td>
                    <td> <a class="btn btn-primary" href=" {{route('route_BE_Admin_Xem_Noi_Dung' , ['id' => $item->id])}} ">Xem nội dung</a> </td>
                    <td>
                        <a class="btn btn-success" style="color: aliceblue"
                            href=" {{ route('route_BE_Admin_Edit_Chinh_Sach', ['id' => $item->id]) }} ">Sửa</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" style="color: aliceblue"
                            onclick="return confirm('Bạn có chắc muốn xóa ?')"
                            href=" {{ route('route_BE_Admin_Xoa_Chinh_Sach', ['id' => $item->id]) }} ">Xóa</a>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{ $list->appends('params')->links() }}
        </div>
    </div>
@endsection
