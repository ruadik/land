<div style="margin:0px 50px 0px 50px;">

    @if($peoples)

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>
                <th>Должность</th>
                <th>Текст</th>
                <th>Дата создания</th>

                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
                @foreach($peoples as $k=>$people)
                    <tr>
                        <td>{{$people->id}}</td>
                        <td>{!! Html::link(route('peoplesEdit', ['people'=>$people->id]), $people->name, ['alt'=>$people->name]) !!}</td>
                        <td>{{$people->position}}</td>
                        <td>{{$people->text}}</td>
                        <td>{{$people->created_at}}</td>
                        <td>
                            {!! Form::open(['url'=>route('peoplesEdit', ['people'=>$people->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}

                            {{ method_field('DELETE') }}
                            {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {!! Html::link(route('peoplesAdd'), 'Добавить страницу') !!}
</div>