{{ Form::open(['route'=>['summary'], 'method' => 'get', 'class' => 'form-vertical']) }}
<div class="control-group">
    <label class="control-label">Date from<br>
        <input type="text" class="date-pick input-small" name="date_from" value="{{{ $date_from }}}"/>
    </label>
    <label class="control-label">Date to<br>
        <input type="text" class="date-pick input-small" name="date_to" value="{{{ $date_to }}}"/>
    </label>
    <label class="control-label">Categories<br>
        <label class="checkbox">Income
            {{ Form::checkbox('income_selected', true, $income_selected) }}
        </label>
        @foreach($categories as $category)
        <label class="checkbox">{{{ $category->name_short }}}
            {{ Form::checkbox('category_ids[]', $category->category_id, in_array($category->category_id, $category_ids), ['title' => $category->descr]) }}
        </label>
        @endforeach
    </label>
    <label class="control-label">Report<br>
        <label class="radio">By categories
            {{ Form::radio('groupped_by', 'categories', $groupped_by == 'categories') }}
        </label>
        <label class="radio">By months
            {{ Form::radio('groupped_by', 'months', $groupped_by == 'months') }}
        </label>
        <label class="checkbox">Plot chart
            {{ Form::checkbox('plot_chart', true, $plot_chart) }}
        </label>
    </label>
</div>
<div class="controls">
    {{ Form::submit('Refresh', ['class' => 'btn btn-small btn-primary']) }}
    {{ Form::reset('Reset', ['class' => 'btn btn-small']) }}
</div>
{{ Form::close() }}
