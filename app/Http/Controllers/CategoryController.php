<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\TransactionRepository;

class CategoryController extends Controller
{

    private $transactionsRepository;
    private $categoryRepository;
    private $route;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = 'categories';
        $this->middleware('auth');
        $this->transactionsRepository = app(TransactionRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearMonth = parent::getYearMonth();

        $category = null;
        $categories = $this->categoryRepository->getAllCategories();


        if (in_array(request('action'), ['edit', 'delete']) and request('id') != null) {
            $category = $this->categoryRepository->getCategory(request('id'));
            $this->authorize('update', $category);
        }

        return view('categories.index',
            compact('categories', 'category' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRequest $request)
    {
        $data = $request->input();
        $result = $this->categoryRepository->addRecord($data, $this->route);

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryUpdateRequest $request, $id)
    {
        $data = $request->input();
        $result = $this->categoryRepository->editRecord($data, $id, $this->route);

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->categoryRepository->deleteRecord($id, $this->route);
        return $result;
    }

    public function showRelatedTransactions($id)
    {
        $yearMonth = parent::getYearMonth();
        $numbers = $this->transactionsRepository->getNumbers($yearMonth);
        $transactions = $this->transactionsRepository->getTransactionsByCategory($id);
        return view('categories.categoryTransactions', compact('transactions', 'numbers'));
    }
}
