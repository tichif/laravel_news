@extends('admin.layout.master')

@section('content')
 <div class="row">
   <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <strong class="card-title">{{ $page_name }}</strong>
      </div>
      <div class="card-body">
        <!-- Credit Card -->
        <div id="pay-invoice">
            <div class="card-body">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif

                @if (session('success'))
                  <div class="alert alert-success" role="alert">
                    {{session('success')}}
                  </div>
                @endif
                <hr>

                {{ Form::open(['url'=> '/back/settings/update', 'method'=> "PUT",'enctype'=>'multipart/form-data']) }}

                    <div class="form-group">
                        {{Form::label('name','System Name',['class'=> 'control-label mb-1'])}}
                        {{Form::text('name',$system_name,['class'=> 'form-control', 'id'=> "name"])}}   
                    </div>

                    <div class="form-group">
                      {{Form::label('favicon','Favicon',['class'=> 'control-label mb-1'])}}
                      {{Form::file('favicon',null,['class'=> 'form-control', 'id'=> "favicon"])}}
                    </div>

                    <div class="form-group">
                      {{Form::label('front_logo','Front Logo',['class'=> 'control-label mb-1'])}}
                      {{Form::file('front_logo',null,['class'=> 'form-control', 'id'=> "front_logo"])}}
                    </div>

                    <div class="form-group">
                      {{Form::label('admin_logo','Admin Logo',['class'=> 'control-label mb-1'])}}
                      {{Form::file('admin_logo',null,['class'=> 'form-control', 'id'=> "admin_logo"])}}
                    </div>


                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Update</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
  
      </div>
    </div> <!-- .card -->
   </div>
 </div>
  
@endsection