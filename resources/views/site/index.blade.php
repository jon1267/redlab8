@extends('app')

@section('content')
    <div class="col-11 mx-auto">
        <h3>Сетка</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Имя Фамилия\Отдел</th>
                @if(count($positions))
                    @foreach($positions as $position)
                        <th>{{ $position->position }} <small>id={{$position->id}}</small> </th>
                    @endforeach
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($peoples as $people)
                <tr>
                    <td>{{ $people->fio }}</td>
                    @foreach($positions as $position)

                        @if(in_array($position->id, explode(',', $people->positions)))
                            <td><span>&#10003;</span> </td>
                        @else
                            <td></td>
                        @endif
                    @endforeach
                    <!-- показательный кусок, тут что-то типа вывода динамич. кол-ва полей mysql p1, p2,...pn -->
                    {{--@for($i=1; $i <= $positionsCount; $i++)
                        <!-- этот {'p'.$i}  формирует поля типа $people->p1, $people->p2, ,,, $people->p$i -->
                        @if($people->{'p'.$i} )
                                <td><span>&#10003;</span></td>
                            @else
                                <td></td>
                        @endif
                    @endfor--}}
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

