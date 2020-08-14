@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('msg'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
                <div class="row mb-4">
                    <div class="col-lg-6 col-12">
                        <h3 class="">Transaction List</h3>
                    </div>
                    @include('inc.addTransactionModals')
                </div>
                @desktop

                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="INCOME">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($income) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="SPENDING">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($spending) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="DIFFERENCE">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($difference) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                @elsedesktop
                <button type="button" class="btn btn-secondary w-100 mb-3" id="toggleBalance">Statistics</button>
                <section id="mobileStatistics">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12 mb-4">
                            <div class="card shadow card-badge" data-label="START BALANCE">
                                <div class="card__container">
                                    <h2 class="card__header">
                                        {{ format_number($startBalance) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12 mb-4">
                            <div class="card shadow card-badge" data-label="END BALANCE">
                                <div class="card__container">
                                    <h2 class="card__header">
                                        {{ format_number($endBalance) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12 mb-4">
                            <div class="card shadow card-badge" data-label="INCOME">
                                <div class="card__container">
                                    <h2 class="card__header">
                                        {{ format_number($income) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12 mb-4">
                            <div class="card shadow card-badge" data-label="SPENDING">
                                <div class="card__container">
                                    <h2 class="card__header">
                                        {{ format_number($spending) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12 mb-4">
                            <div class="card shadow card-badge" data-label="DIFFERENCE">
                                <div class="card__container">
                                    <h2 class="card__header">
                                        {{ format_number($difference) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @enddesktop

                <div class="card shadow">
                    <div class="card-header border-0">
                        @desktop
                        @include('inc.filters')
                        @elsedesktop
                        @include('inc.mobile.filters')
                        @enddesktop
                    </div>
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <h5 class="mb-0">Total: {{ $transactions->count() }} Transaction</h5>
                            </div>
                            <div class="col-lg-4 col-12 mt-sm-0 mt-3">
                                <a href="" class="btn btn-info btn-sm float-right">Export Excel</a>
                            </div>
                        </div>
                    </div>
                    @desktop
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
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
                                    <td class="text-center text-middle"><a href="" class="btn btn-success">Edit</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="text-center text-middle"
                                        colspan="6">{{ __('transaction.not_found') }}</th>
                                </tr>
                            @endforelse
                            <tr>
                                <th colspan="4" class="text-right">Start Balance</th>
                                <td colspan="2">{{ format_number($startBalance) }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Income Total</th>
                                <td colspan="2">{{ format_number($income) }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">Spending Total</th>
                                <td colspan="2">{{ format_number($spending) }}</td>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-right">End Balance</th>
                                <td colspan="2">{{ format_number($endBalance) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @elsedesktop
                    @include('inc.mobile.transactions_table')
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
        var en = new Date(year + 5, month, day);

        $('#incomeDatepicker').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true,
            language: '{{ app()->getLocale() }}',
            startDate: sd,
            endDate: en,
        });
        $('#spendingDatepicker').datepicker({
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

        $('#toggleFilter').click(function () {
            $('#mobileFilter').toggle('slow');
        });
        $('#toggleBalance').click(function () {
            $('#mobileStatistics').toggle('slow');
        });
    </script>

@endpush
