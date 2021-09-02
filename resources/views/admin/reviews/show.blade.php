@extends('layouts.admin')

@section('content')
    <h4 class="pull-left">Отзыв: {{Carbon\Carbon::parse($review->date_publish)->format('d.m.Y')}}</h4>
    <div class="clearfix m-b-20"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive azimiAdminTable">
                <table class="table table-bordered table-hover m-0">
                    <tr>
                        <td><strong>Дата</strong></td>
                        <td>{{Carbon\Carbon::parse($review->date_publish)->format('d.m.Y')}}</td>
                    </tr>
                    <tr>
                        <td><strong>Клиент</strong></td>
                        <td>{{ (!empty($review->user->name)) ? $review->user->name : '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Товар</strong></td>
                        <td>{!! (!empty($review->product->title)) ? $review->product->title . ' (артикул: # <a href="/admin/products/edit/' . $review->product->id . '">' . $review->product->articul . '</a>)' : '' !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Отзыв</strong></td>
                        <td>{!! $review->description !!}</td>
                    </tr>
                    <tr>
                        <td><strong>Оценка</strong></td>
                        <td>
                            <div class="reviewList">
                                @for($i=1; $i<=5; $i++)
                                    @if((int)$review->point >= $i)
                                        <span><i class="fa fa-star rYellow"></i></span>
                                    @else
                                        <span><i class="fa fa-star"></i></span>
                                    @endif
                                @endfor
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="showSubi">
                <a href="{{URL::to('admin/reviews/')}}" class="btn btn-primary btn-bordered"><i class="fa fa-list"></i> Отзывы</a>
                <a href="{{ url('/admin/reviews/delete/' . $review->id) }}" onclick="return confirm('Вы уверены?');" class="btn btn-primary btn-bordered" title="Удалить"><i class="fa fa-trash"></i> Удалить этот отзыв</a>
            </div>
        </div>
    </div>
@endsection
