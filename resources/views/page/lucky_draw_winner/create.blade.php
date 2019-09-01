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
            <h1>Lucky Draw</h1><br><hr><br>
            <form action="{!! route('lucky-draw-winner-store') !!}" method="post" accept-charset="UTF-8">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="prize-type" class="col-sm-12 control-label">Prize Type<span>*</span></label>
                    <div class="col-sm-12">
                        <select name="prize_type" class="form-control"id="prize-type" required>
                            <option value="">Please select</option>
                            @if(count($prizeTypes)> 0)
                                @foreach($prizeTypes as $prizeType)
                                    <option value="{{$prizeType}}" @if(old('prize_type')==$prizeType) selected="selected" @endif>
                                        {{ __('app.prize_type.'.$prizeType) }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div><small>Winner will be replaced if already exists.</small></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="generate-randomly" class="col-sm-12 control-label">Generate Randomly<span>*</span></label>
                    <div class="col-sm-12">
                        <select name="generate_randomly" class="form-control"id="generate-randomly" required>
                            <option value="">Please select</option>
                            <option value="1" @if(old('generate_randomly')==1) selected="selected" @endif>Yes</option>
                            <option value="0" @if(old('generate_randomly')==0) selected="selected" @endif>No</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="winning-number" class="col-sm-12 control-label">Winning Number</label>
                    <div class="col-sm-12">
                        <input name="winning_number" class="form-control"id="winning-number" placeholder="Required if you choose No in generate randomly">
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
