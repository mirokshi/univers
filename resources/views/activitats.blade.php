@extends('layouts.app')

@section('title')
    Activitats
@endsection
@section('content')
    <v-container>
        <v-layout>
            <v-flex>
                <activitats class="m-5" :activitats="{{$activitats}}" uri="{{$uri}}"></activitats>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
