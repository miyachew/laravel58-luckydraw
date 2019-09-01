@extends('layout.root' )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Overview</h1>
            <h3>Existing members and their winning numbers</h3>
            <table width="100%" border="1" cellpadding=10 cellspacing=10>
                <tr>
                    <th>Member</th>
                    <th>Winning Numbers</th>
                </tr>
                @if(count($members)>0)
                    @foreach($members as $member)
                        <tr>
                        <td>{{$member->name}}</td>
                        <td>{{ $member->winningNumbers ?  implode(",",$member->winningNumbers->pluck('winning_number')->toArray()) : '-'}}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan=2 align="center">No records</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@stop
