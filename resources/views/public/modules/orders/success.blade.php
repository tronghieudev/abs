@extends('public.main')

@section('content')
	<div class="container" style="margin-top: 20px;
    text-align: center;">
		Chúc mừng quý khách đã hoàn tất mua hàng. Chúng tôi sẽ kiểm tra và liên hệ với quý khác trong 24h tới..
		<p>Để tiếp tục mua hàng quý vui lòng click {!! HTML::link(route('public.getIndex'), 'tại đây') !!}</p>
	</div>
@stop