@extends('admin.main')

@section('extra-lib')
	{!! HTML::script('public/backend/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('public/backend/plugins/datatables/dataTables.bootstrap.min.js') !!}
    <script type="text/javascript">
    	// $(function () {
     //        $("#example1").DataTable({
     //            "language": {
     //                "lengthMenu": "Hiển thị _MENU_ kết quả trên một trang",
     //                "zeroRecords": "<div class='text-danger text-center'>Không có dữ liệu</div>",
     //                "info": "Hiển thị trang số : _PAGE_  - Trong số : _PAGES_ trang",
     //                "infoEmpty": "Không có dữ liệu",
     //                "infoFiltered": "(filtered from _MAX_ total records)"
     //            }
     //        });
     //        //$('[data-toggle="tooltip"]').tooltip();
     //    });
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.category').prepend('<option value="0">-- Phân cấp cha --</option>');
        });
        function getFormInfo(id) {
            if(typeof(id) == 'undefined') {
                id = '';
            }
           // console.log(id);
            $.ajax({
                url: '{!! route("admin.colors.getForm") !!}?id='+id,
                type: 'GET',
            })
            .done(function(output) {
                if(typeof(output.data) == 'undefined'){
                    if ($('input[name=id]').length) {
                        $('input[name=id]').remove();
                    }
                   
                    $('#color').val('');
                    $('.description').html(output.description).css('color', 'green');
                } else {
                    if ($('input[name=id]').length) {
                        $('input[name=id]').val(output.data.id);
                    } else {
                        $('#header-postForm').append('<input type="hidden" name="id" value="' + output.data.id + '" id="id" >');
                    }
                  
                    $('.description').html(output.description).css('color', 'rgb(255, 179, 0)');
                    $('#color').val(output.data.color);
                }
            })          
        }

        function postDelete(id){
        // console.log(id);
            $('#confirm').modal().one('click', '#delete', function(e){
                $.ajax({
                    url: '{!! route("admin.colors.getDel") !!}',
                    type: 'GET',
                    data: {id : id},
                    success: function(output){
                    console.log(output);
                        $('.messages').html(output.description);
                        $('#getMessages').modal('toggle');
                        $('#tr_'+id).remove();
                    }
                });
            });
        }
    </script>

    <script type="text/javascript">
    	$('.check').on('click', function(e) {
    		e.preventDefault();
    		var id = $(this).data('order');
    		var status = $(this).data('status');
    		var token = '{!! csrf_token() !!}';
    		var item = $(this);
    		$.ajax({
    			url: '{!! route('admin.orders.postCheck') !!}',
    			type: 'POST',
    			data: {id: id, status : status, _token : token},
    		})
    		.done(function(output) {
    			if(output.code == 200) {
    				//console.log($(this).children('.fa'));
    				item.children('.fa').removeClass('fa-close').addClass('fa-check');
    			}
    		});
    		
    	});

    	$('.show-detail').on('click', function() {
    		var id = $(this).data('order');
    		$.ajax({
    			url: '{!! route('admin.orders.getDetail') !!}',
    			type: 'GET',
    			data: {id: id},
    		})
    		.done(function(output) {
    			//console.log(output);
                $('#myModal .modal-body').html(output);
                $('#myModal').modal();
    		})
    		//$('#myModal').modal();
    	})
    </script>

@stop

@section('extra-style')
	{!! HTML::style('public/backend/plugins/datatables/dataTables.bootstrap.css') !!}
	<style type="text/css">
	.fa-check{
		color : green;
	}
	.fa-close{
		color : red;
	}
	</style>
@stop

@section('content')
	<div class="box box-primary">
        <div class="box-header with-border">
			<h3 class="box-title">Quản lý danh mục</h3>
			<span class="pull-right">{!! HTML::link('#', 'Thêm mới', ['onClick' => 'getFormInfo()', 'class' => 'btn btn-block btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#getForm']) !!}</span>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
                <thead>
                  	<tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Chi tiết đơn hàng</th>
                        <th>Đặt hàng</th>
                        <th>Liên hệ</th>
                        <th>Thanh toán</th>
                        <th>Giao hàng</th>
                        <th>Hủy Order</th>
                  	</tr>
                </thead>
                <tbody>
                	@if(!empty($orders))
                		@foreach($orders as $order)
                			<tr>
	                			<td>
	                				{!! $order->id !!}
	                			</td>
	                			<td>
	                				@if(!empty($order->user_id))
	                					{!! $order->users->name !!}
	                				@else
	                					{!! $order->customers->name !!}
	                				@endif
	                			</td>
	                			<td>
	                				<p style="text-align: center; text-decoration: underline; cursor: pointer;" class="show-detail" data-order ="{!! $order->id !!}">Xem chi tiêt </p>
	                			</td>
	                			@if($order->status > 0)
		                			@for($i = 1; $i < 5; $i++)
		                				<td>
			                				@if($order->status >= $i)
			                					{!! HTML::decode(HTML::link('#', '<i class="fa fa-fw fa-check"></i>', ['data-status' => $i])) !!}
			                				@else
			                					{!! HTML::decode(HTML::link('#', '<i class="fa fa-fw fa-close"></i>', ['data-status' => $i, 'data-order' => $order->id,'class' => 'check'])) !!}
			                				@endif
		                				</td>
		                			@endfor
		                			<td>
		                				{!! HTML::decode(HTML::link('#', '<i class="fa fa-fw fa-close"></i>', ['data-status' => 0, 'data-order' => $order->id,'class' => 'check'])) !!}
		                			</td>
	                			@else
	                				<td></td>
	                				<td></td>
	                				<td></td>
	                				<td></td>
	                				<td>
	                					Đã hủy đơn hàng
	                				</td>
                					
                				@endif
	                		</tr>
                		@endforeach
                	@endif
                </tbody>
                <tfoot>
                  	<th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Chi tiết đơn hàng</th>
                        <th>Đặt hàng</th>
                        <th>Liên hệ</th>
                        <th>Thanh toán</th>
                        <th>Giao hàng</th>
                        <th>Hủy Order</th>
                </tfoot>
            </table>
        </div>
	</div>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Modal Header</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
@stop