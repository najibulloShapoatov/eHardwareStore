@if(count($data) > 0)
    @foreach($data as $item)
        <tr id="row_{{ $item->id }}">
            <td>{{ $item->title }}</td>
            <td>{{ $item->sort_order }}</td>
            <td class="text-center" width="170">
                <a href="javascript:void(0);" class="editableIcons showAttrValues" data-id="{{ $item->id }}" title="Свойства"><i class="fa fa-bars"></i></a>
                <a href="javascript:void(0);" class="editableIcons editAttr" data-id="{{ $item->id }}" title="Редактировать"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" class="editableIcons deleteAttr" data-id="{{ $item->id }}" title="Удалить"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
@else
    <tr id="no_props">
        <td colspan="3">Нет свойств</td>
    </tr>
@endif