@extends('layouts.admin')

@section('content')

<h4>Отзывы</h4>
<div class="clearfix m-b-20"></div>
@include('includes.alert')
<div class="row">
    <div class="col-sm-12">
        @if(count($reviews) > 0)
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Клиент</th>
                        <th>Товар</th>
                        <th>Отзыв</th>
                        <th>Оценка</th>
                        <th class="text-center">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $item)
                        <tr>
                            <td>{{Carbon\Carbon::parse($item->date_publish)->format('d.m.Y')}}</td>
                            <td>{{ (!empty($item->user->name)) ? $item->user->name : '' }}</td>
                            <td>{!! (!empty($item->product->title)) ? $item->product->title . ' (артикул: # <a href="/admin/products/edit/' . $item->product->id . '">' . $item->product->articul . '</a>)' : '' !!}</td>
                            <td>{!! $item->description !!}</td>
                            <td width="100">
                                <div class="reviewList">
                                    @for($i=1; $i<=5; $i++)
                                        @if((int)$item->point >= $i)
                                            <span><i class="fa fa-star rYellow"></i></span>
                                        @else
                                            <span><i class="fa fa-star"></i></span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/admin/reviews/show/' . $item->id) }}" class="editableIcons" title="Просмотр"><i class="fa fa-search"></i></a>
                                <a href="{{ url('/admin/reviews/delete/' . $item->id) }}" onclick="return confirm('Вы уверены?');" class="editableIcons" title="Удалить"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $reviews->render() !!}
                <div class="clearfix m-b-20"></div>
            </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
@endsection
