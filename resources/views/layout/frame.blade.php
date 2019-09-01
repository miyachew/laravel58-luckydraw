<div class="wrapper">
@include('layout.header')

<div class="container-fluid">
      <div class="row flex-xl-nowrap">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
            <ul>
            <li><a href="{!! route('overview') !!}">Overview</a></li>
            <li><a href="{!! route('lucky-draw-winner-index') !!}">Lucky Draw Winners</a></li>
            </ul>
        </div>
        <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 bd-content" role="main">
            <section class="content">
                @if(Session::has('message_success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Success!</h4>
                        {{ Session::get('message_success') }}
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Failed!</h4>
                        <ul>
                            @if(is_array($errors))
                                @foreach ($errors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @else
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
        </main>
    </div>

    @include('layout.footer')
</div>
