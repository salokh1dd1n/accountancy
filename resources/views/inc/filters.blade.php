<button type="button" class="btn btn-info w-100 mb-3" id="showFilter">Show Filter</button>
<button type="button" class="btn btn-info w-100 mb-3" id="hideFilter">Hide Filter</button>
<form class="@if(!request()->exists('query')) @endif" id="filter">
    <div class="row">
        <div class="col-lg-9 col-12">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 pr-lg-1 mb-lg-0 mb-2">
                    <input class="form-control" placeholder="Search transaction..." name="query"
                           type="text" value="{{ request('query') }}">
                </div>
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 mb-lg-0  mb-2">
                    <select class="form-control selectpicker" name="date" data-size="10" data-style="btn-filter">
                        <option selected="selected" value="">--</option>
                        @foreach(get_dates() as $date)--}}
                        <option value="{{ $date }}" {{ isSelected($date, 'date') }}>{{ $date }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-12 px-lg-1 mb-lg-0 mb-2">
                    <select class="form-control selectpicker" name="month" data-size="10" data-style="btn-filter">
                        @foreach(get_months() as $key => $month)
                            <option value="{{ $key }}" {{ isSelected($key, 'month', 'm') }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-6 col-12 pl-lg-1 mb-lg-0 mb-2">
                    <select class="form-control selectpicker" name="year" data-size="10" data-style="btn-filter">
                        @foreach(get_years() as $year)--}}
                        <option value="{{ $year }}" {{ isSelected($year, 'year', 'Y') }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                {{--    <div class="form-group">--}}
                {{--        <select class="form-control" name="category_id">--}}
                {{--            <option value="" @if(request('category_id') == '') selected @endif>-- All Category --</option>--}}
                {{--            <option value="null" @if(request('category_id') == 'null') selected @endif>-- No Category --</option>--}}
                {{--            @foreach($categories as $category)--}}
                {{--                <option value="{{ $category->id }}"--}}
                {{--                        @if(request('category_id') == $category->id) selected @endif>{{ $category->title }}</option>--}}
                {{--            @endforeach--}}
                {{--        </select>--}}
                {{--    </div> --}}
            </div>
        </div>
    <div class="col-lg-3 col-12">
            <div class=" float-right">
                <input class="btn btn-primary mr-2" type="submit" value="Filtrlash">
                <a href="{{ route('transactions') }}" class="btn btn-secondary">Сброс</a>
            </div>
        </div>
    </div>
</form>
