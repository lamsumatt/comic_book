<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Category;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_comic = Comic::with('category')->orderby('id', 'desc')->get();
        return view('admincp.comic.index')->with(compact('list_comic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = Category::orderBy('id', 'desc')->get();
        return view('admincp.comic.create')->with(compact('danhmuc'));
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
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100,
                                max_width=1000,max_height=1000',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
            ],
            [
                'tentruyen.unique' => 'Tên truyện đã có, điền tên khác',
                'tentruyen.required' => 'không được để trống tên truyện',
                'slug_truyen.unique' => 'không được để trống slug truyện',
                'hinhanh.required' => 'không được để trống hình ảnh',
                'tomtat.required' => 'không được để trống tóm tắt truyện',
            ]
        );
        $comic = new Comic();
        $comic->tentruyen = $data['tentruyen'];
        $comic->slug_truyen = $data['slug_truyen'];
        $comic->tomtat = $data['tomtat'];
        $comic->kichhoat = $data['kichhoat'];
        $comic->danhmuc_id = $data['danhmuc'];

        // add image into folder\
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $comic->hinhanh = $new_image;
        // enctype="multipart/form-data";
        $comic->save();
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
        $comic = Comic::find($id);
        $danhmuc = Category::orderBy('id', 'desc')->get();
        return view('admincp.comic.edit')->with(compact('comic', 'danhmuc'));
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
                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
            ],
            [
                'tentruyen.required' => 'không là báo cáo tên truyện',
                'slug_truyen.required' => 'không là báo cáo slug truyện',
                'tomtat.required' => 'không là báo cáo tóm tắt truyện',
            ]
        );
        $comic = Comic::find($id);
        $comic->tentruyen = $data['tentruyen'];
        $comic->slug_truyen = $data['slug_truyen'];
        $comic->tomtat = $data['tomtat'];
        $comic->kichhoat = $data['kichhoat'];
        $comic->danhmuc_id = $data['danhmuc'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comic = Comic::find($id);
        $comic->delete();
        return redirect()->back()->with('status', 'Đã xóa thành công');
    }
}
