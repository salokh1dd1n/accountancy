<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col" class="text-center">№</th>
        <th scope="col" class="text-center">Тип</th>
        <th scope="col" class="text-center">Дата</th>
        <th scope="col">Комментарий</th>
        <th scope="col">Категория</th>
        <th scope="col" class="text-right">Сумма</th>
    </tr>
    </thead>
    <tbody>
    @forelse($transactions as $key => $transaction)
        <tr>
            <th class="text-center text-middle">{{ $key + 1 }}</th>
            <td class="text-center text-middle">
                @if($transaction->is_income)
                    Доход
                @else
                    Расход
                @endif
            </td>
                <td class="text-center text-middle">{{ $transaction->date }}</td>
            <td class="text-middle">
                {{ $transaction->description }}
            </td>
            <td>
                <span class="badge" style="background-color: {{ optional($transaction->category)->color }};">{{ optional($transaction->category)->title }}</span>
            </td>
            <td class="text-right text-middle"
                nowrap="nowrap">{{ $transaction->amountWithSeparation }}</td>
        </tr>
    @empty
        <tr>
            <th class="text-center text-middle"
                colspan="7">Транзакции не найдено
            </th>
        </tr>
    @endforelse
    <tr>
        <th colspan="4" class="text-right">Начальный баланс</th>
        <td colspan="2">{{ $numbers->startBalance }}</td>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Общий доход</th>
        <td colspan="2">{{ $numbers->income }}</td>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Общая сумма расходов</th>
        <td colspan="2">{{ $numbers->spending }}</td>
    </tr>
    <tr>
        <th colspan="4" class="text-right">Конечный баланс</th>
        <td colspan="2">{{ $numbers->endBalance }}</td>
    </tr>
    </tbody>
</table>
