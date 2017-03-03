{!! Form::hidden('redirect_to', URL::previous()) !!}

<div class="panel panel-info">
    <div class="panel-heading"><h3 class="panel-title">Personal data</h3></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('name')? ' has-error':'' }}">
                    {!! Form::label('name','Name', ['class' => 'control-label']) !!}
                    {!! Form::text('name', null, ['placeholder'=>'Enter user name','class'=>'form-control', 'id'=>'name']) !!}
                </div>

                <div class="form-group {{ $errors->first('email')? ' has-error':'' }}">
                    {!! Form::label('Email','Email', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['placeholder'=>'Enter your email','class'=>'form-control', 'id'=>'email']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->first('num_cpf')? ' has-error':'' }}">
                    {!! Form::label('CPF','CPF', ['class' => 'control-label']) !!}
                    {!! Form::text('num_cpf', null, ['placeholder'=>'Enter your cpf','class'=>'form-control', 'id'=>'num_cpf']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading"><h3 class="panel-title">User role data</h3></div>
    <div class="panel-body">
        <div class="form-group {{ $errors->first('roles')? ' has-error':'' }}">
            {!! Form::label('roles','Roles', ['class' => 'control-label']) !!}
            {!! Form::select('roles[]', $roles,null, ['class'=>'form-control', 'multiple' => true])!!}
        </div>
    </div>
</div>

