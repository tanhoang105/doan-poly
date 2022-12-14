@extends('Admin.templates.layout')

@section('form-search')
    {{route('route_BE_Admin_List_Lop')}}
@endsection

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

    <div class="show-calendar">
          {!! $lich  !!}
    </div>

    <div class="w-100" style="height: 70px"></div>
@endsection
