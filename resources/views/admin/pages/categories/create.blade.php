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
                <hr>

                {{ Form::open(['url'=> 'back/category/store', 'method'=> "POST"]) }}

                    <div class="form-group">
                        {{Form::label('name','Name',['class'=> 'control-label mb-1'])}}
                        {{Form::text('name',null,['class'=> 'form-control', 'id'=> "name"])}}   
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Submit</span>
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