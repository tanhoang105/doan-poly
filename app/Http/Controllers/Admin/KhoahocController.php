<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KhoahocRequest;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\DanhMuc;
use App\Models\GiangVien;
use App\Models\KhoaHoc;
use App\Models\Lop;
use App\Models\ThuHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KhoahocController extends Controller
{
    protected $v;
    protected $khoahoc, $lop;

    public function __construct()
    {
        $this->v = [];
        $this->khoahoc  = new KhoaHoc();
        $this->danhmuc = new DanhMuc();
        $this->lop = new Lop();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        
        $this->authorize(mb_strtoupper('xem khóa học'));
        // $this->v['params'] = $request->all();
        $params = [];
        $params['loc'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }
            return $item;
        }, $request->all());
        // dd($params);
        if($request->keyword){
           
            $params['loc']['keyword'] = $request->keyword;
            
        }

        // tìm khóa học đã có lớp 
        $lop = $this->lop->index(null, false, null);
        $arrayIdKhoaHoc = [];
        foreach ($lop as  $itemLop) {
            $arrayIdKhoaHoc[] =  $itemLop->id_khoa_hoc;
        }
        $arrayIdKhoaHoc = array_unique($arrayIdKhoaHoc);
        // $listKh = $this->khoahoc->DanhSachKhoaHocTheoIDKhoa($arrayIdKhoaHoc);
        
        $this->v['arrayIdKhoaHoc'] = $arrayIdKhoaHoc;


        $khoahoc =  $this->khoahoc->index($params, true, 10);
        $this->v['list'] = $khoahoc;

        $this->v['khoa_hoc'] = $this->khoahoc->index(null, false, null);
        $this->v['danh_muc'] = $this->danhmuc->index(null, false, null);

        //        dd($khoahoc);
        return view('admin.khoahoc.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KhoahocRequest $request)
    {
        $this->authorize(mb_strtoupper('thêm khóa học'));

        $this->v['params'] = $request->all();

        $danhmuc = $this->danhmuc->index($this->v['params'], false, null);
        $this->v['danhmuc'] = $danhmuc;


        if ($request->isMethod('POST')) {

            $params = [];
            $params['cols'] = array_map(function ($item) {

                if ($item == '') {
                    $item = null;
                }
                if (is_string($item)) {
                    $item = trim($item);
                }
                return $item;
            }, $request->post());
            unset($params['cols']['_token']);
            // nếu có ảnh
            if ($request->file('hinh_anh')) {
                $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
            }
            $query = $this->khoahoc->create($params);
            if ($query > 0) {
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Khoa_Hoc');
            } else {
                // không thêm thành công bản ghi
                Session::flash('error', 'Thêm Không thành công');
                return redirect()->route('route_BE_Admin_Khoa_Hoc');
            }
        }
        return  view('admin.khoahoc.add', $this->v);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $this->authorize(mb_strtoupper('xem khóa học'));

        // lấy ra 1 bản ghi theo id
        if (!empty($id)) {
            $khoahoc = $this->khoahoc->show($id);
            return $khoahoc;
        } else {
            // nếu không tìm thấy id của bản ghi

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

        $this->authorize(mb_strtoupper('edit khóa học'));

        // lấy ra dữ liệu bản ghi cần chỉnh sửa
        if (!empty($id)) {
            $this->v['params'] = $request->all();

            $danhmuc = $this->danhmuc->index($this->v['params'], false, null);
            $this->v['danhmuc'] = $danhmuc;
            $request->session()->put('id', $id);
            $khoahoc = $this->khoahoc->show($id);
            $this->v['khoahoc'] = $khoahoc;
            return view('admin.khoahoc.update', $this->v);
        } else {
            // nếu không tìm thấy id của bản ghi
            Session::flash('error', 'Lỗi');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KhoahocRequest $request)
    {
        $this->authorize(mb_strtoupper('update khóa học'));

        // sau khi chỉnh sửa xong thì update vào cơ sở dữ liệu
        // cần thực hiện validate
        $id  = session('id');
        $params = [];
        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item  = null;
            }
            if (is_string($item)) {
                $item = $item;
            }

            return $item;
        }, $request->post());
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        if ($request->file('hinh_anh')) {
            $params['cols']['hinh_anh'] = $this->uploadFile($request->file('hinh_anh'));
        }
        // dd($params);
        $query  = $this->khoahoc->saveupdate($params);
        if ($query > 0) {
            Session::flash('success', 'Cập nhập thành công');
            return redirect()->route('route_BE_Admin_Khoa_Hoc');
        } else {
            // update không thành công
            Session::flash('error', 'Cập nhập không thành công');
            return redirect()->route('route_BE_Admin_Khoa_Hoc');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(mb_strtoupper('xóa khóa học'));

        // xóa bản ghi theo id - xóa mềm
        if ($id) {

            $res  = $this->khoahoc->remove($id);
            // dd($res);
            if ($res > 0) {
                // khi xóa khoa học đi thì cần xóa những lớp học của khóa học đó
                $this->lop->remove(null, $id);
                Session::flash('success', 'Xóa thành công');
                return back();
            } else {
                Session::flash('error', 'Xóa không thành công thành công');
                return back();
            }
        }
    }
    // hàm upload ảnh 
    public function uploadFile($file)
    {
        $filename =  time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageKhoaHoc', $filename,  'public');
    }

    public function destroyAll(Request $request)
    {
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa khóa học'));

        if ($request->isMethod('POST')) {
            $params = [];
            $params['cols'] = array_map(function ($item) {
                return $item;
            }, $request->all());
            unset($params['cols']['_token']);
            if (count(($params['cols'])) <= 0) {
                // dd(123);
                Session::flash('error , "Xóa không thành công');
                return back();
            }
            $res = $this->khoahoc->remoAll($params);
            // dd($res);


            if ($res > 0) {
                $this->lop->remoAll(null, $params);
                Session::flash('success , "Xóa thành công');
                return back();
            } else {
                Session::flash('error , "Xóa thành công');
                return back();
            }
        }
    }
}
