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
                        <th>{{ $position->position }} </th>
                    @endforeach
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($peoples as $people)
                <tr>
                    <td>{{ $people->fio }}</td>
                    @for($i=1; $i <= $positionsCount; $i++)
                        {{-- это  {'p'.$i}  формирует поля типа $people->p1, $people->p2, ,,, $people->p$i --}}
                        @if($people->{'p'.$i} )
                                <td><span>&#10003;</span></td>
                            @else
                                <td></td>
                        @endif
                    @endfor
                    {{--@if($people->p2)
                        <td><span>&#10003;</span></td>
                    @else
                        <td></td>
                    @endif
                    @if($people->p3)
                        <td><span>&#10003;</span></td>
                    @else
                        <td></td>
                    @endif
                    @if($people->p4)
                        <td><span>&#10003;</span></td>
                    @else
                        <td></td>
                    @endif--}}

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection

{{--@foreach ($peoples as $people)
    <tr>
        <td>{{ $people->first_name .' '. $people->last_name }}</td>
        @foreach($people->positions as $position)
            @for($i=0; $i < count($positions); $i++)

                @if($i+1 == $position->pivot->position_id)
                    <td> <span>&#10003;</span> </td>
                @else
                    <td></td>
                @endif

            @endfor

        @endforeach
    </tr>
@endforeach--}}

{{-- <span>&#10003;</span> --}}
{{-- <td>{{ $position->pivot->staff_id .'-'. $position->pivot->position_id }} </td> --}}

