@if(!empty($parameters))
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <th width="10%">STT</th>
                <th width="30%">Thông số</th>
                <th>Giá trị</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $key => $value)
                <tr>
                    <th scope="row">{!! $key + 1 !!}</th>
                    <td>{!! $value->name_parameter !!}</td>
                    <td>
                        {!! Form::input('text', 'parameter['.$value->id.']', null, ['class' => 'form-control']) !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if(!empty($sizes))
    <div class="form-group list-size">
        <label for="size">Kích thước (size)</label>
        <div id="firstSize">
            <div class="item">
                {!! Form::select('size[]', $sizes, null, ['class' => 'form-control size']) !!}
                <p></p>
            </div>
        </div>
    </div>

    <p onclick="addSize()" style="text-decoration: underline;color: #3c8dbc; cursor: pointer;">Thêm kích thước (size)</p>

@endif