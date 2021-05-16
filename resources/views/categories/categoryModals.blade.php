@if(request('action') == 'create')
    <!-- Modal For Add Transaction -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('categories.create') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-light" id="exampleModalLabel">Добавить категорию</h5>
                        <a href="{{ route('categories') }}" class="close text-light">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="transactionDatepicker"
                                           class="required-input">Название категории</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           placeholder="Title" name="title"
                                           value="{{ old('title') }}" required/>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="category_id">Цвет категории</label>
                                    <div id="categoryColor" class="input-group" title="Using input value">
                                        <input type="text" class="form-control input-lg" value="#DD0F20FF" name="color" />
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                    </div>
                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="required-input">Описание</label>
                                    <textarea class="form-control" id="description"
                                              rows="4" name="description" data-parsley-minlength="3"
                                              data-parsley-maxlength="70"
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
                        <a href="{{ route('categories') }}" class="btn btn-secondary">
                            Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">Добавить категорию</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif

@if(request('action') == 'edit' && $category)
    <!-- Modal For Add Transaction -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('categories.edit', $category->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-light" id="exampleModalLabel">Редактировать категорию</h5>
                        <a href="{{ route('categories') }}" class="close text-light">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="transactionDatepicker"
                                           class="required-input">Название категории</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           placeholder="Title" name="title"
                                           value="{{ $category->title }}" required/>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="category_id">Цвет категории</label>
                                    <div id="categoryColor" class="input-group" title="Using input value">
                                        <input type="text" class="form-control input-lg" value="{{ $category->color }}" name="color" />
                                        <span class="input-group-append">
                                            <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                        </span>
                                    </div>
                                    @error('color')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description" class="required-input">Описание</label>
                                    <textarea class="form-control" id="description"
                                              rows="4" name="description" data-parsley-minlength="3"
                                              data-parsley-maxlength="70"
                                              required>{{ $category->description }}</textarea>

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
                        <a href="{{ route('categories') }}" class="btn btn-secondary">
                            Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">Редактировать категорию</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif
@if(request('action') == 'delete' && $category)
    <!-- Modal For Add Transaction -->
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-light" id="exampleModalLabel">Удалить категорию</h5>
                        <a href="{{ route('categories') }}" class="close text-light">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        Вы уверены, что хотите удалить эту категорию? Это действие нельзя отменить.
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('categories') }}" class="btn btn-secondary">Отмена</a>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endif
