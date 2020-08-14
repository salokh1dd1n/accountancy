<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use App\Traits\TransactionTrait;
use App\Repositories\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{

    use TransactionTrait;

    private $transactionsRepository;
    private $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->transactionsRepository = app(TransactionRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $yearMonth = $this->getYearMonth();

        $transactions = $this->transactionsRepository->getTransactionsPaginate($yearMonth);

        $income = $this->transactionsRepository->getIncome($yearMonth);
        $spending = $this->transactionsRepository->getSpending($yearMonth);
        $difference = $income - $spending;
        $startBalance = $this->transactionsRepository->getStartBalance($yearMonth);
        $endBalance = $startBalance + $income - $spending;

        $categories = $this->categoryRepository->getAllCategories();

        return view('transactions.index',
            compact('transactions', 'income',
                'spending', 'difference',
                'startBalance', 'endBalance',
                'categories'));
    }

    public function addTransaction(Request $req)
    {

    }
}
