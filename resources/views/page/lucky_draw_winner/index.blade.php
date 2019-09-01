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
            <h1>Lucky Draw Winners</h1>
            <a class="btn btn-primary" href="{!! route('lucky-draw-winner-create') !!}">Create Lucky Draw Winners</a><br><br>
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
