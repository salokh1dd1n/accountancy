<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Excel;
use App\Http\Requests\TransactionRequest;
use App\Policies\TransactionPolicy;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{

    private $transactionsRepository;
    private $categoryRepository;
    private $route;
    private $excel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = 'transactions';
        $this->middleware('auth');
        $this->transactionsRepository = app(TransactionRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
        $this->excel = app(Excel::class);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $yearMonth = parent::getYearMonth();

        $transactions = $this->transactionsRepository->getTransactionsPaginate($yearMonth);
        $transaction = null;

        $numbers = $this->transactionsRepository->getNumbers($yearMonth);

        $categories = $this->categoryRepository->getAllCategories();
//        dd($categories);

        if (in_array(request('action'), ['edit', 'delete']) and request('id') != null) {
            $transaction = $this->transactionsRepository->getTransaction(request('id'));
            $this->authorize('update', $transaction);
        }

        return view('transactions.index',
            compact('transactions', 'numbers', 'categories', 'transaction'));
    }

    public function create(TransactionRequest $request)
    {
        $data = $request->input();
        $result = $this->transactionsRepository->addRecord($data, $this->route);
        return $result;
    }

    public function edit(TransactionRequest $request, $id)
    {
        $data = $request->input();
        $result = $this->transactionsRepository->editRecord($data, $id, $this->route);

        return $result;
    }

    public function destroy($id)
    {
        $result = $this->transactionsRepository->deleteRecord($id, $this->route);

        return $result;
    }

    public function exportData()
    {
        $yearMonth = parent::getYearMonth();

        $result = $this->excel->download(new TransactionsExport($yearMonth), 'transactions.xlsx');

        return $result;
    }

}
