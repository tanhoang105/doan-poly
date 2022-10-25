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
    <form class="p-5" action=" {{ route('route_BE_Admin_Update_Khoa_Hoc') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            @csrf
            <div class="col-6">

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Tên Khóa Học</label>
                    <input value="{{ old('ten_khoa_hoc') ?? $khoahoc->ten_khoa_hoc }}" type="text" name="ten_khoa_hoc"
                        class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Danh Mục</label>
                    <select class="form-control" name="id_danh_muc" id="">
                        @foreach ($danhmuc as $item)
                            @if ($item->id == $khoahoc->id_danh_muc)
                                <option selected value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->ten_danh_muc }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('ten_khoa_hoc')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Mô Tả</label>
                    <textarea class="form-control" name="mo_ta" id="">{{$khoahoc->mo_ta}}</textarea>
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="chuyenBay" class="form-label">Ảnh</label>
                    <input value="{{ old('hinh_anh') ?? $khoahoc->hinh_anh }}" type="file" name="hinh_anh"
                    class="form-control" id="" aria-describedby="emailHelp">
                    {{-- hiển thị lỗi validate -  funciton message trong file DanhMucRequest --}}
                    <img width="200px" src="{{ Storage::url($khoahoc->hinh_anh)}}" alt=""><br>
                    @error('hinh_anh')
                        <span style="color: red"> {{ $message }} </span>
                    @enderror
                </div>

                


            </div>

        </div>
        <button type="submit" class="btn btn-primary">Cập nhập</button>

    </form>
@endsection