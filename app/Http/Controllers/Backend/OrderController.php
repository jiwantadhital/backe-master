<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\OrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Province;

class OrderController extends BackendBaseController
{
    protected $panel = 'Order'; //for section module
    protected $folder = 'backend.order.'; //for view file
    protected $base_route= 'backend.order.'; //for route method
    protected $title;
    protected  $model;

    function __construct()
    {
        $this->model = new Order();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rows'] = $this->model->all();
        $this->title = 'List';

        return view($this->__loadDataToView($this->folder.'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createOrder(Request $request){
        try{
       $data =  Order::create([
            "user_id" => $request->user_id,
            "address" => $request->address,
            "order_code" => $request->order_code,
            "order" => $request->order,
            "items" => $request->items,
            "discount" => $request->discount,
            "shipping_cost" => $request->shipping_cost,
            "total_price" => $request->total_price,
            "order_status_id" => $request->order_status_id,
            "payment_code" => $request->payment_code,
            "created_by" => $request->created_by
        ]);
        return response()->json([
            'message' => "success",
        ]);
    }
    catch(e){
        return response()->json([
            'message' => "failure",
        ]);
    }

    }
    public function updateOrder(Request $request,$id){
        try{
        $data['row'] = $this->model->find($id);
        $data['row']->update($request->only(['order_status_id']));
        return response()->json([
            'message' => "success",
        ]);
    }
    catch(e){
        return response()->json([
            'message' => "failure",
        ]);
    }
     }

    public function create()
    {
        $this->title = 'Add';
        $data['order_status'] = OrderStatus::pluck('name','id');
        $data['payment_methods'] = Payment::pluck('name','id');
        return view($this->__loadDataToView($this->folder.'create'),compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $request->request->add(['created_by'=>auth()->user()->id]);
        $data['row'] = $this->model->create($request->all());
        if ($data['row']){
            $request->session()->flash('success', $this->panel.' created successfully');
        } else{
            $request->session()->flash('error', $this->panel.' creation failed');
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
        $data['row'] = $this->model->find($id);
        if (!$data['row']){
            request()->session()->flash('error', 'Invalid request');
            return redirect()->route($this->folder.'index');
        }
        $this->title = 'View';
        return view($this->__loadDataToView($this->folder.'show'),compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['provinces'] = Province::pluck('name','id');

        $data['row'] = $this->model->find($id);
        if(!$data['row']){
            request()->session()->flash('error_message', $this->panel.' record not found');
        }
        $this->title = 'Edit';
        return view($this->__loadDataToView($this->folder.'edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $data['row'] = $this->model->find($id);
        $request->request->add(['updated_by'=>auth()->user()->id]);
        if ($data['row']->update($request->all())){
            $request->session()->flash('success', $this->panel.' updated successfully');
        } else{
            $request->session()->flash('error', $this->panel.' update failed');
        }
        return redirect()->route($this->base_route.'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['row'] = $this->model->find($id);
        if ($data['row']->delete()){
            request()->session()->flash('success', $this->panel.' deleted successfully');
        } else{
            request()->session()->flash('error', $this->panel.' delete failed');
        }
        return redirect()->route($this->base_route.'index');
    }

    public function trash(){
        $this->title = 'Trash List';
        $data['rows'] = $this->model->onlyTrashed()->orderby('deleted_at','desc')->get();
        return view($this->__loadDataToView($this->folder.'trash'),compact('data'));
    }

    public function restore($id){
        $data['row'] = $this->model->where('id',$id)->withTrashed()->first();

        if ($data['row']->restore()){
            request()->session()->flash('success', $this->panel.' restored successfully');
        } else{
            request()->session()->flash('error', $this->panel.' restore failed');
        }
        return redirect()->route($this->base_route.'index');
    }

    public function forceDelete($id){
        $data['row'] = $this->model->where('id',$id)->withTrashed()->first();
        if ($data['row']->forceDelete()){
            request()->session()->flash('success', $this->panel.' premanently deleted');
        } else{
            request()->session()->flash('error', $this->panel.' delete failed');
        }
        return redirect()->route($this->base_route.'trash');
    }
}
