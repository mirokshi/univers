<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <meta name="user" content="{{ logged    _user() }}">
    <meta name="activitat" content="{{ selected_activity() }}">
    <meta name="theme-color" content="#317EFB"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>@yield('title','Put your title here')</title>
    <style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: "";
            display: block;
            width: 200px;
            height: 200px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50%;
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwcHgiICBoZWlnaHQ9IjIwMHB4IiAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pZFlNaWQiIGNsYXNzPSJsZHMtZmFjZWJvb2siIHN0eWxlPSJiYWNrZ3JvdW5kOiBub25lOyI+PHJlY3QgbmctYXR0ci14PSJ7e2NvbmZpZy54MX19IiBuZy1hdHRyLXk9Int7Y29uZmlnLnl9fSIgbmctYXR0ci13aWR0aD0ie3tjb25maWcud2lkdGh9fSIgbmctYXR0ci1oZWlnaHQ9Int7Y29uZmlnLmhlaWdodH19IiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMxfX0iIHg9IjE3LjUiIHk9IjIzLjU1MDgiIHdpZHRoPSIxNSIgaGVpZ2h0PSI1Mi44OTg0IiBmaWxsPSIjMmI2MDhhIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBjYWxjTW9kZT0ic3BsaW5lIiB2YWx1ZXM9IjEwOzMwOzMwIiBrZXlUaW1lcz0iMDswLjU7MSIgZHVyPSIxLjciIGtleVNwbGluZXM9IjAgMC41IDAuNSAxOzAgMC41IDAuNSAxIiBiZWdpbj0iLTAuMzRzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImhlaWdodCIgY2FsY01vZGU9InNwbGluZSIgdmFsdWVzPSI4MDs0MDs0MCIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMS43IiBrZXlTcGxpbmVzPSIwIDAuNSAwLjUgMTswIDAuNSAwLjUgMSIgYmVnaW49Ii0wLjM0cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48L3JlY3Q+PHJlY3QgbmctYXR0ci14PSJ7e2NvbmZpZy54Mn19IiBuZy1hdHRyLXk9Int7Y29uZmlnLnl9fSIgbmctYXR0ci13aWR0aD0ie3tjb25maWcud2lkdGh9fSIgbmctYXR0ci1oZWlnaHQ9Int7Y29uZmlnLmhlaWdodH19IiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMyfX0iIHg9IjQyLjUiIHk9IjIwLjk4OTQiIHdpZHRoPSIxNSIgaGVpZ2h0PSI1OC4wMjEyIiBmaWxsPSIjMDBBOTU4Ij48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBjYWxjTW9kZT0ic3BsaW5lIiB2YWx1ZXM9IjE1OzMwOzMwIiBrZXlUaW1lcz0iMDswLjU7MSIgZHVyPSIxLjciIGtleVNwbGluZXM9IjAgMC41IDAuNSAxOzAgMC41IDAuNSAxIiBiZWdpbj0iLTAuMTdzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImhlaWdodCIgY2FsY01vZGU9InNwbGluZSIgdmFsdWVzPSI3MDs0MDs0MCIga2V5VGltZXM9IjA7MC41OzEiIGR1cj0iMS43IiBrZXlTcGxpbmVzPSIwIDAuNSAwLjUgMTswIDAuNSAwLjUgMSIgYmVnaW49Ii0wLjE3cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48L3JlY3Q+PHJlY3QgbmctYXR0ci14PSJ7e2NvbmZpZy54M319IiBuZy1hdHRyLXk9Int7Y29uZmlnLnl9fSIgbmctYXR0ci13aWR0aD0ie3tjb25maWcud2lkdGh9fSIgbmctYXR0ci1oZWlnaHQ9Int7Y29uZmlnLmhlaWdodH19IiBuZy1hdHRyLWZpbGw9Int7Y29uZmlnLmMzfX0iIHg9IjY3LjUiIHk9IjMwIiB3aWR0aD0iMTUiIGhlaWdodD0iNDAiIGZpbGw9IiM0YTNhNDQiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InkiIGNhbGNNb2RlPSJzcGxpbmUiIHZhbHVlcz0iMjA7MzA7MzAiIGtleVRpbWVzPSIwOzAuNTsxIiBkdXI9IjEuNyIga2V5U3BsaW5lcz0iMCAwLjUgMC41IDE7MCAwLjUgMC41IDEiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJoZWlnaHQiIGNhbGNNb2RlPSJzcGxpbmUiIHZhbHVlcz0iNjA7NDA7NDAiIGtleVRpbWVzPSIwOzAuNTsxIiBkdXI9IjEuNyIga2V5U3BsaW5lcz0iMCAwLjUgMC41IDE7MCAwLjUgMC41IDEiIGJlZ2luPSIwcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48L3JlY3Q+PC9zdmc+");
        }
    </style>
</head>
<body
    style="background: linear-gradient(to top, #fb4760 0%, #ea0025 100%)
    fixed;
    background: -webkit-linear-gradient(to top, #fb4760 0%, #ea0025 100%)
    fixed">
<div id="app" v-cloak>
    <noscript>
        <strong>We're sorry but frontend doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <v-app id="inspire">
        <snackbar></snackbar>
        <navigation v-model="drawer"></navigation>
        <navigation-right
            csrf-token="{{ csrf_token()}}"
            v-model="drawerRight"></navigation-right>
        <toolbar
            @toggle-right="drawerRight=!drawerRight"
            @toggle-left="drawer=!drawer"
        ></toolbar>
        <v-content style="background: #cc95a1">
            @yield('content')
        </v-content>
        <v-footer color="red accent-4" app>
            <span class="white--text">&copy; {{date('Y')}} </span>
        </v-footer>
    </v-app>
</div>
</body>
<script src="{{mix('/js/app.js')}}"></script>
</html>
