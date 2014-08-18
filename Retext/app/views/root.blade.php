<html>
    <head>
        <title>{{{ $pageTitle or 'ReText Administration' }}}</title>
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        {{ HTML::style('css/root.css'); }}
        {{ HTML::script('js/retext.js'); }}
        
        
    </head>
    <body>
        <div class="PageWrapper">
            <div class="HeaderBar">
                <div class="logo">&nbsp;</div>
                <div class="HeaderText">ReText Administration</div>
            </div>
            <div class="TopBarWrapper"><hr class="bar" /></div>
            <div class="ContentWrap">
                @section('Sidebar')
                    <div class="Sidebar">
                        <div class="SidebarHeader">
                            <span class="TaskHeader">Tasks</span>
                        </div>
                        <div class="SidebarBody">
                            <ul class="SidebarLinkList">
                                <li class="SidebarLink" id="UserTaskEntry">{{ link_to_action('UserController@getRootmenu', 'User Management' ); }}</li>
                                <li class="SidebarLink" id="KeywordTaskEntry">{{ link_to_action('KeywordController@getRootmenu', 'Keyword Management' ); }}</li>
                                <li class="SidebarBlank">&nbsp;</li>
                                <li class="SidebarLink">{{ link_to_action('UserController@getLogout', 'Logout' ); }}</li>
                            </ul>
                        </div>
                        <div class="SidebarFooter">
                            <span class="UserStatusLabel">
                                @if (Auth::check())
                                    Logged in as: <strong>{{ Auth::user()->username; }}</strong>
                                @else
                                    Not Logged In
                                @endif
                            </span>
                        </div>
                    </div>
                @show
                <div class="AppCanvas">
                    @yield('Canvas')
                </div>
            </div>
            <div class="BottomBarWrapper"><hr class="bar" /></div>
            <div class="PageFooter">
                <div class="DemoTextWrapper">
                    <span class="DemoText">ReText Application Demo by Adam Williams</span>
                </div>
            </div>
        </div>
    </body>
</html>


