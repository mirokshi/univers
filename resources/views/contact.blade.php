@extends('layouts.app')

@section('title')
    Contacta'ns
@endsection
@section('content')
    <v-layout row >
        <v-flex xs12 sm6 offset-sm3>
            <v-card class="mt-5" style="background-color:#DECDC8" >
                <v-img
                    src="img/contact.jpeg"
                >
                </v-img>

                <v-card-title primary-title>
                    <div>
                        <div class="headline">Consultas & Soporte</div>
                    </div>
                </v-card-title>

                <v-card-actions>
                    <v-btn flat color="purple" href="/">GO HOME!</v-btn>
                    <v-spacer></v-spacer>
                    </v-btn>
                </v-card-actions>

                <v-slide-y-transition>
                    <v-card-text>
                        <ul style="list-style-type: none">
                            <li> <v-icon color="red ">email</v-icon>
                                Soporte : correo@gmail.com
                            </li>
                            <li><v-icon color="blue">phone</v-icon>
                                Telefono : 11122333
                            </li>
                            <li><v-icon color="pink">face</v-icon>
                                Responsable: Paco
                            </li>
                            <li><v-icon color="green">location_city</v-icon>
                                Tortosa
                            </li>

                        </ul>
                    </v-card-text>
                </v-slide-y-transition>
            </v-card>
        </v-flex>
    </v-layout>
@endsection
