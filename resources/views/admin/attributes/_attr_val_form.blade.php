<input type="hidden" id="attrID" value="{{ $data->id }}">
<div class="row">
    <div class="col-md-8">
        <div class="table-responsive azimiTable attrValForm">
            <table class="table table-hover m-0 ">
                <thead>
                <tr>
                    <th>Значение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->attrVals as $item)
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="attrVal[]" value="{{ $item->attribute_value }}">
                        </td>
                    </tr>
                @endforeach

                @for ($i = 1; $i <= 7; $i++)
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="attrVal[]" value="">
                        </td>
                    </tr>
                @endfor

                </tbody>
            </table>
            <div class="clearfix m-b-20"></div>
        </div>
    </div>
    <div class="col-md-4">
        <br>
        <br>
        <small>Для удаления записи, оставьте поле пустым</small>
    </div>
</div>