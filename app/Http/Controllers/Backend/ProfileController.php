<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;


class ProfileController extends BackendBaseController
{
    protected $panel = 'Profile';  //for section/module
    protected $folder = 'backend.profile.';  //for view file
    protected $base_route = 'backend.profile.';  //for for route method
    protected $folder_name = 'cateprofilegory';
    protected $title;
    protected $model;
    function __construct(){
        parent::__construct();
        $this->model = new Profile();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->title = 'List';
//        $data['rows'] = $this->model->where('status',1)->get();
        $data['rows'] = $this->model->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Create';
        return view($this->__loadDataToView($this->folder . 'create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        //image upload
        if ($request->hasFile('image_file')) {
            $image = $this->uploadImage($request,'image_file');
            $request->request->add(['image' => $image]);
        }

        if ($request->hasFile('profile_image')) {
            $this->uploadImage($request,'profile_image');
        }
        $request->request->add(['created_by' => auth()->user()->id]);
        $data['row'] = $this->model->create($request->all());
        if ($data['row']){
            $request->session()->flash('success_message', $this->panel . ' created successfully');
        } else{
            $request->session()->flash('error_message', $this->panel . ' creation failed');
        }
        return redirect()->route($this->base_route . 'index');
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
        //
        $data['row'] = $this->model->find($id);


        if ($data['row']){
            request()->session()->flash('error_message', $this->panel . ' record not found');
        }
        $this->title = 'Edit';
        return view($this->__loadDataToView($this->folder . 'edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $data['row'] = $this->model->find($id);
        if ($request->hasFile('image_file')) {
            $image = $this->uploadImage($request,'image_file');
            $request->request->add(['image' => $image]);
            if ($image){
                $this->deleteImage($data['row']->image);
            }
        }
        $request->request->add(['updated_by' => auth()->user()->id]);
        if ($data['row']->update($request->all())){
            $request->session()->flash('success_message', $this->panel . ' updated successfully');
        } else{
            $request->session()->flash('error_message', $this->panel . ' update failed');
        }
        return redirect()->route($this->base_route . 'index');
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
        $data['row'] = $this->model->find($id);
        if ($data['row']->delete()){
            request()->session()->flash('success_message', $this->panel . ' deleted successfully');
        } else{
            request()->session()->flash('error_message', $this->panel . ' deletation failed');
        }
        return redirect()->route($this->base_route . 'index');
    }
}
