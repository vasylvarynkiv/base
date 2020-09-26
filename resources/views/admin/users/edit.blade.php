@extends('admin.layout', ['title' => 'User Edit'])

@section('main')
    <!-- Main content -->
    <section class="content">
        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) }}
        {!! Form::hidden('id', $user->id) !!}
        @include('admin.users._form')
        {{ Form::close() }}
    </section>
    <!-- /.content -->
@endsection
