@extends('Admin.templates.layout')
@section('content')
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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Xep_Lop') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ngày đăng ký <span class="text-danger">*</span></label>
                    <input value="{{ old('ngay_dang_ky') ?? (request()->ngay_dang_ky ?? $res->ngay_dang_ky) }}"
                        type="date" name="ngay_dang_ky" class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ngay_dang_ky')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Lớp học <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_lop" id="">
                        @foreach ($listLop as $item)
                            @if ($res->id_lop == $item->id)
                                <option selected value="{{ $item->id }}">{{ $item->ten_lop }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ten_lop }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('id_lopc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

            
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Phòng học <span class="text-danger">*</span></label>
                    <select class="form-control" name="id_phong_hoc" id="">
                        @foreach ($listPhongHoc as $item)
                            @if ($res->id_phong_hoc == $item->id)
                                <option selected value="{{ $item->id }}">{{ $item->ten_phong }}</option>
                            @else
                                <option  value="{{ $item->id }}">{{ $item->ten_phong }}</option>
                            @endif
                        @endforeach
                    </select>

                    @error('gia')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a style="color: aliceblue" class="btn btn-danger" href=" {{route('route_BE_Admin_Xep_Lop')}} ">Quay lại </a>


    </form>
@endsection
