@extends('layouts.app')

@section('title')
    Alumnes
    @endsection
@section('content')
    <v-container>
        <v-layout>
            <v-flex>
                <alumnes class="m-5" :alumnes="{{$alumnes}}" uri="{{$uri}}"></alumnes>
            </v-flex>
        </v-layout>
    </v-container>
     @endsection
