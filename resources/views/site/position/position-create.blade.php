{{--это одна вьюха на добавление и редактирование отдела--}}
@extends('app')

@section('content')
    <h3>{{ isset($position) ? 'Редактирование отдела' : 'Добавление отдела' }}</h3>

    <div class="card border-secondary mb-3" >
        <div class="card-header">Введите данные</div>
        <div class="card-body text-secondary">

            @include('site.status-block')

            <form action="{{ isset($position) ? route('positions.update', ['position'=>$position]) : route('positions.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="position">Название отдела</label>
                    <input type="text" class="form-control" id="position" name="position" placeholder="Введите название отдела"
                           value="{{ isset($position) ? $position->position : old('position') }}">
                </div>

                <div class="form-group">
                    <label for="quantity">Количество сотрудников в отделе</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Введите число"
                           value="{{ isset($position) ? $position->quantity : old('quantity') }}">
                </div>

                <div class="form-group">
                    <label for="salary">Максимальная зарплата в отделе</label>
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Введите целое число"
                           value="{{ isset($position) ? $position->salary : old('salary') }}">
                </div>
                @if(isset($position))
                    @method('PUT')
                @endif
                <button type="submit" class="btn btn-primary">Сохранить</button>

            </form>


        </div>
    </div>
@endsection
