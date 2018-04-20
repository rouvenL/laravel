<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
        @extends('layouts.app')
        
        @section('content')
        <div class="container">
                    <div class="panel panel-success">
                        
                        @if(Auth::check())
                            <div>
                                You are logged in!
                            </div>
                        @endif
                    </div>
                    @if(Auth::guest())
                        <a href="/login" class="btn btn-info">You need to login!</a>
                    @endif
                </div>
        @endsection
    </body>
</html>
