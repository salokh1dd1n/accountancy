<button type="button" class="btn btn-info w-100 mb-3" id="showFilter">Показать фильтр</button>
<button type="button" class="btn btn-info w-100 mb-3" id="hideFilter">Скрыть фильтр</button>
<form id="filter">
    <div class="row">
        <div class="col-lg-2 col-md-6 p-1">
            <input class="form-control" placeholder="Поиск транзакции..." name="query"
                   type="text" value="{{ request('query') }}">
        </div>
        <div class="col-lg-2 col-md-6 p-1">
            <select class="form-control selectpicker" name="category_id" data-size="10" data-style="btn-filter">
                <option value="" selected>-- Все категории --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == request('category_id')) selected @endif>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-6 p-1">
            <select class="form-control selectpicker" name="day" data-size="10" data-style="btn-filter">
                <option selected="selected" value="">--</option>
                @foreach(get_dates() as $date)--}}
                <option value="{{ $date }}" {{ isSelected($date, 'date') }}>{{ $date }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-6 p-1">
            <select class="form-control selectpicker" name="month" data-size="10" data-style="btn-filter">
                <option value="all">-- Все месяцы --</option>
                @foreach(get_months() as $key => $month)
                    <option value="{{ $key }}" {{ isSelected($key, 'month', 'm') }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-6 p-1">
            <select class="form-control selectpicker" name="year" data-size="10" data-style="btn-filter">
                @foreach(get_years() as $year)--}}
                <option value="{{ $year }}" {{ isSelected($year, 'year', 'Y') }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-6 p-1">
            <button class="btn btn-primary filter-button" type="submit">Фильтр</button>
            <a href="{{ route('transactions') }}" class="btn btn-secondary filter-reset-button">Сброс</a>
        </div>
    </div>
</form>
