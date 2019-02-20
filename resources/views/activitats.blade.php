@extends('layouts.app')

@section('title')
    Activitats
@endsection
@section('content')
    <v-container>
        <v-layout>
            <v-flex>
                <activitats :activitats="{{$activitats}}" :users="{{$users}}" uri="{{$uri}}"></activitats>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
