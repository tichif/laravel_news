@extends('admin.layout.master')

@section('content')
  <div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>{{ $page_name }}</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">{{ $page_name }}</li>
                </ol>
            </div>
        </div>
    </div>
  </div>

  <div class="content mt-3">
      <div class="animated fadeIn">
          <div class="row">

          <div class="col-md-12">
              <div class="card">
                @if (session('success'))
                  <div class="alert alert-success" role="alert">
                    {{session('success')}}
                  </div>
                @endif
                  <div class="card-header">
                    <strong class="card-title">{{ $page_name }}</strong>
                    @permission(['Category Add','All'])
                      <a href="{{url('/back/category/create')}}" class="btn btn-primary pull-right">Create</a>
                    @endpermission
                  </div>
                  <div class="card-body">
                    
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $category)
                  <tr>
                    <td> {{ $category->id }} </td>
                    <td> {{ $category->name }} </td>
                    <td>
                      {{ Form::open(['method'=> 'PUT', 'url'=> ['/back/category/status/'.$category->id], 'style' => 'display:inline' ]) }}
                        @if ($category->status === 1)
                          {{ Form::submit('Unpublish',['class' => 'btn btn-warning']) }}                              
                          @else
                          {{ Form::submit('Publish',['class' => 'btn btn-success']) }}
                        @endif
                      {{ Form::close() }}
                    </td>
                    <td> 
                      @permission(['Category Update','All'])
                        <a href="{{ url('/back/category/edit/'.$category->id) }}" class="btn btn-primary">Edit</a>
                      @endpermission
                      @permission(['Category Delete','All'])
                        {{ Form::open(['method'=> 'DELETE', 'url'=> ['/back/category/delete/'.$category->id], 'style' => 'display:inline' ]) }}
                          {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                      @endpermission
                    </td>
                  </tr>
                @endforeach                
              </tbody>
            </table>
                  </div>
              </div>
          </div>


          </div>
      </div><!-- .animated -->
  </div><!-- .content -->


  <script src="{{asset('admin/assets/js/lib/data-table/datatables.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/chart-js/Chart.bundle.jss')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/jszip.min.jss')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/pdfmake.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/vfs_fonts.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/lib/data-table/datatables-init.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
    } );
</script>
@endsection