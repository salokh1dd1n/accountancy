<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = app(TransactionRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        $routeYear = parent::getYear();
        $numbers = $this->transactionRepository->getNumbers($routeYear);
        $profit = $numbers->endBalance;
        $statistics = $this->transactionRepository->getTransactionStatistics($routeYear);
        $categories = $this->categoryRepository->getAllCategories();

//        dd($statistics);

        return view('statistics.index', compact('statistics', 'routeYear', 'categories', 'profit'));
    }
}
