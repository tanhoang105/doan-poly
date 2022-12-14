@extends('Admin.templates.layout')
@section('content')
    {{-- hiển thị massage đc gắn ở session::flash('error') --}}
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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Tai_Khoan') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                    <input value="{{ old('name') ?? request()->name ?? $res->name }}" type="text"
                           name="name" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('name')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                 
                    <input value="" type="password"
                           name="password" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('password')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                    <input value="{{ old('email') ?? request()->email  ?? $res->email}}" type="email"
                           name="email" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('email')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Vai trò <span class="text-danger">*</span></label>
                    <select class="form-control" name="vai_tro_id" id="">
                        @foreach($vaitro as $item)
                            @if($item->id == $res->vai_tro_id)
                                <option selected value=" {{$item->id}}"> {{$item->ten_vai_tro}} </option>
                            @else
                                <option value=" {{$item->id}}"> {{$item->ten_vai_tro}} </option>
                            @endif
                        @endforeach
                    </select>
                    @error('vai_tro_id')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>


            <div class="col-6">

                <div class="mb-3">
                    <label for="" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="sdt" id="" class="form-control" value="{{ old('sdt') ?? request()->sdt ?? $res->sdt }}">
                    @error('sdt')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                    <input value="{{ old('dia_chi') ?? request()->dia_chi ?? $res->dia_chi  }}" type="text" name="dia_chi"
                           class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('dia_chi')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="" class="form-label">Ảnh đại diện <span class="text-danger">*</span></label>
                    <td>
                        <img id="anh" style="border-radius: 100% ; width:100px ; height:100px " src=" {{Storage::URL($res ->hinh_anh)}} " alt="">
                    </td>
                    <div class="pt-3">
                        <input id="hinhanh" value="{{ old('hinh_anh') ?? request()->hinh_anh }}" type="file" name="hinh_anh" accept=".png, .jpg, .jpeg"
                           class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('hinh_anh')
                    <span style="color: red"> {{ $message }} </span>
                    @enderror
                    </div>
                    
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Tai_Khoan')}} ">Quay lại </a>


    </form>
@endsection
