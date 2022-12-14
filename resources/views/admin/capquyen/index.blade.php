@extends('Admin.templates.layout')
@section('form-search')
    {{ route('route_BE_Admin_List_Cap_Quyen') }}
@endsection
@section('content')
    {{-- <div class="row p-3">
        <a style="color: red" href=" {{ route('route_Admin_BE_Add_Danh_Muc') }}">
            <button class='btn btn-success'> <i class="fas fa-plus "></i> Thêm</button>

        </a>
    </div> --}}
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
    <form method="post" action="{{ route('route_BE_Admin_Xoa_All_Cap_Quyen') }}" enctype="multipart/form-data">

        @csrf
        <table class="table table-bordered p-5 ">
            <thead>
                <tr>
                    {{-- <th> <input id="check_all" type="checkbox" /></th> --}}
                    <th scope="col">STT</th>

                    <th scope="col">Vai trò </th>
                    <th scope="col">Quyền </th>
                    {{-- <th scope="col">Sửa</th> --}}
                    {{-- <th scope="col">
                        <button class="btn btn-default" type="submit" class="btn" style="">Xóa</button>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $key => $item)
                    <tr>
                        {{-- <td><input class="checkitem" type="checkbox" name="id[]" value="{{ $item->id }}" /></td> --}}
                        <th scope="row"> {{ $loop->iteration }}</th>

                        <td>
                            {{ $item->ten_vai_tro }}
                        </td>
                        <td>
                            <a class="btn btn-primary" style="color: #fff"
                                href="{{ route('route_BE_Admin_Detail_Cap_Quyen', ['id' => $item->id]) }}">Xem</a>

                        </td>
                        {{-- <td> <button class="btn btn-warning"><a
                                   style="color: #fff" href="{{ route('route_Admin_BE_Edit_Danh_Muc', ['id' => $item->id]) }}">
                                    <i class="fas fa-edit "></i> Sửa
                                </a></button></td> --}}
                        {{-- <td> <a onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-danger"
                                style="color: #fff" href="{{ route('route_Admin_BE_Xoa_Danh_Muc', ['id' => $item->id]) }}">
                                <i class="fas fa-trash-alt"></i> Xóa</a>
                        </td> --}}

                    </tr>
                @endforeach

            </tbody>
        </table>
    </form>


    <div class="">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            {{-- {{ $list->appends('params')->links() }} --}}
        </div>
    </div>
@endsection
