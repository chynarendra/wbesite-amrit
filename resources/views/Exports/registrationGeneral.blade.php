<table>
    <thead>
    <tr>
        <td colspan="10">Information Registration (General)</td>
    </tr>
    <tr>
        <td colspan="10">Date : {{isset($request->from_date)?$request->from_date:''}} To {{isset($request->to_date)?$request->to_date:''}}</td>
    </tr>
    <tr>
        <th>S.N.</th>
        <th>Reg. Date</th>
        <th>Reg. No</th>
        <th>Ref. No.</th>
        <th>Ref. Date</th>
        <th>Issued To</th>
        <th>Address</th>
        <th>Subject</th>
    </tr>
    </thead>
    <tbody>
    @foreach($registrationGenerals as $key=>$registrationGeneral)
        <tr>
            <td>{{++$key}}</td>
            <td>{{$registrationGeneral->REG_DT_NEP}}</td>
            <td>{{$registrationGeneral->REG_NO}}</td>
            <td>{{$registrationGeneral->REF_NO}}</td>
            <td>{{$registrationGeneral->REF_DT_NEP}}</td>
            <td>{{$registrationGeneral->ISSUED_BY}}</td>
            <td>{{$registrationGeneral->ADDRESS}}</td>
            <td>{{$registrationGeneral->SUBJECT}}</td>
        </tr>
    @endforeach
    </tbody>
</table>