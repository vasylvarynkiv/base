@extends('layouts.admin')

@section('content')
    <div class="wrapper">
        @include('admin._partials.navbar')
        @include('admin._partials.sidebar')

        <div class="content-wrapper">
            @include('admin._partials.header')

            @yield('main')
        </div>

        @include('admin._partials.footer')
    </div>
@endsection
