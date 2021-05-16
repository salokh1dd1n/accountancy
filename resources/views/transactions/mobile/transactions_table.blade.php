<div class="row">
    @forelse($transactions as $key => $transaction)
        <div class="col-md-6 col-12 transaction-card mb-0">
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
                            <strong class="text-sm-left text-center">
                                <h5>{{ format_number($transaction->amountWithSeparation) }}</h5></strong>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="row">
                                <div class="col-6 px-1">
                                    <a href="{{ route('transactions', ['action' => 'edit', 'id' => $transaction->id]) }}"
                                       class="btn btn-success w-100 btn-sm mt-sm-0 mt-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </div>
                                <div class="col-6 p-0 px-1">
                                    <a href="{{ route('transactions', ['action' => 'delete', 'id' => $transaction->id]) }}"
                                       class="btn btn-danger w-100 btn-sm float-right mt-sm-0 mt-3">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12 col-12">
            <div class="transaction-description text-center mt-2">
                Транзакции не найдено
            </div>
        </div>
        <tr>
            <th class="text-center text-middle"
                colspan="5"></th>
        </tr>
    @endforelse
</div>
