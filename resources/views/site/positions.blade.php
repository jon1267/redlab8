@extends('app')

@section('content')
    <div class="col-10 mx-auto">

        @include('site.status-block')

        <div class="d-flex mb-2 justify-content-between">
            <h3>Отделы</h3>
            <a class="btn btn-primary " href="{{ route('positions.create') }}">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                </svg>
                &nbsp;&nbsp;Добавить отдел
            </a>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Название отдела</th>
                <th>Количество сотрудников</th>
                <th>Max зарплата</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($positions as $position)
                <tr class="text-center">
                    <td>{{ $position->id }}</td>
                    <td>{{ $position->position }}</td>
                    <td class="text-center">{{ $position->staff_count }}</td>
                    <td class="text-center">{{ $position->salary }}</td>
                    <td>
                        <form action="{{ route( 'positions.destroy', ['position'=> $position]) }}" method="post" id="position-delete-{{$position->id}}">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex">
                            <a class="btn btn-primary mr-2" href="{{ route('positions.edit', ['position'=> $position] ) }}" role="button" title="Редактировать">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <button type="submit" class="btn btn-danger" href="#" role="button" title="Удалить"
                                    onclick="event.preventDefault(); if(confirm('Вы уверены, что хотите это удалить ?')) {
                                        document.getElementById('position-delete-{{$position->id}}').submit()
                                        }" >
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </div>
                        </form>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $positions->links() }}

    </div>
@endsection
