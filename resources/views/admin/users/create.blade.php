@extends('admin.layout', ['title' => 'User Create'])

@section('main')
    <!-- Main content -->
    <section class="content">
        {{ Form::open(['route' => 'users.store']) }}
        @include('admin.users._form')
        {{ Form::close() }}
    </section>
    <!-- /.content -->
@endsection
