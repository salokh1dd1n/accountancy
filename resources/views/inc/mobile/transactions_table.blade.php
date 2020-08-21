<div class="row">
    @forelse($transactions as $key => $transaction)
        <div class="col-md-6 col-12 transaction-card">
            <span class="transaction-category" style="background-color: {{ optional($transaction->category)->color }}">
                {{ optional($transaction->category)->title }}
            </span>
            <span class="transaction-date float-right">{{ $transaction->date }}</span>
            <div class="transaction-description">
                {{ $transaction->description }}
                <hr>
                <div class="transaction-amount">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <strong class="text-sm-left text-center"><h4>{{ format_number($transaction->amountWithSeparation) }}</h4></strong>
                        </div>
                        <div class="col-sm-6 col-12">
                            <a href="" class="btn btn-success btn-sm float-right w-xs-100 mt-sm-0 mt-3">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12 col-12">
            <div class="transaction-description text-center mt-2">
                {{ __('transaction.not_found') }}
            </div>
        </div>
        <tr>
            <th class="text-center text-middle"
                colspan="5"></th>
        </tr>
    @endforelse
</div>
