<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="" />
    <meta name="description" content="{{Tpl::getinfo()['seotext']??''}}" />
    <meta name="author" content="woldy" />
    <title> {{Setting::get('site_title')}}{{Tpl::getinfo()['seotitle']??''}}</title>

    @foreach ($common_css as $css)
        <link rel="stylesheet" href="{{$static_base}}{{$css}}?ver={{$version}}">
    @endforeach
    <script type="text/javascript">var token='<?php echo csrf_token(); ?>';</script>
    <script src="{{$static_base}}/js/common/jquery-1.11.1.min.js?ver=0"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

     <link rel="stylesheet" href="{{$static_url}}{{$static['css']}}?ver={{$version}}">
     <script src="{{$static_url}}{{$static['js']}}?ver={{$version}}"></script>

     <script>
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
     </script>
</head>
<body class="page-body">
