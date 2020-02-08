  <!-- Left Panel -->

  <aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="{{asset('admin/images/logo.png')}}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{asset('admin/images/logo2.png')}}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                
                @permission(['Permission List','All'])
                    <li><a href="{{ url('/back/permission') }}"><i class="menu-icon fa fa-share-square-o"></i> Permissions</a></li>
                @endpermission

                @permission(['Role List','All'])
                    <li><a href="{{ url('/back/roles') }}"><i class="menu-icon fa fa-fire"></i> Roles</a></li>
                @endpermission

                @permission(['Author List','All'])
                    <li><a href="{{ url('/back/author') }}"><i class="menu-icon fa fa-users"></i> Authors</a></li>
                @endpermission

                @permission(['Category List','All'])
                    <li><a href="{{ url('/back/categories') }}"><i class="menu-icon fa fa-bars"></i> Categories</a></li>
                @endpermission

                @permission(['Post List','All'])
                    <li><a href="{{ url('/back/posts') }}"><i class="menu-icon fa fa-pencil-square-o"></i> Posts</a></li>
                @endpermission

                @permission(['System Settings','All'])
                    <li><a href="{{ url('/back/settings') }}"><i class="menu-icon fa fa-gears"></i> Settings</a></li>
                @endpermission

              
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->