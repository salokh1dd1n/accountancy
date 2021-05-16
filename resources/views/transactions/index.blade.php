@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-lg-6 col-12">
                        <h3 class="">Список транзакций</h3>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="float-right">
                            <a href="{{ route('transactions', ['action' => 'create', 'month' => request('month'), 'year' => request('year')]) }}"
                               class="btn btn-primary">
                                Добавить транзакцию
                            </a>
                            @include('transactions.transactionModals')
                        </div>
                    </div>
                </div>
                @include('transactions.statistics')

                <div class="card shadow">
                    <div class="card-header border-0">
                        @include('transactions.filters')
                    </div>
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-8 col-12">

                                <h5 class="mb-0">Всего: {{ $transactions->total() }} транзакций</h5>
                            </div>
                            <div class="col-lg-4 col-12 mt-sm-0 mt-3">
                                <a href="{{ route('transactions.export', ['category_id' => request('category_id'), 'query' => request('query')]) }}"
                                   class="btn btn-info btn-sm float-right">Экспорт в Excel</a>
                            </div>
                        </div>
                    </div>
                    @desktop
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">№</th>
                                <th scope="col" class="text-center">Тип</th>
                                <th scope="col" class="text-center">Дата</th>
                                <th scope="col">Комментарий</th>
                                <th scope="col">Категория</th>
                                <th scope="col" class="text-right">Сумма</th>
                                <th scope="col" class="text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $key => $transaction)
                                @php
                                    $groups = $transactions->where('date_only', $transaction->date_only);
                                    $firstGroup = $groups->first();
                                    $groupCount = $groups->count();
                                @endphp
                                <tr>
                                    <th class="text-center text-middle">{{ $key + 1 }}</th>
                                    <td class="text-center text-middle">
                                        @if($transaction->is_income)
                                            Доход
                                        @else
                                            Расход
                                        @endif
                                    </td>
                                    @if ($firstGroup->id == $transaction->id)
                                        <td class="text-center text-middle"
                                            rowspan="{{ $groupCount }}">{{ $transaction->dateOnly }}</td>
                                    @endif
                                    <td class="text-middle">
                                        {{ $transaction->description }}
                                    </td>
                                    <td>
                                        <span class="badge"
                                              style="background-color: {{ optional($transaction->category)->color }};">{{ optional($transaction->category)->title }}</span>
                                    </td>
                                    <td class="text-right text-middle"
                                        nowrap="nowrap">{{ format_number($transaction->amountWithSeparation) }}</td>
                                    <td class="text-center text-middle">
                                        <a href="{{ route('transactions', ['action' => 'edit', 'id' => $transaction->id, 'month' => request('month'), 'year' => request('year')]) }}"
                                           class="btn btn-success">Редактировать</a>
                                        <a href="{{ route('transactions', ['action' => 'delete', 'id' => $transaction->id, 'month' => request('month'), 'year' => request('year')]) }}"
                                           class="btn btn-danger">Удалить</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="text-center text-middle"
                                        colspan="7">Транзакции не найдено
                                    </th>
                                </tr>
                            @endforelse
                            <tr>
                                <th colspan="5" class="text-right">Начальный баланс</th>
                                <td colspan="2">{{ format_number($numbers->startBalance) }}</td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">Общий доход</th>
                                <td colspan="2">{{ format_number($numbers->income) }}</td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">Общая сумма расходов</th>
                                <td colspan="2">{{ format_number($numbers->spending) }}</td>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">Конечный баланс</th>
                                <td colspan="2">{{ format_number($numbers->endBalance) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @elsedesktop
                    @include('transactions.mobile.transactions_table')
                    @enddesktop
                    <div class="card-footer pt-4">
                        @if($transactions->total() > $transactions->count())
                            @tablet
                            {{ $transactions->links('inc.mobile.tablet-pagination') }}
                            @endtablet

                            @desktop
                            {{ $transactions->links('inc.pagination') }}
                            @enddesktop

                            @mobile
                            {{ $transactions->links('inc.mobile.mobile-pagination') }}
                            @endmobile
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('libs/datepicker/bootstrap-datepicker.min.js') }}"></script>
    @if(app()->getLocale() != 'en')
        <script src="{{ asset('libs/datepicker/lang/bootstrap-datepicker.'.app()->getLocale().'.min.js') }}"
                charset="UTF-8"></script>
    @endif


    <script type="text/javascript">
        var d = new Date();

        var year = d.getFullYear();
        var month = d.getMonth();
        var day = d.getDate();

        var sd = new Date(year - 5, month, day);
        var en = new Date();

        $('#transactionDatepicker').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true,
            language: '{{ app()->getLocale() }}',
            startDate: sd,
            endDate: en,
        });
        $('form').parsley({
            errorClass: 'is-invalid',
            successClass: 'is-valid',

            errorsWrapper: '<span class="invalid-feedback" role="alert"></span>',
            errorTemplate: '<strong></strong>',
        });
        // Filter hide and show Start
        $('#showFilter').click(function () {
            $('#hideFilter').show();
            $('#filter').toggle('slow');
            $(this).hide();
        });

        $('#hideFilter').click(function () {
            $('#showFilter').show();
            $('#filter').toggle('slow');
            $(this).hide();
        });
        // Filter hide and show End

        // Statistics hide and show Start
        $('#showStatistics').click(function () {
            $('#hideStatistics').show();
            $('#mobileStatistics').toggle('slow');
            $(this).hide();
        });

        $('#hideStatistics').click(function () {
            $('#showStatistics').show();
            $('#mobileStatistics').toggle('slow');
            $(this).hide();
        });
        // Statistics hide and show End

        // $('#toggleBalance').click(function () {
        //     $('#mobileStatistics').toggle('slow');
        // });
        $('#transactionModal').modal({
            show: true,
            keyboard: false,
            backdrop: 'static'
        });

    </script>

@endpush
