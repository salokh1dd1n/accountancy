@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-lg-6 col-12">
                        <h3 class="">Список категорий</h3>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="float-right">
                            <a href="{{ route('categories', ['action' => 'create']) }}" class="btn btn-primary">
                                Добавить категорию
                            </a>
                            @include('categories.categoryModals')
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="mb-0">Всего: {{ $categories->count() }} категории</h5>
                            </div>
                        </div>
                    </div>
                    @desktop
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">№</th>
                                <th scope="col" class="text-center">Заголовок</th>
                                <th scope="col">Комментарий</th>
                                <th scope="col" class="text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $key => $category)
                                <tr>
                                    <th class="text-center text-middle">{{ $key + 1 }}</th>
                                    <td class="text-middle">
                                        <span class="badge"
                                              style="background-color: {{ $category->color }}">{{ $category->title }}</span>
                                    </td>
                                    <td>{{ $category->description }}</td>
                                    <td class="text-center text-middle">
                                        <a href="{{ route('categories', ['action' => 'edit', 'id' => $category->id]) }}"
                                           class="btn btn-success">Редактировать</a>
                                        <a href="{{ route('categories', ['action' => 'delete', 'id' => $category->id]) }}"
                                           class="btn btn-danger">Удалить</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="text-center text-middle"
                                        colspan="7">Категории не найдена
                                    </th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    @elsedesktop
                    @include('categories.mobile.categories_table')
                    @enddesktop
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('libs/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script type="text/javascript">
        $('#categoryColor').colorpicker({
            format: 'auto',
        });
        $('#transactionModal').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
    </script>
@endpush
