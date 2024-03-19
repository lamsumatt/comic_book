<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use GuzzleHttp\Psr7\Message;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('admincp.category.index')->with(compact('category'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tendanhmuc' => 'required|unique:danhmuc|max:255',
                'slug_danhmuc' => 'required|unique:danhmuc|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tendanhmuc.unique' => 'Tên danh mục đã có, điền tên khác',
                'tendanhmuc.required' => 'không được để trống tên danh mục',
                'slug_danhmuc.unique' => 'không được để trống tên slug danh mục',
                'mota.required' => 'không được để trống mô tả danh mục',
            ]
        );

        $category = new Category();
        $category->tendanhmuc = $data['tendanhmuc'];
        $category->slug_danhmuc = $data['slug_danhmuc'];
        $category->mota = $data['mota'];
        $category->kichhoat = $data['kichhoat'];
        $category->save();
        return redirect()->back()->with('status', 'Đã thêm thành công');
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
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admincp.category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'tendanhmuc' => 'required|max:255',
                'slug_danhmuc' => 'required|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [

                'slug_danhmuc.required' => 'slug danh mục đã có, điền tên khác',
                'tendanhmuc.required' => 'không được để trống tên danh mục',
                'mota.required' => 'không được để trống mô tả danh mục',
            ]
        );

        $category = Category::find($id);
        $category->tendanhmuc = $data['tendanhmuc'];
        $category->slug_danhmuc = $data['slug_danhmuc'];
        $category->mota = $data['mota'];
        $category->kichhoat = $data['kichhoat'];
        $category->save();
        return redirect()->back()->with('status', 'Đã thêm thành công');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('status', 'Đã xóa thành công');
    }
}
