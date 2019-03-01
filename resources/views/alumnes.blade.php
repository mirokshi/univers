@extends('layouts.app')

@section('title')
    Alumnes
    @endsection
@section('content')
    <v-container fluid>
        <v-layout>
            <v-flex>
                <alumnes  :alumnes="{{$alumnes}}" :users="{{$users}}" uri="{{$uri}}" :activitats="{{$activitats}}"></alumnes>
            </v-flex>
        </v-layout>
    </v-container>
     @endsection
