<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">General</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('first_name', 'First Name') }}
                    {{ Form::text('first_name', null, ['required' => true, 'class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name') }}
                    {{ Form::text('last_name', null, ['required' => true, 'class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'E-mail') }}
                    {{ Form::email('email', null, ['required' => true, 'class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['required'=> (isset($user) ? false : true), 'class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Password Confirmation') }}
                    {{ Form::password('password_confirmation', ['required'=> (isset($user) ? false : true), 'class' => 'form-control']) }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Other</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', $status, null, ['disabled' => (isset($user) && $user->lastAdmin()), 'class' => 'form-control custom-select']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('roles', 'Role') }}
                    {{ Form::select('roles', $roles, null, ['class' => 'form-control custom-select']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('date_of_birth', 'Birthday') }}
                    @if(isset($user->date_of_birth) )
                        {{ Form::date('date_of_birth', null, ['class' => 'form-control']) }}
                    @else
                        {{ Form::date('date_of_birth', '', ['class' => 'form-control']) }}
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('notes', 'Notes') }}
                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 4]) }}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-12">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        {{ Form::submit('Save', ['class' => 'btn btn-success float-right']) }}
    </div>
</div>
