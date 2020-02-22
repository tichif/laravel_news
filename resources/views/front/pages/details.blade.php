@extends('front.layout.master')

@section('content')
<section id="entity_section" class="entity_section">
  <div class="container">
  <div class="row">
  <div class="col-md-8">
  <div class="entity_wrapper">
      <div class="entity_title">
          <h1><a href="{{ url('/details') }}/{{ $post->slug }}">{{ $post->title }}</a></h1>
      </div>
      <!-- entity_title -->
  
      <div class="entity_meta"><a href="{{ url('/details') }}/{{ $post->slug }}">{{ date('F j,Y', strtotime($post->created_at)) }}</a>, by: <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }}</a>
      </div>
      <!-- entity_meta -->
  
      <div class="entity_rating">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star-half-full"></i>
      </div>
      <!-- entity_rating -->
  
      <div class="entity_social">
          <a href="{{ url('/details') }}/{{ $post->slug }}" class="icons-sm sh-ic">
              <i class="fa fa-eye"></i>
              <b>{{ $post->view_count }}</b> <span class="share_ic">Views</span>
          </a>
          <a href="#" class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
          <!--Twitter-->
          <a href="#" class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
          <!--Google +-->
          <a href="#" class="icons-sm inst-ic"><i class="fa fa-google-plus"> </i></a>
          <!--Linkedin-->
          <a href="#" class="icons-sm tmb-ic"><i class="fa fa-ge"> </i></a>
          <!--Pinterest-->
          <a href="#" class="icons-sm rss-ic"><i class="fa fa-rss"> </i></a>
      </div>
      <!-- entity_social -->
  
      <div class="entity_thumb">
          <img class="img-responsive" src="{{ asset('/posts') }}/{{ $post->main_image }}" alt="{{ $post->title }}">
      </div>
      <!-- entity_thumb -->
  
      <div class="entity_content">
          <p>
            {{ $post->short_description }}
          </p>
    
          <p>
              {!! $post->description !!}
          </p>
      </div>
      <!-- entity_content -->
  
      <div class="entity_footer">
  
          <div class="entity_social">
              <span><i class="fa fa-eye"></i>{{ $post->view_count }} Views</a> </span>
              <span><i class="fa fa-comments-o"></i>{{ count($post->comments) }} Comments</a> </span>
          </div>
          <!-- entity_social -->
  
      </div>
      <!-- entity_footer -->
  
  </div>
  <!-- entity_wrapper -->
  
  <div class="related_news">
      <div class="entity_inner__title header_purple">
          <h2><a href="#">Related News</a></h2>
      </div>
      <!-- entity_title -->
  
      <div class="row">
          @foreach ($related_news as $post)
            <div class="col-md-6">
                <div class="media">
                    <div class="media-left">
                        <a href="{{ url('/details') }}/{{ $post->slug }}"><img class="media-object" src="{{ asset('/posts') }}/{{ $post->thumb_image }}" alt="{{ $post->title }}"></a>
                    </div>
                    <div class="media-body">
                        <span class="tag purple"><a href="{{ url('/category') }}/{{ $post->category_id }}">{{ $post->category->name }}</a></span>

                        <h3 class="media-heading"><a href="{{ url('/details') }}/{{ $post->slug }}">{{ $post->title }}</a></h3>
                        <span class="media-date"><a href="{{ url('/details') }}/{{ $post->slug }}">{{ date('F j,Y', strtotime($post->created_at)) }}</a>,  by:  <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }}</a></span>

                        <div class="media_social">
                            <span><i class="fa fa-eye"></i>{{ $post->view_count }} Views</a> </span>
                            <span><i class="fa fa-comments-o"></i>{{ count($post->comments) }} Comments</a> </span>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
          
      </div>
  </div>
  <!-- Related news -->
  

  
  <div class="readers_comment">
      <div class="entity_inner__title header_purple">
          <h2>Readers Comment</h2>
      </div>
      <!-- entity_title -->
  @foreach ($comments as $comment)
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img alt="64x64" width="64" height="64" class="media-object" data-src="{{ asset('/front/img/user.png') }}"
                    src="{{ asset('/front/img/user.png') }}" data-holder-rendered="true">
            </a>
        </div>
        <div class="media-body">
            <h2 class="media-heading"><a href="#">{{ $comment->name }}</a></h2>
            {{ $comment->comment }}
        </div>

    </div>
  @endforeach
      
      <!-- media end -->
  
  </div>
  <!--Readers Comment-->
 
  
  <div class="entity_comments">
      <div class="entity_inner__title header_black">
          <h2>Add a Comment</h2>
      </div>
      <!--Entity Title -->
  
      <div class="entity_comment_from">
          <form>
              <div class="form-group">
                  <input type="text" class="form-control" id="inputName" placeholder="Name">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="inputEmail" placeholder="Email">
              </div>
              <div class="form-group comment">
                  <textarea class="form-control" id="inputComment" placeholder="Comment"></textarea>
              </div>
  
              <button type="submit" class="btn btn-submit red">Submit</button>
          </form>
      </div>
      <!--Entity Comments From -->
  
  </div>
  <!--Entity Comments -->
  
  </div>
  <!--Left Section-->
  
  <div class="col-md-4">
    <div class="widget">
        <div class="widget_title widget_black">
            <h2><a href="#">Most Views</a></h2>
        </div>
        @foreach ($shareData['most_viewed'] as $most_view)
          <div class="media">
              <div class="media-left">
                  <a href="{{ url('/details') }}/{{ $most_view->slug }}"><img class="media-object" src="{{ asset('/posts') }}/{{ $most_view->thumb_image }}" alt="Generic placeholder image"></a>
              </div>
              <div class="media-body">
                  <h3 class="media-heading">
                      <a href="{{ url('/details') }}/{{ $most_view->slug }}">{{ $most_view->title}}</a>
                  </h3> 
                  <span class="media-date">
                      <a href="#">{{ date('j F -y', strtotime($most_view->created_at)) }}</a>,  by: <a href="{{ url('/author') }}/{{ $most_view->creator->id }}">{{ $most_view->creator->name }}</a>
                  </span>
      
                  <div class="widget_article_social">
                      <span>
                          <a href="{{ url('/details') }}/{{ $most_view->slug }}"> <i class="fa fa-eye"></i>{{ $most_view->view_count }}</a> Views
                      </span> 
                      <span>
                          <a href="{{ url('/details') }}/{{ $most_view->slug }}"><i class="fa fa-comments-o"></i>{{ count($most_view->comments) }}</a> Comments
                      </span>
                  </div>
              </div>
          </div>
        @endforeach
        
        <p class="widget_divider"><a href="#">More News&nbsp;&raquo;</a></p>
      </div>
  <!-- Popular News -->
  
  <div class="widget hidden-xs m30">
      <img class="img-responsive adv_img" src="{{asset('front/img/right_add1.jpg')}}" alt="add_one">
      <img class="img-responsive adv_img" src="{{asset('front/img/right_add2.jpg')}}" alt="add_one">
      <img class="img-responsive adv_img" src="{{asset('front/img/right_add3.jpg')}}" alt="add_one">
      <img class="img-responsive adv_img" src="{{asset('front/img/right_add4.jpg')}}" alt="add_one">
  </div>
  <!-- Advertisement -->
  
  <div class="widget hidden-xs m30">
      <img class="img-responsive widget_img" src="{{asset('front/img/right_add5.jpg')}}" alt="add_one">
  </div>
  <!-- Advertisement -->
  
  
  <div class="widget m30">
    <div class="widget_title widget_black">
        <h2><a href="#">Most Commented</a></h2>
    </div>
    @foreach ($shareData['most_commented'] as $most_commented)
      <div class="media">
          <div class="media-left">
              <a href="{{ url('/details') }}/{{ $most_commented->slug }}"><img class="media-object" src="{{ asset('/posts') }}/{{ $most_commented->thumb_image }}" alt="Generic placeholder image"></a>
          </div>
          <div class="media-body">
              <h3 class="media-heading">
                  <a href="{{ url('/details') }}/{{ $most_commented->slug }}">{{ $most_commented->title}}</a>
              </h3>
  
              <div class="media_social">
                  <span><i class="fa fa-comments-o"></i><a href="{{ url('/details') }}/{{ $most_commented->slug }}"> {{ $most_commented->comments_count}} </a> Comments</span>
              </div>
          </div>
      </div>
    @endforeach
    
    <p class="widget_divider"><a href="#">More News&nbsp;&nbsp;&raquo; </a></p>
  </div>
  <!-- Most Commented News -->
 
  
  <div class="widget hidden-xs m30">
      <img class="img-responsive widget_img" src="{{asset('front/img/podcast.jpg')}}" alt="add_one">
  </div>
  <!--Advertisement-->
  </div>
  <!--Right Section-->
  
  </div>
  <!-- row -->
  
  </div>
  <!-- container -->
  
  </section>
  <!-- Entity Section Wrapper -->
@endsection