@extends('app')

@section('content')
    <h3>Добавление сотрудника</h3>

    <div class="card border-secondary mb-3" >
        <div class="card-header">Введите данные</div>
        <div class="card-body text-secondary">

            <div>
                @include('site.status-block')
            </div>

            <form action="{{ route('staff.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Введите ваше Имя"
                           value="{{ old('first_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите Фамилию"
                           value="{{ old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Введите Отчество"
                           value="{{ old('middle_name') }}">
                </div>

                <div class="d-flex ">
                    <div class="form-group" >
                        <label for="sex">Пол</label>
                        <select class="form-control" id="sex" name="sex" >
                            <option disabled selected value="">выберите пол</option>
                            <option value="мужской" {{ old('sex') == 'мужской' ? 'selected' : '' }}>
                                мужской
                            </option>
                            <option value="женский" {{ old('sex') == 'женский' ? 'selected' : '' }}>
                                женский
                            </option>
                        </select>
                    </div>
                    <div class="form-group ml-3">
                        <label for="salary">Заработная плата</label>
                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Целое число"  value="{{ old('salary') }}">
                    </div>

                </div>

                <div class="form-group" style="max-width: 20rem">
                    <label for="positions">Отдел/ы (используйте Ctrl + Click)</label>
                    <select multiple class="form-control" id="positions" name="positions[]">
                        @foreach($positions as $position)
                            <option value="{{ $position['id'] }}">{{ $position['position'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>

            </form>


        </div>
    </div>
@endsection
