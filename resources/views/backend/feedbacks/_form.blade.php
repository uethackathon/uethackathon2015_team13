<div class="col-md-12">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Lỗi:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="form-group">
	{!! Form::label('visibility_id', 'Visibility', array('class'=>'col-sm-2 control-label','autocomplete'=>'off')) !!}
	<div class="col-sm-8">
	{!! Form::select('visibility_id', $visibilities , old('visibility_id'), ['class' => 'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('status_id', 'Status', array('class'=>'col-sm-2 control-label','autocomplete'=>'off')) !!}
	<div class="col-sm-8">
	{!! Form::select('status_id', $statuses , old('status_id'), ['class' => 'form-control']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('name', 'Tên', array('class'=>'col-sm-2 control-label')) !!}
	<div class="col-sm-8">
	{!! Form::text('name', old('name') ? old('name') : (isset($feedback) ? $feedback->name : ''), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('email', 'Email', array('class'=>'col-sm-2 control-label')) !!}
	<div class="col-sm-8">
	{!! Form::email('email', old('email') ? old('email') : (isset($feedback) ? $feedback->email : ''), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('title', 'Title', array('class'=>'col-sm-2 control-label')) !!}
	<div class="col-sm-8">
	{!! Form::text('title', old('title') ? old('title') : (isset($feedback) ? $feedback->title : ''), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
	</div>
</div>
<div class="form-group">
	{!! Form::label('content', 'Nội dung', array('class'=>'col-sm-2 control-label')) !!}
	<div class="col-sm-8">
		{!! Form::textarea('content', old('content'), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		{!! Form::submit('Lưu', ['class' => 'btn btn-primary']) !!}
        <a href="javascript:window.history.back()" class="btn btn-default" title="">Hủy</a>
        <a href="j#" class="btn btn-danger" data-trigger="delete">Xóa</a>
	</div>
</div>