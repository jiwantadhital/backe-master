<div class="form-group">
    {!! Form::label('user_id', 'User Id'); !!}
    {!! Form::text('user_id',auth()->user()->id,['class'=>'form-control']) !!}
    @error('User_id')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('order_code', 'Order Code'); !!}
    {!! Form::text('order_code',null,['class'=>'form-control']) !!}
    @error('order_code')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('discount','Discount',['class' => 'control-label']) !!}
    {!! Form::number('discount',null,['class' => 'form-control']) !!}
    @error('discount')
    <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
    {!! Form::label('price','Price',['class' => 'control-label']) !!}
    {!! Form::number('price',null,['class' => 'form-control']) !!}
    @error('price')
    <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
    {!! Form::label('shipping_cost','Shipping Cost',['class' => 'control-label']) !!}
    {!! Form::number('shipping_cost',null,['class' => 'form-control']) !!}
    @error('shipping_cost')
    <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
    {!! Form::label('total_price','Total Cost',['class' => 'control-label']) !!}
    {!! Form::number('total_price',null,['class' => 'form-control']) !!}
    @error('total_price')
    <span class="text text-danger">{{$message}}</span>
    @enderror
  </div>
  <div class="form-group">
    {!! Form::label('order', 'Order'); !!}
    {!! Form::textarea('order',null,['class'=>'form-control']) !!}
    @error('order')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('address', 'Address'); !!}
    {!! Form::textarea('address',null,['class'=>'form-control']) !!}
    @error('address')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('order_status_id', 'Order Status'); !!}
    {!! Form::select('order_status_id', $data['order_status'], null,['class' => 'form-control']) !!}
    @error('order_status_id')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div
 class="form-group">
    {!! Form::label('payment_id', 'Payment Method'); !!}
    {!! Form::select('payment_id', $data['payment_methods'], null,['class' => 'form-control']) !!}
    @error('Payment Method')
    <span class="text text-danger">{{$message}}</span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('status', 'Status'); !!}
    {!! Form::radio('status',1) !!} Active
    {!! Form::radio('status',0,true) !!} De Active
</div>
