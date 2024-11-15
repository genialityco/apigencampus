<!DOCTYPE html>
<html lang="{{ Lang::locale() }}">
<head>
    <!--
              _   _                 _ _
         /\  | | | |               | (_)
        /  \ | |_| |_ ___ _ __   __| |_ _______   ___ ___  _ __ ___
       / /\ \| __| __/ _ \ '_ \ / _` | |_  / _ \ / __/ _ \| '_ ` _ \
      / ____ \ |_| ||  __/ | | | (_| | |/ /  __/| (_| (_) | | | | | |
     /_/    \_\__|\__\___|_| |_|\__,_|_/___\___(_)___\___/|_| |_| |_|

    -->
    <title>
        @section('title')
            <?= config('app.name') ?> -
        @show
    </title>

    @include('Shared.Layouts.ViewJavascript')

    <!--Meta-->
    @include('Shared.Partials.GlobalMeta')
   <!--/Meta-->

    <!--JS-->
    {!! HTML::script(config('attendize.cdn_url_static_assets').'/vendor/jquery/dist/jquery.min.js') !!}
    <!--/JS-->

    <!--Style-->
    <link rel="stylesheet" href="{{ asset('assets/stylesheet/application.css')  }}">
    <!--/Style-->

    @yield('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        document.domain = "evius.co"
    </script>
</head>
<body class="attendize" style="background-color: white">
@yield('pre_header')
<header id="header" class="navbar" >

    @if(isset($is_embedded))
        @if($is_embedded)
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0);">
                <img style="width: 150px;" class="logo" alt="Attendize" src="{{asset('assets/images/logo-light.png')}}"/>
            </a>
        </div>
        @endif
    @endif
    

    
    @if(isset($is_embedded))
        @if($is_embedded)
            <div class="navbar-toolbar clearfix">
                @yield('top_nav')
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown profile">

                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="meta">
                            <?php 
                            
                            
                            ?>
                            <span class="text ">{{isset($organiser->name) ? $organiser->name : $event->organiser->name}}</span>
                                <span class="arrow"></span>
                            </span>
                        </a>


                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('showCreateOrganiser')}}">
                                    <i class="ico ico-plus"></i>
                                    @lang("Top.create_organiser")
                                </a>
                            </li>
                            <li class="divider"></li>

                            <li>
                                <a data-href="{{route('showEditUser')}}" data-modal-id="EditUser"
                                class="loadModal editUserModal" href="javascript:void(0);"><span class="icon ico-user"></span>@lang("Top.my_profile")</a>
                            </li>
                            <li class="divider"></li>
                            <li><a data-href="{{route('showEditTickets')}}" data-modal-id="EditAccount" class="loadModal"
                                href="javascript:void(0);"><span class="icon ico-cog"></span>@lang("Top.account_settings")</a></li>

                            <li class="divider"></li>
                            <li><a target="_blank" href="https://www.attendize.com/feedback.php?v={{ config('attendize.version') }}"><span class="icon ico-megaphone"></span>@lang("Top.feedback_bug_report")</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('logout')}}"><span class="icon ico-exit"></span>@lang("Top.sign_out")</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        @else
        <div style="background-color:white; text-align: center;">
            <div style="float: left">
            @yield('top_nav')
            </div>
            <div style="float: left">    
            <a data-href="{{route('showEditTickets')}}" data-modal-id="EditAccount" class="loadModal"
                        href="javascript:void(0);"><br><span class="icon ico-cog"></span>@lang("Top.account_settings")
            </a>
            </div>
        </div>
        @endif
    @else
        <div style="background-color:white; text-align: center;">
            <div style="float: left">
            @yield('top_nav')
            </div>
            <div style="float: left">    
            @if(isset($event))
                <a data-href="{{route('showEditTickets',['event_id'=> $event->_id])}}" data-modal-id="EditAccount" class="loadModal"
                            href="javascript:void(0);"><br><span class="icon ico-cog"></span>@lang("Top.account_settings")
                </a>
            @endif
            </div>
        </div>
    @endif
    


</header>
@if(isset($is_embedded))
    @if($is_embedded)
        @yield('menu')
    @endif
@endif
<!--Main Content-->
<section id="main" role="main">
    <div class="container-fluid">
        <div class="page-title"  style="background-color: white">
            <h1 class="title">@yield('page_title')</h1>
        </div>
        @if(array_key_exists('page_header', View::getSections()))
        <!--  header -->
        <div class="page-header page-header-block row">
            <div class="row">
                @yield('page_header')
            </div>
        </div>
        <!--/  header -->
        @endif

        <!--Content-->
        @yield('content')
        <!--/Content-->
    </div>

    <!--To The Top-->
    <a href="#" style="display:none;" class="totop"><i class="ico-angle-up"></i></a>
    <!--/To The Top-->

</section>
<!--/Main Content-->

@include("Shared.Partials.LangScript")
{!! HTML::script('assets/javascript/backend.js') !!}
<!--/JS-->
@yield('foot')

@include('Shared.Partials.GlobalFooterJS')

</body>
</html>
