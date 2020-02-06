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

                {{ Form::open(['url'=> 'back/posts/store', 'method'=> "POST",'enctype'=>'multipart/form-data']) }}

                  <div class="form-group">
                    {{Form::label('title','Title',['class'=> 'control-label mb-1'])}}
                    {{Form::text('title',null,['class'=> 'form-control', 'id'=> "title"])}}   
                  </div>

                  <div class="form-group">
                    {{Form::label('category','Category',['class'=> 'control-label mb-1'])}}
                    {{Form::select('category_id',$categories,null,['class'=> 'form-control myselect', 'data-placeholder'=> "Select Category"])}}    
                  </div>

                  <div class="form-group">
                    {{Form::label('short_description','Short Description',['class'=> 'control-label mb-1'])}}
                    {{Form::textarea('short_description',null,['class'=> 'form-control my-editor', 'id'=> "short_description"])}}
                  </div>

                  <div class="form-group">
                    {{Form::label('description','Text',['class'=> 'control-label mb-1'])}}
                    {{Form::textarea('description',null,['class'=> 'form-control my-editor', 'id'=> "description"])}}
                  </div>

                  <div class="form-group">
                    {{Form::label('image','Image',['class'=> 'control-label mb-1'])}}
                    {{Form::file('image',null,['class'=> 'form-control', 'id'=> "image"])}}
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
  
  <script>
    jQuery(document).ready(function(){
        jQuery(".myselect").chosen({
        disable_search_threshold: 10,
        no_results_text: "Oops, nothing found!",
        width: "100%"
        });
    });
  </script>


@endsection