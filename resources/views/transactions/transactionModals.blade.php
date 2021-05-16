@if(request('action') == 'create')
    <!-- Modal For Add Transaction -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('transactions.create') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="modal-header bg-primary">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Добавить транзакцию</h5>
                        <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                           class="close text-light">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="transactionDatepicker"
                                           class="required-input">Дата</label>
                                    <input type="text" class="form-control @error('date') is-invalid @enderror"
                                           id="transactionDatepicker"
                                           placeholder="Date" name="date" autocomplete="off"
                                           value="{{ old('date') }}" required/>
                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                            id="category_id"
                                            name="category_id">
                                        <option value="" selected>-- Без категории --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group required">
                                    <label for="amount" class="required-input">Сумма</label>
                                    <input class="form-control text-right @error('amount') is-invalid @enderror"
                                           name="amount"
                                           type="number" data-parsley-maxlength="20" parsley-type="number"
                                           id="amount" value="{{ old('amount') }}"
                                           required>
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mb-2">
                                <label class="required-input">Тип</label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="is_income" value="1"
                                               class="custom-control-input @error('is_income') is-invalid @enderror"
                                               checked>
                                        <label class="custom-control-label" for="customRadioInline1">Доход</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="is_income" value="0"
                                               class="custom-control-input @error('is_income') is-invalid @enderror">
                                        <label class="custom-control-label"
                                               for="customRadioInline2">Расход</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="required-input">Комментарий</label>
                                    <textarea class="form-control" id="description"
                                              rows="4" name="description" data-parsley-minlength="5"
                                              data-parsley-maxlength="250"
                                              required>{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                           class="btn btn-secondary">
                            Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif

@if(request('action') == 'edit' && $transaction)
    @can('update', $transaction)
        <!-- Modal For Add Transaction -->
        <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('transactions.edit', $transaction->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Редактировать транзакцию</h5>
                            <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                               class="close text-light">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="transactionDatepicker"
                                               class="required-input">Дата</label>
                                        <input type="text" class="form-control @error('date') is-invalid @enderror"
                                               id="transactionDatepicker"
                                               placeholder="Date" name="date" autocomplete="off"
                                               value="{{ $transaction->date }}" required/>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="category_id">Категория</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                                id="category_id"
                                                name="category_id">
                                            <option value="">-- Без категории --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($transaction->category and $transaction->category->id == $category->id) selected @endif>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group required">
                                        <label for="amount" class="required-input">Сумма</label>
                                        <input class="form-control text-right @error('amount') is-invalid @enderror"
                                               name="amount"
                                               type="number" data-parsley-maxlength="20" parsley-type="number"
                                               id="amount" value="{{ $transaction->amount }}"
                                               required>
                                        @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mb-2">
                                    <label class="required-input">Тип</label>
                                    <div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline1" name="is_income" value="1"
                                                   class="custom-control-input @error('is_income') is-invalid @enderror"
                                                   @if($transaction->is_income) checked @endif>
                                            <label class="custom-control-label" for="customRadioInline1">Доход</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="customRadioInline2" name="is_income" value="0"
                                                   class="custom-control-input @error('is_income') is-invalid @enderror"
                                                   @if(!$transaction->is_income) checked @endif>
                                            <label class="custom-control-label"
                                                   for="customRadioInline2">Расход</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description" class="required-input">Комментарий</label>
                                        <textarea class="form-control" id="description"
                                                  rows="4" name="description" data-parsley-minlength="5"
                                                  data-parsley-maxlength="250"
                                                  required>{{ $transaction->description }}</textarea>

                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                               class="btn btn-secondary">Отмена</a>
                            <button type="submit" class="btn btn-success">Редактировать</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endcan
@endif
@if(request('action') == 'delete' && $transaction)
    <!-- Modal For Add Transaction -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('transactions.delete', $transaction->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-light" id="exampleModalLabel">Удалить транзакцию</h5>
                        <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                           class="close text-light">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        Вы уверены, что хотите удалить эту транзакцию? Это действие нельзя отменить.
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('transactions', ['month' => request('month'), 'year' => request('year')]) }}"
                           class="btn btn-secondary">Отмена</a>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif
