<?php

namespace App\Exports;


use App\Repositories\TransactionRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromView, ShouldAutoSize
{
    private $yearMonth;
    private $transactionRepository;

    public function __construct($yearMonth)
    {
        $this->yearMonth = $yearMonth;
        $this->transactionsRepository = app(TransactionRepository::class);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $numbers = $this->transactionsRepository->getNumbers($this->yearMonth);
        $transactions = $this->transactionsRepository->getExportTransactions($this->yearMonth);

        return view('transactions.table', compact('transactions', 'numbers'));
    }
}
