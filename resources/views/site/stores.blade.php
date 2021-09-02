@extends('layouts.site')
@section('title', 'Наши магазины')
@section('description', 'Наши магазины')

@section('content')

    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Главная</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/public/site_assets/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Наши магазины</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Наши магазины</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="card mb-0 contact-us">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="card mb-0 contact-us">
                <div class="card-body">
                    <div class="contact-us__container">
                        <div class="row">
                            <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                                <h4 class="contact-us__header card-title">Наши адреса</h4>
                                <div class="contact-us__address">
                                    <p>
                                        <strong>84 мкр. ул. Гафурова 33/3, (за зданием "Милано Мода")</strong>
                                        <br>Телефон: 235-35-45, (+992) 779-996-006
                                        <br>с 8:30 до 18:00
                                    </p>
                                    <p>
                                        <strong>ТЦ «Осиё» магазин 49</strong>
                                        <br>Телефон: (+992) 779-996-021
                                        <br>с 8:00 до 16:00
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <h4 class="contact-us__header card-title">Обратная связь</h4>
                                <div id="feedback-result"></div>
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="form-name">Ваше имя</label>
                                            <input type="text" id="feedback-name" class="form-control" autocomplete="off" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="form-email">Эл. почта</label>
                                            <input type="email" id="feedback-email" class="form-control" autocomplete="off" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="form-message">Сообщение</label>
                                        <textarea id="feedback-message" class="form-control" rows="4"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="feedback-submit">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=AD--mFwBAAAAI_q-PAMAjTv0H1rSXscjO0_2-v58P2T_nX8AAAAAAAAAAACN2z6sK__9zdoWbsn4jjmoSizEhg==" type="text/javascript"></script>
    <script type="text/javascript">
        // Пример реализации боковой панели на основе наследования от collection.Item.
        // Боковая панель отображает информацию, которую мы ей передали.
        ymaps.modules.define('Panel', [
            'util.augment',
            'collection.Item'
        ], function (provide, augment, item) {
            // Создаем собственный класс.
            var Panel = function (options) {
                Panel.superclass.constructor.call(this, options);
            };

            // И наследуем его от collection.Item.
            augment(Panel, item, {
                onAddToMap: function (map) {
                    Panel.superclass.onAddToMap.call(this, map);
                    this.getParent().getChildElement(this).then(this._onGetChildElement, this);
                    // Добавим отступы на карту.
                    // Отступы могут учитываться при установке текущей видимой области карты,
                    // чтобы добиться наилучшего отображения данных на карте.
                    map.margin.addArea({
                        top: 0,
                        left: 0,
                        width: '250px',
                        height: '100%'
                    })
                },

                onRemoveFromMap: function (oldMap) {
                    if (this._$control) {
                        this._$control.remove();
                    }
                    Panel.superclass.onRemoveFromMap.call(this, oldMap);
                },

                _onGetChildElement: function (parentDomContainer) {
                    // Создаем HTML-элемент с текстом.
                    // По-умолчанию HTML-элемент скрыт.
                    this._$control = $('<div class="customControl"><div class="content"></div><div class="closeButton"></div></div>').appendTo(parentDomContainer);
                    this._$content = $('.content');
                    // При клике по крестику будем скрывать панель.
                    $('.closeButton').on('click', this._onClose);
                },
                _onClose: function () {
                    $('.customControl').css('display', 'none');
                },
                // Метод задания контента панели.
                setContent: function (text) {
                    // При задании контента будем показывать панель.
                    this._$control.css('display', 'flex');
                    this._$content.html(text);
                }
            });

            provide(Panel);
        });

        // ya map
        ymaps.ready(['Panel']).then(function () {
            var map = new ymaps.Map("map", {
                center: [38.569300, 68.777100],
                zoom: 12,
                controls: ['zoomControl']
            });

            // Создадим и добавим панель на карту.
            var panel = new ymaps.Panel();
            map.controls.add(panel, {
                float: 'left'
            });

            // Создадим коллекцию геообъектов.
            var collection = new ymaps.GeoObjectCollection(null, {
                // Запретим появление балуна.
                hasBalloon: false,
                iconColor: '#3b5998'
            });

            // Добавим геообъекты в коллекцию.
            collection
                .add(new ymaps.Placemark([38.567547892258,68.787897970902], {
                    balloonContent: "<strong>Адрес: </strong>ТЦ «Осиё» магазин 49 <br><strong>Телефон: </strong>(+992) 779-996-021<br><strong>с 8:00 до 16:00: </strong>"
                }, {
                    //preset: 'islands#greenDotIconWithCaption',
                    //iconColor: '#46b432'
                    iconLayout: 'default#image',
                    iconImageHref: '/public/site_assets/images/shop-marker.png',
                    iconImageSize: [45, 60],
                    iconImageOffset: [-5, -38]
                }))
                .add(new ymaps.Placemark([38.575459419303,68.742642065905], {
                    balloonContent: "<strong>Адрес: </strong>84 мкр. ул. Гафурова 33/3, (за зданием &quot;Милано Мода&quot;)<br><strong>Телефон: </strong>235-35-45, (+992) 779-996-006<br><strong>с 8:30 до 18:00: </strong>"
                }, {
                    //preset: 'islands#greenDotIconWithCaption',
                    //iconColor: '#46b432'
                    iconLayout: 'default#image',
                    iconImageHref: '/public/site_assets/images/shop-marker.png',
                    iconImageSize: [45, 60],
                    iconImageOffset: [-5, -38]
                }))
            ;

            // Добавим коллекцию на карту.
            map.geoObjects.add(collection);

            // Подпишемся на событие клика по коллекции.
            collection.events.add('click', function (e) {
                // Получим ссылку на геообъект, по которому кликнул пользователь.
                var target = e.get('target');
                // Зададим контент боковой панели.
                panel.setContent(target.properties.get('balloonContent'));
                // Переместим центр карты по координатам метки с учётом заданных отступов.
                map.panTo(target.geometry.getCoordinates(), {useMapMargin: true});
            });
        });
    </script>
@endsection
