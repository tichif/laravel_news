@extends('front.layout.master')

@section('content')

<section class="breadcrumb_section">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                 <li class="active"><a href="{{ url('/author') }}/{{ $user->id }}">{{ $user->name }}</a></li>
            </ol>
        </div>
    </div>
</section>

<div class="container">
<div class="row">
<div class="col-md-8">
 @foreach($posts as $key=>$post)
                @if($key === 0)
                    <div class="entity_wrapper">
                        <div class="entity_title header_purple">
                           <h1><a href="{{ url('/category') }}/{{ $post->category_id }}">{{ $post->category->name }}</a></h1>
                        </div>
                        <!-- entity_title -->
                        <div class="entity_thumb">
                           <img class="img-responsive" src="{{ asset('/posts') }}/{{ $post->main_image }}" alt="{{ $post->title }}">
                        </div>
                        <!-- entity_thumb -->
                        <div class="entity_title">
                           <a href="{{ url('/details') }}/{{ $post->slug }}" >
                              <h3> 
                                {{ $post->title }}
                              </h3>
                           </a>
                        </div>
                        <!-- entity_title -->
                        <div class="entity_meta">
                           <a href="{{ url('/details') }}/{{ $post->slug }}">{{ date('F j-Y',strtotime($post->created_at)) }}</a>, by: <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }} </a>
                        </div>
                        <!-- entity_meta -->
                        <div class="entity_content">
                            {{ str_limit( $post->short_description,200,'...' )  }}
                        </div>
                        <!-- entity_content -->
                        <div class="entity_social">
                           <span><i class="fa fa-eye"></i>{{ $post->view_count }} <a href="{{ url('/details') }}/{{ $post->slug }}">Views</a> </span>
                           <span><i class="fa fa-comments-o"></i>{{ count($post->comments) }} <a href="{{ url('/details') }}/{{ $post->slug }}">Comments</a> </span>
                        </div>
                        <!-- entity_social -->
                    </div>
                @else
                    <!-- entity_wrapper -->
                    @if($key === 1)
                        <div class="row">
                    @endif
                        <div class="col-md-6" style="min-height: 555px;margin-bottom:2%">
                           <div class="category_article_body">
                              <div class="top_article_img">
                                 <img class="img-fluid" src="{{ asset('/posts') }}/{{ $post->list_image }}" alt="{{ $post->title }}">
                              </div>
                              <!-- top_article_img -->
                              <div class="category_article_title">
                                 <h5>
                                    <a href="{{ url('/details') }}/{{ $post->slug }}" > {{ $post->title }} </a>
                                 </h5>
                              </div>
                              <!-- category_article_title -->
                              <div class="article_date">
                                 <a href="{{ url('/details') }}/{{ $post->slug }}">{{ date('F j-Y',strtotime($post->created_at)) }}</a>, by: <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }} </a>
                              </div>
                              <!-- article_date -->
                              <div class="category_article_content">
                                {{ str_limit( $post->short_description,100,'...' )  }}
                              </div>
                              <!-- category_article_content -->
                              <div class="article_social">
                                <span><i class="fa fa-eye"></i>{{ $post->view_count }} <a href="{{ url('/details') }}/{{ $post->slug }}">Views</a> </span>
                                 <span><i class="fa fa-comments-o"></i>{{ count($post->comments) }} <a href="{{ url('/details') }}/{{ $post->slug }}">Comments</a> </span>
                              </div>
                              <!-- article_social -->
                           </div>
                           <!-- category_article_body -->
                        </div>
                        <!-- col-md-6 -->
                    @if($loop->last)
                        </div>
                    @endif
                @endif
            @endforeach
         <div style="margin-left: 40%">
             {{ $posts->links() }}
         </div>
         <!-- navigation -->
        </div>
      <!-- col-md-8 -->
        <div class="col-md-4">
            <div class="widget">
                <div class="widget_title widget_black">
                    <h2><a href="">Most Viewed</a></h2>
                </div>
                @foreach($shareData['most_viewed'] as $item)
                <div class="media">
                    <div class="media-left">
                        <a href="{{ url('/details') }}/{{ $item->slug }}">
                            <img class="media-object" src="{{ asset('/posts') }}/{{ $item->thumb_image }}" alt="{{ $item->title }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="{{ url('/details') }}/{{ $item->slug }}" >{{ $item->title }}</a>
                        </h3> <span class="media-date"><a href="#">{{ date( 'j F - Y',strtotime($item->created_at)) }}</a>,  by: <a href="{{ url('/author') }}/{{ $item->creator->id }}">{{ $item->creator->name }}</a></span>

                        <div class="widget_article_social">
                            <span>
                                <a href="{{ url('/details') }}/{{ $item->slug }}" ><i class="fa fa-eye"></i>{{ $item->view_count }}</a> Views
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
                <p class="widget_divider"><a href="#" >More News&nbsp;&raquo;</a></p>
            </div>
            <!-- Popular News -->

<div class="widget hidden-xs m30">
    <img class="img-responsive adv_img" src="{{ asset('/front/img/right_add1.jpg')}}" alt="add_one">
    <img class="img-responsive adv_img" src="{{ asset('/front/img/right_add2.jpg')}}" alt="add_one">
    <img class="img-responsive adv_img" src="{{ asset('/front/img/right_add3.jpg')}}" alt="add_one">
    <img class="img-responsive adv_img" src="{{ asset('/front/img/right_add4.jpg')}}" alt="add_one">
</div>
<!-- Advertisement -->

<div class="widget hidden-xs m30">
    <img class="img-responsive widget_img" src="{{ asset('/front/img/right_add5.jpg')}}" alt="add_one">
</div>
<!-- Advertisement -->

 
<!-- Advertisement -->

<div class="widget m30">
    <div class="widget_title widget_black">
        <h2><a href="#">Most Commented</a></h2>
    </div>

    @foreach($shareData['most_commented'] as $item)
    <div class="media">
        <div class="media-left">
            <a href="{{ url('/details') }}/{{ $item->slug }}"><img class="media-object" src="{{ asset('/posts') }}/{{ $item->thumb_image  }}" alt="{{ $item->title }}"></a>
        </div>
        <div class="media-body">
            <h3 class="media-heading">
                <a href="{{ url('/details') }}/{{ $item->slug }}" >{{ $item->title }}</a>
            </h3>

            <div class="media_social">
                <span><i class="fa fa-comments-o"></i><a href="#">{{ $item->comments_count }}</a> Comments</span>
            </div>
        </div>
    </div>
    @endforeach
  
    <p class="widget_divider"><a href="#" >More News&nbsp;&nbsp;&raquo; </a></p>
</div>
<!-- Most Commented News -->


<!--Advertisement-->
</div>
<!-- Right Section -->

</div>
<!-- Row -->

</div>
<!-- Container -->
@endsection