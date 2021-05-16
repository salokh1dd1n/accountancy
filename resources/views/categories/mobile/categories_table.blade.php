<div class="row">
    @forelse($categories as $key => $category)
        <div class="col-md-6 col-12 transaction-card mb-0">
            <span class="transaction-category" style="background-color: {{ $category->color }}">
                {{ $category->title }}
            </span>
            <div class="transaction-description">
                <div class="transaction-amount">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <strong class="text-sm-left text-center">
                                <h5>{{ $category->description }}</h5></strong>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="row">
                                <div class="col-6 px-1">
                                    <a href="{{ route('categories', ['action' => 'edit', 'id' => $category->id]) }}"
                                       class="btn btn-success w-100 btn-sm mt-sm-0 mt-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </div>
                                <div class="col-6 p-0 px-1">
                                    <a href="{{ route('categories', ['action' => 'delete', 'id' => $category->id]) }}"
                                       class="btn btn-danger w-100 btn-sm float-right mt-sm-0 mt-3">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12 col-12">
            <div class="transaction-description text-center mt-2">
                Категория не найдена
            </div>
        </div>
        <tr>
            <th class="text-center text-middle"
                colspan="5"></th>
        </tr>
    @endforelse
</div>
