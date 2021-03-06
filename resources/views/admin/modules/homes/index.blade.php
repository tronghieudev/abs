@extends('admin.main')

@section('content')
	<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
              @if(count($orders))
                {!! $orders[0]->count !!}
              @else
                0
              @endif
              </h3>
              <p>New Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            {!! HTML::decode(HTML::link(route('admin.orders.getIndex'), 'More info <i class="fa fa-arrow-circle-right"></i>', ['class' => 'small-box-footer'])) !!}
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{!! $users !!}</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
      	<div class="small-box bg-red">
            <div class="inner">
				<h3>
          @if(count($orders))
                {!! $orders[1]->count !!}
              @else
                0
              @endif
        </h3>
				<p>Unique Visitors</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          	</div>
        </div><!-- ./col -->
    </div>
@stop