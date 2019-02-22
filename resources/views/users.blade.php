@extends('layouts.app')

@section('title')
    Entitats i/o Organizacions
    @endsection
@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <users users="{{$users}}" uri="{{$uri}}"></users>
            </v-flex>
        </v-layout>
    </v-container>
     @endsection
