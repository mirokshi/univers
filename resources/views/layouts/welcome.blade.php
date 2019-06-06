<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Univers alumnat</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="icon" ref="/favicon.ico" type="img/ico">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="activitat" content="{{ selected_activity() }}">
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
<div id="app">
    <v-app light v-cloak>
        <v-toolbar class="red lighten-2">
            <v-toolbar-title v-text="title"></v-toolbar-title>
            <img src="img/sisetzeLogo.png" alt="sisetze" height="50">
            <v-spacer></v-spacer>
            @if(empty(Auth::user()->email))
                <v-btn href="login" class="red ">LOGIN </v-btn>
                <v-btn href="register" class="red">REGISTER</v-btn>

            @else
                <v-form action="/logout" method="POST">
                    @csrf
                    <v-btn class="red" type="submit">LOGOUT</v-btn>
                </v-form>
            @endif
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax src="img/background.jpg" height="700">
                </v-parallax>
                <div class="overlay" style="
                    position:absolute;
                    left:0;
                    top:0;
                    background: rgba(0,0,0,.5);
                    width:100%;
                    height:700px;"
                >
                    <v-layout
                        column
                        align-center
                        justify-center
                        class="white--text"
                        style="height: 100%;"
                    >
                        <img src="img/ajuntamentLogo.png" alt="Ajuntament de Tortosa  " height="200">
                        <h1 class="white--text text--ligthen-2 mb-2 display-4 text-xs-center font-weight-bold"
                            style="text-shadow: 0 0 50px hsla(0, 0%, 0%, .4);font-family: 'Montserrat', sans-serif !important; z-index: 10;"
                            :class="{'display-2': $vuetify.breakpoint.md, 'display-1': $vuetify.breakpoint.xs}"
                        >Univers</h1>
                        <div class="display-1 mb-3 text-xs-center" style="text-shadow: rgba(0, 0, 0, 0.6) 0px 0px 50px;">Ajuntament Tortosa</div>
                        <v-btn
                            class="blue lighten-2 mt-5"
                            dark
                            large
                            href="/home"
                        >
                            Comença
                        </v-btn>
                    </v-layout>
                </div>
            </section>
            <section class="red lighten-2">
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Company info</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contact us</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>777-867-5309</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Chicago, US</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>john@vuetifyjs.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <v-footer class="blue darken-2">
                <v-layout row wrap align-center>
                    <v-flex xs12>
                        <div class="white--text ml-3">
                            Made with
                            <v-icon class="red--text">favorite</v-icon>
                        </div>
                    </v-flex>
                </v-layout>
            </v-footer>
        </v-content>
    </v-app>
</div>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
<script>
    new Vue({
        el: '#app',
        data () {
            return {
                title: 'Programa'
            }
        }
    })
</script>
</body>
</html>
