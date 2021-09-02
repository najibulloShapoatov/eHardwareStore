<tr id="row_{{ $data->id }}">
    <td>{{ $data->title }}</td>
    <td>{{ $data->sort_order }}</td>
    <td class="text-center" width="170">
        <a href="javascript:void(0);" class="editableIcons showAttrValues" data-id="{{ $data->id }}" title="Свойства"><i class="fa fa-bars"></i></a>
        <a href="javascript:void(0);" class="editableIcons editAttr" data-id="{{ $data->id }}" title="Редактировать"><i class="fa fa-pencil"></i></a>
        <a href="javascript:void(0);" class="editableIcons deleteAttr" data-id="{{ $data->id }}" title="Удалить"><i class="fa fa-trash"></i></a>
    </td>
</tr>