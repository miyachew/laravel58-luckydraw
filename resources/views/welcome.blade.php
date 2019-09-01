@extends('layout.root' )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@php
 $noFrame   = true;
@endphp

@section('content')
    <div class="wrapper">
        <div class="col-md-12">
            <h1>Welcome! Here's the list of lucky draw winners</h1>
            <table width="100%" border="1" cellpadding=10 cellspacing=10>
                <tr>
                    <th width="20%">Prize Type</th>
                    <th width="20%">Winner</th>
                    <th>Winning Number</th>
                </tr>
                @if(count($winners) > 0)
                    @foreach($winners as $winner)
                        <tr>
                        <td>{{ __('app.prize_type.'.$winner->prize_type) }}</td>
                        <td>{{ $winner->winnerMember->name ?? '-'}}</td>
                        <td>{{ $winner->winning_number ?? 'generated winner'}}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan=3 align="center">No records</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@stop
