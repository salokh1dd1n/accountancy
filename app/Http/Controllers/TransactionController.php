<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Http\Requests\TransactionRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use Maatwebsite\Excel\Excel;

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
//        dd($yearMonth);
        $transactions = $this->transactionsRepository->getTransactionsPaginate($yearMonth);
        $transaction = null;

//        dd($yearMonth);

        $numbers = $this->transactionsRepository->getNumbers($yearMonth);

        $categories = $this->categoryRepository->getAllCategories();

        if (in_array(request('action'), ['edit', 'delete']) and request('id') != null) {
            $transaction = $this->transactionsRepository->getTransaction(request('id'));
            $this->authorize('update', $transaction);
        }

        return view('transactions.index',
            compact('transactions', 'numbers', 'categories', 'transaction', 'yearMonth'));
    }

    public function create(TransactionRequest $request)
    {
        $yearMonth = parent::getYearMonth();
//        dd($yearMonth);
        $numbers = $this->transactionsRepository->getNumbers($yearMonth);
        $data = $request->input();
        if (!$request->is_income && $request->amount > $numbers->income) {
            return back()
                ->withErrors(['amount' => 'Расходы превышают сумму дохода ('.format_number($numbers->income).') за этот месяц'])
                ->withInput();
        } else {
            $result = $this->transactionsRepository->addRecord($data, $this->route);
        }
        return $result;
    }

    public function edit(TransactionRequest $request, $id)
    {
        $yearMonth = parent::getYearMonth();
        $numbers = $this->transactionsRepository->getNumbers($yearMonth);
        $transaction = $this->transactionsRepository->getTransaction($id);
        $data = $request->input();
        if (!$request->is_income && $request->amount > ($numbers->income - $transaction->amount)) {
            return back()
                ->withErrors(['amount' => 'Расходы превышают сумму дохода ('.format_number($numbers->income - $transaction->amount).') за этот месяц'])
                ->withInput();
        } else {
            $result = $this->transactionsRepository->editRecord($data, $id, $this->route);
        }

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
