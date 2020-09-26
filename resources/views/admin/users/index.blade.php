@extends('admin.layout', ['title' => 'Users'])

@section('main')
    @can('user-create')
        <div class="content-header">
            <a href="{{ route('users.create') }}" class="btn btn-success">Create</a>
        </div>
    @endcan

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users list</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Full Name
                        </th>
                        <th style="width: 30%">
                            Email
                        </th>
                        <th>Last Login</th>
                        <th style="width: 8%" class="text-center">
                            Status
                        </th>
                        <th style="width: 20%">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td> {{ $user->name }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $user->last_login_at ?? '-' }}</td>

                            <td class="project-state">
                                <span class="badge badge-{{ $user->status == 1 ? 'success' : 'warning' }} ">{{ $user->statusName }}</span>
                            </td>
                            <td class="project-actions text-right">
                                @can('user-list')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.show', $user->id) }}">
                                        <i class="fas fa-eye">
                                        </i>
                                        View
                                    </a>
                                @endcan
                                @can('user-edit')
                                    <a class="btn btn-info btn-sm" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                @endcan
                                @role('Admin')
                                @if(!$user->lastAdmin())
                                    {{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'style' => 'display:inline-block']) }}
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                    {{ Form::close() }}
                                @endif
                                @endrole
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="card-footer clearfix">
                    {!! $users->links() !!}
                </div>
        @endif
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
