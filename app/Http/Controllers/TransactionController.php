<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use App\Traits\TransactionTrait;
use App\Repositories\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\MessageBag;

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
//        dd(emotify('error', 'Update error. Transaction update failed'));
//        notify()->success('Welcome to Laravel Notify ⚡️', 'My custom title');
//        emotify('success', 'You are awesome, your data was successfully created');
//        notify()->success('Laravel Notify is awesome!');
        $yearMonth = $this->getYearMonth();

        $transactions = $this->transactionsRepository->getFilterTransactionsPaginate($yearMonth);

        $income = $this->transactionsRepository->getIncome($yearMonth);
        $spending = $this->transactionsRepository->getSpending($yearMonth);
        $difference = $income - $spending;
        $startBalance = $this->transactionsRepository->getStartBalance($yearMonth);
        $endBalance = $startBalance + $income - $spending;

        $categories = $this->categoryRepository->getAllCategories();

        if(in_array(request('action'), ['edit', 'delete']) and request('id') != null){
            $transaction = $this->transactionsRepository->getTransaction(request('id'));
        }

        return view('transactions.index',
            compact('transactions', 'income',
                'spending', 'difference',
                'startBalance', 'endBalance',
                'categories', 'transaction'));
    }

    public function create(TransactionRequest $request)
    {
        $data = $request->input();

        $result = $this->transactionsRepository->addTransaction($data);
        return $result;
    }

    public function edit(TransactionRequest $request, $id)
    {
        $data = $request->input();
        $result = $this->transactionsRepository->editTransaction($data, $id);
//        dd($data,$result, $id);
        return $result;
    }

    public function delete()
    {

    }

    public function notify()
    {

    }
}
