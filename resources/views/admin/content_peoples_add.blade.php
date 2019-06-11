<div class="wrapper container-fluid">

    {!! Form::open(['url' => route('peoplesAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    <div class="form-group">
        {!! Form::label('name','ФИО',['class' => 'col-xs-2 control-label'])   !!}
        <div class="col-xs-8">
            {!! Form::text('name',old('name'),['class' => 'form-control','placeholder'=>'Введите ФИО сотрудника'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('position', 'Должность:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::text('position', old('position'), ['class' => 'form-control','placeholder'=>'Введите должность сотрудника']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::textarea('text', old('text'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('images', 'Изображение:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::file('images', ['class' => 'filestyle', 'data-text'=>'Выберите изображение','data-btnClass'=>'btn btn-primary','data-placeholder'=>"Файла не выбран"]) !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button('Сохранить', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
    </div>



    {!! Form::close() !!}

    <script>
        CKEDITOR.replace('editor');
    </script>

</div>
