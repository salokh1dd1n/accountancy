<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Traits\ForAccountacyTrait;
use App\Repositories\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{

    use ForAccountacyTrait;

    private $transactionsRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->transactionsRepository = app(TransactionRepository::class);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $yearMonth = $this->getYearMonth();

        $transactions = $this->transactionsRepository->getAllTransactions($yearMonth);

        $income = $this->getIncomeTotal($transactions);
        $spending = $this->getSpendingTotal($transactions);
        $difference = $this->getIncomeTotal($transactions) - $this->getSpendingTotal($transactions);

        return view('transactions.index', compact('transactions', 'income', 'spending', 'difference'));
    }
}
