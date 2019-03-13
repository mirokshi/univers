@extends('layouts.app')

@section('title')
    Home
@endsection
@section('content')
    <v-container
        fill-height
        fluid
        grid-list-xl
        text-xs-center
    >
        <v-layout wrap row>
                <home></home>
        </v-layout>
    </v-container>
@endsection
