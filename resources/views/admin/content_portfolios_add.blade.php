<div class="wrapper container-fluid">

    {!! Form::open(['url' => route('portfoliosAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    <div class="form-group">
        {!! Form::label('name','Название',['class' => 'col-xs-2 control-label'])   !!}
        <div class="col-xs-8">
            {!! Form::text('name',old('name'),['class' => 'form-control','placeholder'=>'Введите имя фотографии'])!!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('filter', 'Филтер:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::text('filter', old('filter'), ['class' => 'form-control','placeholder'=>'Введите имя фильтра']) !!}
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
