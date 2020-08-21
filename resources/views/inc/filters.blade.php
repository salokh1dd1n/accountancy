<form class="form-inline">
    <div class="form-group mr-2">
        <input class="form-control" placeholder="Search transaction..." name="query"
               type="text" value="{{ request('query') }}">
    </div>
    <div class="form-group mr-2">
        <select class="form-control" name="date">
            <option selected="selected" value="">--</option>
            @foreach(get_dates() as $date)--}}
            <option value="{{ $date }}" {{ isSelected($date, 'date') }}>{{ $date }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mr-2">
        <select class="form-control" name="month">
            @foreach(get_months() as $key => $month)
                <option value="{{ $key }}" {{ isSelected($key, 'month', 'm') }}>{{ $month }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mr-2">
        <select class="form-control" name="year">
            @foreach(get_years() as $year)--}}
            <option value="{{ $year }}" {{ isSelected($year, 'year', 'Y') }}>{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="category_id">
            <option value="" @if(request('category_id') == '') selected @endif>-- All Category --</option>
            <option value="null" @if(request('category_id') == 'null') selected @endif>-- No Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if(request('category_id') == $category->id) selected @endif>{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group ml-auto">
        <input class="btn btn-primary mr-2" type="submit" value="Submit">
        <a href="{{ route('transactions') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>
