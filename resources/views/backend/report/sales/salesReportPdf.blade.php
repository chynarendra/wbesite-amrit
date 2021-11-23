
<table style="border-collapse: collapse;text-align: center;">
    <thead>
    <tr>
        <th rowspan="2">{{trans('app.sn')}}</th>
        <th rowspan="2">{{trans('Executive Name')}}</th>
        <th rowspan="2">{{trans('Post')}}</th>
        <th colspan="6" class="text-center">{{trans('Number Of Visit')}}</th>
        <th rowspan="2">{{trans('Week Off Days')}}</th>
        <th rowspan="2">{{trans('Leave Days')}}</th>
        <th rowspan="2">{{trans('Average Daily Visit')}}</th>
        <th rowspan="2">{{trans('Sales')}}</th>

    </tr>
    <tr>
        <th rowspan="2">New</th>
        <th rowspan="2">Old</th>
        <th rowspan="2">Hot</th>
        <th rowspan="2">Warm</th>
        <th rowspan="2">Cold</th>
        <th rowspan="2">Confirmed</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $totalNew = 0;
    $totalOld = 0;
    $totalHot = 0;
    $totalWarm = 0;
    $totalCold = 0;
    $totalConfirmed = 0;
    $totalHoliday = 0;
    $totalLeave = 0;
    $totalAverageVisit = 0;
    $totalSales = 0;
    ?>
    @foreach($salesDataArr as $key=>$data)
        <?php
        $totalNew = $totalNew + $data['New'];
        $totalOld = $totalOld + $data['Old'];
        $totalHot = $totalHot + $data['Hot'];
        $totalWarm = $totalWarm + $data['Warm'];
        $totalCold = $totalCold + $data['Cold'];
        $totalConfirmed = $totalConfirmed + $data['Confirmed'];
        $totalHoliday = $totalHoliday + $data['Holiday'];
        $totalLeave = $totalLeave + $data['Leave'];
        $totalAverageVisit = $totalAverageVisit + $data['daily_average_visit'];
        $totalSales = $totalSales + $data['Installed'];
        ?>
        <tr>
            <th scope=row>{{ ++$key }}</th>
            <td>{{$data['name']}}</td>
            <td>{{$data['post']}}</td>
            <td>{{$data['New']}}</td>
            <td>{{$data['Old']}}</td>
            <td>{{$data['Hot']}}</td>
            <td>{{$data['Warm']}}</td>
            <td>{{$data['Cold']}}</td>
            <td>{{$data['Confirmed']}}</td>
            <td>{{$data['Holiday']}}</td>
            <td>{{$data['Leave']}}</td>
            <td>{{$data['daily_average_visit']}}</td>
            <td>{{$data['Installed']}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <th>Grand Total</th>
        <td></td>
        <td>{{$totalNew}}</td>
        <td>{{$totalOld}}</td>
        <td>{{$totalHot}}</td>
        <td>{{$totalWarm}}</td>
        <td>{{$totalCold}}</td>
        <td>{{$totalConfirmed}}</td>
        <td>{{$totalHoliday}}</td>
        <td>{{$totalLeave}}</td>
        <td>{{$totalAverageVisit}}</td>
        <td>{{$totalSales}}</td>
    </tr>
    </tbody>
</table>