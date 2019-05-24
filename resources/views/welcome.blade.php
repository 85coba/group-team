<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                font-family: sans-serif;
                margin: 0;
            }
            a {
                text-decoration: none;
              }

            .main {
                display: flex;
                justify-content: center;
                padding: 3%
            }

            .flex {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .flex-label {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 20px 0;
            }
            button {
                margin-left: 10px;
                align-items: center;
                justify-content: center;
                background-color: #228b22;
                color: white;
                min-width: 100px;
                padding: 5px;
                cursor: pointer;
                border-style: none;
                font: 400 16px sans-serif;
                border-radius: 4px;
                -webkit-transition: background-color .5s ease;
                transition: background-color .5s ease;
            }
            button:disabled {
                color: white;
                background-color: #aaaaaa
            }
            .input {
                flex: 1 1;
                margin: 0 10px;
                outline: none;
                border: 1px solid #a9a9a9;
                padding: 5px;
                border-radius: 4px;
            }
            .match-input {
                text-align: center;
                width: 40px;
                flex: 1 1;
                margin: 0 10px;
                outline: none;
                border: 1px solid #a9a9a9;
                padding: 5px;
                border-radius: 4px;
            }
            .item {
                position: relative;
                margin-bottom: 5px;
            }

            .xclose {
                position: absolute;
                cursor: pointer;
                left: -2.5rem;
            }
            * {
                box-sizing: border-box
            }

        </style>
    </head>
    <body>
            <div class="main">
                    <div id="app">
                        <router-view></router-view>
                    </div>
            </div>
    <script src="{{ asset('public/js/app.js') }}" defer></script>
    </body>
</html>