@extends('admin.layout', ['title' => 'User Detail'])

@section('main')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Detail</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>First name:</strong> {{ $user->first_name }}</p>
                                <p><strong>Last name:</strong> {{ $user->last_name }}</p>
                                <p><strong>E-mail:</strong> {{ $user->email }}</p>
                                <p><strong>Last login:</strong> {{ $user->last_login_at ?? '-' }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Status:</strong> {{ $user->statusName }}</p>
                                <p><strong>Role:</strong>
                                    @foreach($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </p>
                                <p><strong>Birthday:</strong> {{ $user->date_of_birth ?? '-' }}</p>
                                <p><strong>Notes:</strong> <br>{{ $user->notes ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection
