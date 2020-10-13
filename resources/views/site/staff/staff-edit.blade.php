@extends('app')

@section('content')
    <h3>Редактирование  сотрудника</h3>

    <div class="card border-secondary mb-3" >
        <div class="card-header">Введите данные</div>
        <div class="card-body text-secondary">

            @include('site.status-block')

            <form action="{{ route('post.staff.update', ['id' => $people->id]) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Введите ваше Имя"
                           value="{{( isset($people->first_name)) ? $people->first_name : old('first_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите Фамилию"
                           value="{{ (isset($people->last_name)) ? $people->last_name :  old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Введите Отчество"
                           value="{{ (isset($people->middle_name)) ? $people->middle_name :   old('middle_name') }}">
                </div>

                <div class="d-flex ">
                    <div class="form-group" >
                        <label for="sex">Пол</label>
                        <select class="form-control" id="sex" name="sex"   >
                            @foreach($gender as $item)
                                <option {{ (isset($people->sex) && ($people->sex == $item)) ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="salary">Заработная плата</label>
                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Целое число"
                               value="{{ isset($people->salary) ? $people->salary : old('salary') }}">
                    </div>

                </div>

                {{--<div class="form-group" style="max-width: 20rem">
                    <label for="positions">Отдел/ы (используйте Ctrl + Click)</label>
                    <select multiple class="form-control" id="positions" name="positions[]">
                        @foreach($positions as $position)
                            <option value="{{ $position['id'] }}" >
                                {{ $position['position'] }}
                            </option>
                        @endforeach
                    </select>
                </div>--}}

                <button type="submit" class="btn btn-primary">Сохранить</button>

            </form>


        </div>
    </div>
@endsection
