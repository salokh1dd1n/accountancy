@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="INCOME">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($income) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="SPENDING">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($spending) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mb-4">
                        <div class="card shadow card-badge" data-label="DIFFERENCE">
                            <div class="card__container">
                                <h2 class="card__header">
                                    {{ format_number($difference) }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header border-0">
                        <h5 class="mb-0">Card tables</h5>
                    </div>
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
                                    <td class="text-right text-middle badge-one"
                                        nowrap="nowrap">{{ format_number($transaction->amountWithSeparation) }}</td>
                                    <td class="text-center text-middle"><a href="" class="btn btn-success">Edit</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="text-center text-middle"
                                        colspan="5">{{ __('transaction.not_found') }}</th>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pt-4">
                        @if($transactions->total() > $transactions->count())
                            {{ $transactions->links() }}
                        @endif
                    </div>
                </div>
                {{--                    <div class="panel panel-default">--}}
                {{--                        <table class="table table-bordered">--}}
                {{--                            <thead>--}}
                {{--                            <tr>--}}
                {{--                                <th scope="col">#</th>--}}
                {{--                                <th scope="col">Date</th>--}}
                {{--                                <th scope="col">Transaction Description</th>--}}
                {{--                                <th scope="col">Amount</th>--}}
                {{--                                <th scope="col">Action</th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                            <tbody>--}}
                {{--                            @foreach($transactions as $key => $transacton)--}}
                {{--                                <tr>--}}
                {{--                                    <th scope="row">{{ $key + 1 }}</th>--}}
                {{--                                    <td>{{ $transacton->date }}</td>--}}
                {{--                                    <td>{{ $transacton->description }}</td>--}}
                {{--                                    <td>{{ $transacton->amount }}</td>--}}
                {{--                                    <td>Edit</td>--}}
                {{--                                </tr>--}}
                {{--                            @endforeach--}}
                {{--                            </tbody>--}}
                {{--                        </table>--}}
                {{--                    </div>--}}


            </div>
        </div>
    </div>
@endsection
