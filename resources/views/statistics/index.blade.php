@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Статистика</h3>

                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3>Итог за {{ $routeYear }} год: {{ format_number($profit) }}</h3>
                    </div>
                    <div class="card-header border-0">
                        <form action="">
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-control selectpicker" name="year" data-size="10"
                                            data-style="btn-filter">
                                        @foreach(get_years() as $year)
                                            <option
                                                value="{{ $year }}" {{ isSelected($year, 'year', 'Y') }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-control selectpicker" name="category_id" data-size="10"
                                            data-style="btn-filter">
                                        <option value="" selected>-- Без категории --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-primary filter-button" type="submit">Фильтр</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-12">
                                <div id="yearly-chart" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Месяц</th>
                                <th scope="col" class="text-center">Количество транзакций</th>
                                <th scope="col" class="text-right">Доход</th>
                                <th scope="col" class="text-right">Расход</th>
                                <th scope="col" class="text-right">Разница</th>
                                <th scope="col" class="text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (get_months() as $monthNumber => $monthName)
                                @php
                                    $isset = isset($statistics[$monthNumber]);
                                @endphp
                                <tr>
                                    <th class="text-center text-middle">{{ $monthName }}</th>
                                    <td class="text-center text-middle">{{ $isset ? $statistics[$monthNumber]->count : 0 }}</td>
                                    <td class="text-right text-middle">{{ format_number($income = ($isset ? $statistics[$monthNumber]->income : 0)) }}</td>
                                    <td class="text-right text-middle">{{ format_number($spending = ($isset ? $statistics[$monthNumber]->spending : 0)) }}</td>
                                    <td class="text-right text-middle">{{ format_number($difference = ($isset ? ($statistics[$monthNumber]->income - $statistics[$monthNumber]->spending) : 0)) }}</td>
                                    <td class="text-center text-middle"><a
                                            href="{{ route('transactions', ['month' => $monthNumber, 'year' => $routeYear]) }}"
                                            class="btn btn-info">Просмотр по месяцам</a></td>
                                </tr>
                                @php
                                    $graphDatas[] = ['month' => $monthName, 'income' => $income, 'spending' => $spending, 'difference' => $difference];
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('libs/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs/morris/js/morris.min.js') }}"></script>
    <script src="{{ asset('libs/morris/js/raphael.min.js') }}"></script>


    <script type="text/javascript">
        (function () {
            new Morris.Line({
                element: 'yearly-chart',
                data: {!! collect($graphDatas)->toJson() !!},
                xkey: 'month',
                ykeys: ['income', 'spending', 'difference'],
                labels: ["Доходы", "Расходы", "Разница"],
                parseTime: false,
                lineColors: ['green', 'orange', 'blue'],
                goals: [0],
                goalLineColors: ['red'],
                smooth: true,
                lineWidth: 2,
                resize: true
            });
        })();
    </script>

@endpush
