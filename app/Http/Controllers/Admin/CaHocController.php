<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaHocRequest;
use App\Models\CaHoc;
use App\Models\CaThu;
use App\Models\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RequestStack;

class CaHocController extends Controller
{
    protected $v = [];
    protected $cahoc , $lop;
    public function __construct()
    {
        $this->v = [];
        $this->cahoc = new CaHoc();
        $this->lop = new Lop();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(mb_strtoupper('xem ca học') );
        // dd(12);

        // lọc 

        $listLop = $this->lop->index(null, false , null);
        $arrayidCaThu = [];
        // dd($listLop);
        foreach($listLop as  $item){
            $arrayidCaThu[] = $item->ca_thu_id ;
        }
        $arrayidCaThu = array_unique($arrayidCaThu);
        // dd($arrayidCaThu);
        $arrayCaThu = CaThu::whereIn('id' , $arrayidCaThu )->get();
        // dd($arrayCaThu);
        $arrayIdCa = [];
        foreach($arrayCaThu  as $item){
            $arrayIdCa[] = $item->ca_id;
        }
         $arrayIdCa = array_unique($arrayIdCa);

        // dd($arrayIdCa);
        $this->v['arrayIDCa'] = $arrayIdCa;

        // end lọc
        $this->v['params'] = $request->all();
        $this->v['list']  = $this->cahoc->index($this->v['params'], true, 5);

        return view('admin.cahoc.index', $this->v);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CaHocRequest $request)
    {
        $this->authorize(mb_strtoupper('thêm ca học') );

        //
        if ($request->isMethod('POST')) {
            // thêm sản phẩm
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
            $res = $this->cahoc->create($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('success', 'Thêm thành công');
                return redirect()->route('route_BE_Admin_Ca_Hoc');
            } else {
                Session::flash('error', 'Thêm không thành công');
                return redirect()->route('route_BE_Admin_Ca_Hoc');
            }
        }
        return view('admin.cahoc.add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, CaHocRequest $request)
    {
        //
        $this->authorize(mb_strtoupper('edit ca học') );

        if ($id) {
            $request->session()->put('id', $id);
            $res = $this->cahoc->show($id);
            $this->v['cahoc'] = $res;
            return view('admin.cahoc.update', $this->v);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CaHocRequest $request)
    {
        //
        $this->authorize(mb_strtoupper('update ca học') );

        if (session('id')) {
            $id  = session('id');
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
            $params['cols']['id'] = $id;
            $res = $this->cahoc->saveupdate($params);
            if ($res > 0) {
                // thêm thành công
                Session::flash('seccuss', 'Cập nhập thành công');
                return redirect()->route('route_BE_Admin_Ca_Hoc');
            } else {
                Session::flash('error', 'Cập nhập không thành công');
                return redirect()->route('route_BE_Admin_Ca_Hoc');
            }
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
        //
        $this->authorize(mb_strtoupper('xóa ca học') );

        if ($id) {
            $res = $this->cahoc->remove($id);
            if ($res > 0) {
                Session::flash('success', "Xóa thành công");
                return back();
            } else {
                Session::flash('error', "Xóa không thành công");
                return back();
            }
        }
    }

    public function destroyAll(Request $request){
        // dd($request->all);
        // $request  =  $request->all();
        $this->authorize(mb_strtoupper('xóa ca học') );

        if($request->isMethod('POST')){
            $params = [];
            $params['cols'] = array_map(function($item){
                return $item;
            } , $request->all());
            unset($params['cols']['_token']);
            if (count(($params['cols'])) <= 0) {
                // dd(123);
                Session::flash('error , "Xóa không thành công');
                // return back();
            }else {

                $res = $this->cahoc->remoAll($params);
                // dd($res);
    
                if($res > 0){
                    Session::flash('success , "Xóa thành công');
                    // return back();
                }else {
                    Session::flash('error , "Xóa thành công');
                    // return back();
                }
            }
            return back();
          
        }
    }
}
