<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>kitwitter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000080;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-center {
                position:fixed;
                center: 10px;
                top: 250px;
            }

            .button {
                    display       : inline-block;
                    border-radius : 39%;          /* 角丸       */
                    font-size     : 35pt;        /* 文字サイズ */
                    text-align    : center;      /* 文字位置   */
                    cursor        : pointer;     /* カーソル   */
                    padding       : 30px 49px;   /* 余白       */
                    background    : #0000b3;     /* 背景色     */
                    color         : rgba(255, 255, 255, 0.90);     /* 文字色     */
                    line-height   : 5em;         /* 1行の高さ  */
                    transition    : .3s;         /* なめらか変化 */
                    box-shadow    : 4px 4px 5px #666666;  /* 影の設定 */
                    border        : 2px solid #0000b3;    /* 枠の指定 */
            }
            .button:hover {
                    box-shadow    : none;        /* カーソル時の影消去 */
                    color         : #0000b3;     /* 背景色     */
                    background    : rgba(255, 255, 255, 0.90);     /* 文字色     */
            }

            .btn-primary{
                margin-right:30px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 200px;
                color:#ffffff;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="links flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-center btn-primary links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="button">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="button">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                            Kitwitter
                </div>

                {{--<div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>--}}
            </div>
        </div>
    </body>
</html>