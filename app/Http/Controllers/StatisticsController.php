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
        $year = parent::getYear();
        $statistics = $this->transactionRepository->getTransactionStatistics($year);
        $categories = $this->categoryRepository->getAllCategories();

//        dd($statistics);

        return view('statistics.index', compact('statistics', 'year', 'categories'));
    }
}
