<table>
    <thead>
    <tr>
        <td colspan="10"> Information Dispatch (General)</td>
    </tr>
    <tr>
        <td colspan="10">Date : {{isset($request->from_date)?$request->from_date:''}} To {{isset($request->to_date)?$request->to_date:''}}</td>
    </tr>
    <tr>
        <th rowspan="2">S.N.</th>
        <th colspan="3">Dispatch</th>
        <th rowspan="2">Ref. No.</th>
        <th rowspan="2">Issued To</th>
        <th rowspan="2">Address</th>
        <th rowspan="2">Subject</th>
        <th rowspan="2">User</th>
    </tr>
    <tr>
        <th>No.</th>
        <th>Date</th>
        <th>Method</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dispatchGenerals as $key=>$dispatchGeneral)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$dispatchGeneral->DISPATCH_NO}}</td>
            <td>{{$dispatchGeneral->DISPATCH_DT_NEP}}</td>
            <td>{{$dispatchGeneral->DISPATCH_METHOD}}</td>
            <td>{{$dispatchGeneral->REF_NO}}</td>
            <td>{{$dispatchGeneral->ISSUED_TO}}</td>
            <td>{{$dispatchGeneral->ADDRESS}}</td>
            <td>{{$dispatchGeneral->SUBJECT}}</td>
            <td>{{$dispatchGeneral->ENTERED_BY}}</td>
        </tr>
    @endforeach
    </tbody>
</table>