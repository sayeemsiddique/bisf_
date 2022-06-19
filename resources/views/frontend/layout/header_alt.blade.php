<!DOCTYPE html>
<html lang="en">

<head>
        <!-- Title -->
        <title>Home | BISF</title>

        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('frontend/assets/img/logo.png')}}">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/font-electro.css')}}">

        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/animate.css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/fancybox/jquery.fancybox.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/slick-carousel/slick/slick.css')}}">
        <link rel="stylesheet" href="{{asset('frontend/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

        <!-- CSS BISF Template -->
        <link rel="stylesheet" href="{{asset('frontend/assets/css/theme.css')}}">

        <style> 
         .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 20px auto;
            }
            .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
            }
            .avatar-upload .avatar-edit input {
            display: none;
            }
            .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
            }
            .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
            }
    
            .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            }
            .avatar-upload .avatar-preview > img {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            }

            .slick-slide img {
                height: 260px;
            }
            .category-home img {
                height: 75px;
            }
    
        </style>    

        @stack('css')

    </head>

    <body>
      
         
   @include('frontend.partials.navbar_alt')