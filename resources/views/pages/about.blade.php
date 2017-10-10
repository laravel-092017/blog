@extends('layouts.base')

@section('content')
    <h1>
        About company
    </h1>
@endsection

@section('header')
    <header>
        This is header of about page
    </header>
@endsection

@section('head_scripts')
    @parent
    <script src="about.js"></script>
@endsection