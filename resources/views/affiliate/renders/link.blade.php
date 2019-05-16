<table  class="table table-striped">
    <thead>
        <tr>
            <th>Link rút gọn</th>
            <th>Link đích</th>
            <th>UTM source</th>
            <th>UTM medium</th>
            <th>UTM campaign</th>
            <th>Aff sub 1</th>
            <th>Aff sub 2</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $data as $item )
        <tr>
            <td>{{ $item->short_url }}</td>
            <td width="">
                <div style="max-width: 320px; overflow: auto">{{ $item->current_url }}</div>

            </td>
            <td>{{ $item->utm_source }}</td>
            <td>{{ $item->utm_medium }}</td>
            <td>{{ $item->utm_campaign }}</td>
            <td>{{ isset($item->aff_sub1) ? $item->aff_sub1 : '' }}</td>
            <td>{{ isset($item->aff_sub2) ? $item->aff_sub2 : '' }}</td>
            <td>{{ \Illuminate\Support\Carbon::parse($item->created_at )->subHour() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


<div id="data-pagination" class="d-flex justify-content-center">
    {!! $data->appends(request()->input())->links() !!}
</div>