<table style="border-collapse: collapse;">
    <thead>
        <tr>
            <th width="10px">{{ trans('app.sn') }}</th>
            <th>{{ trans('Office Name') }}</th>
            <th>{{ trans('Sell Product No.') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $key => $data)
            <tr>
                <th scope=row>{{ $key++ }}</th>
                <td>
                    @if (isset($data['office_name']))
                        {{ $data['office_name'] }}
                    @endif
                </td>
                <td>
                    @if (isset($data['sell_count']))
                        {{ $data['sell_count'] }}
                    @endif
                </td>

            </tr>
        @endforeach
    </tbody>
</table>