@extends('layouts.admin')
@section('content')
    <style>
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #3a4a65;
        }

        .nav-tabs .nav-link {
            color: #3c4b64;
        }
    </style>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.reportU.title') }}
        </div>

        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist"
                    style="overflow-x: auto; overflow-y:hidden; flex-wrap: nowrap;">
                    @foreach($reports as $report)
                        <li class="nav-item">
                            <a class="nav-link @if ($loop->first) active show @endif "
                               id="custom-content-{{$report->id}}-tab" data-toggle="pill" href="#report{{$report->id}}"
                               role="tab" aria-controls="report{{$report->id}}" @if ($loop->first) aria-selected="true"
                               @else aria-selected="false" @endif style="white-space: nowrap;">Отчёт
                                ПТО {{$report->quarter}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content" id="custom-content-above-tabContent">

                @foreach($reports as $report)
                    <div class="tab-pane fade @if ($loop->first) show active @endif " id="report{{$report->id}}"
                         role="tabpanel" aria-labelledby="custom-content-{{$report->id}}-tab">
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header"
                                     style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                                    <div><h3 class="card-title">Даты проведения ПТО: {{$report->quarter}}</h3></div>
                                    <div><h3 class="card-title">Ответственный на
                                            объекте: {{$report->responsible->surname}} {{mb_substr($report->responsible->name,0,1)}}. {{mb_substr($report->responsible->patronymic,0,1)}}.</h3></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Состав бригады АО "РЭС Групп"</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        @foreach ($report->brigades as $brigade)
                                            <li>
                                                <span>{{$brigade->surname}} {{$brigade->name}} {{$brigade->patronymic}}</span>
                                                <br>
                                                <span>{{$brigade->phone}}</span>
                                                <br>
                                                <span>{{$brigade->email}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <span>  </span>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->
                        </div>
                        <div class="col-md-12">
                            <div id="accordion">
                                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: #4b966994">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#WorkOnPTO{{$report->id}}" class="collapsed" aria-expanded="false">
                                                Перечень работ с отметкой о выполнении в рамках ПТО
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="WorkOnPTO{{$report->id}}" class="panel-collapse in collapse" style="">
                                        <div class="card-body">
                                            @foreach($mainWorks as $work)
                                                @if ($work->quarter_id == $report->id)
                                                    <div class="callout callout-success">
                                                        <h5>{{$work->comment}}</h5>
                                                        @foreach ($work->files as $media)
                                                            <a type="button" class="btn btn-block btn-success"
                                                               href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                               target="_blank">Скачать файл</a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{--/////////////////////////////////////////Визуальное обследование начало//////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: #002d6f94">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#rvoAIIS{{$report->id}}" class="collapsed" aria-expanded="false">
                                                Результаты визуального обследования оборудования АИИС
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="rvoAIIS{{$report->id}}" class="panel-collapse in collapse" style="">
                                        <div class="card-body">
                                            {{--Визуалка сервер начало--}}
                                            <div class="card card-danger">
                                                <div class="card-header" style="background-color: #15479094">
                                                    <h4 class="card-title">
                                                        <a data-toggle="collapse" data-parent="#accordion"
                                                           href="#v_server_{{$report->id}}" class="collapsed"
                                                           aria-expanded="false">
                                                            ИВК АО Газпромнефть-Ноябрьскнефтегаз
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="v_server_{{$report->id}}" class="panel-collapse in collapse"
                                                     style="">
                                                    <div class="card-body">
                                                        @foreach($visualServers as $visualServer)
                                                            @if ($visualServer->quarter_id == $report->id)
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>
                                                                            {{$visualServer->resut}}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    @foreach ($visualServer->photo as $media)
                                                                        <div class="col-md-2">
                                                                            <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                               data-toggle="lightbox"
                                                                               data-title="{{substr($media->name, 14)}}"
                                                                               data-gallery="gallery">
                                                                                <img
                                                                                    src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                    class="img-fluid mb-2"
                                                                                    alt="{{substr($media->name, 14)}}"
                                                                                    style="z-index: 9999999;">
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            {{--Визуалка сервер конец--}}
                                            {{--Визуалка локации начало--}}
                                            @foreach($locations as $location)
                                                <div class="card card-primary">
                                                    <div class="card-header" style="background-color: #15479094">
                                                        <h4 class="card-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                               href="#v_location_{{$location->id}}_{{$report->id}}"
                                                               class="collapsed"
                                                               aria-expanded="false">
                                                                {{$location->name}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="v_location_{{$location->id}}_{{$report->id}}"
                                                         class="panel-collapse in collapse" style="">
                                                        <div class="card-body">
                                                            {{--Визуалка УСПД начало--}}
                                                            <div class="card card-primary">
                                                                <div class="card-header"
                                                                     style="background-color: #326abd94">
                                                                    <h4 class="card-title">
                                                                        <a data-toggle="collapse"
                                                                           data-parent="#accordion"
                                                                           href="#v_uspd_{{$location->id}}_{{$report->id}}"
                                                                           class="collapsed"
                                                                           aria-expanded="false">
                                                                            УСПД
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="v_uspd_{{$location->id}}_{{$report->id}}"
                                                                     class="panel-collapse in collapse"
                                                                     style="">
                                                                    <div class="card-body">
                                                                        @foreach($visualUspd as $visualU)
                                                                            @if ($visualU->location_id == $location->id && $visualU->quarter_id == $report->id)
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <h5>
                                                                                            {{$visualU->result}}
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    @foreach ($visualU->photo as $media)
                                                                                        <div class="col-md-2">
                                                                                            <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                               data-toggle="lightbox"
                                                                                               data-title="{{substr($media->name, 14)}}"
                                                                                               data-gallery="gallery">
                                                                                                <img
                                                                                                    src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                                    class="img-fluid mb-2"
                                                                                                    alt="{{substr($media->name, 14)}}"
                                                                                                    style="z-index: 9999999;">
                                                                                            </a>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--Визуалка УСПД кнец--}}
                                                            {{--Визуалка точки начало--}}
                                                            @foreach($mpoints as $point)
                                                                @if ($point->location_id == $location->id)
                                                                    <div class="card card-primary">
                                                                        <div class="card-header"
                                                                             style="background-color: #326abd94">
                                                                            <h4 class="card-title">
                                                                                <a data-toggle="collapse"
                                                                                   data-parent="#accordion"
                                                                                   href="#point_{{$point->id}}_{{$report->id}}"
                                                                                   class="collapsed"
                                                                                   aria-expanded="false">
                                                                                    {{$point->name}}
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="point_{{$point->id}}_{{$report->id}}"
                                                                             class="panel-collapse in collapse"
                                                                             style="">
                                                                            <div class="card-body">
                                                                                @foreach($visualInspections as $visual)
                                                                                    @if ($visual->point_id == $point->id && $visual->quarter_id == $report->id)
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <h5>
                                                                                                    {{$visual->result}}
                                                                                                </h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            @foreach ($visual->photo as $media)
                                                                                                <div class="col-md-2">
                                                                                                    <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                                       data-toggle="lightbox"
                                                                                                       data-title="{{substr($media->name, 14)}}"
                                                                                                       data-gallery="gallery">
                                                                                                        <img
                                                                                                            src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                                            class="img-fluid mb-2"
                                                                                                            alt="{{substr($media->name, 14)}}"
                                                                                                            style="z-index: 9999999;">
                                                                                                    </a>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            {{--Визуалка точки кнец--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{--Визуалка локации конец--}}
                                        </div>
                                    </div>
                                </div>
                                {{--/////////////////////////////////////////Визуальное обследование конец//////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
                                {{--/////////////////////////////////////////Результаты мониторинга состояния АИИС начало//////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: #12598294">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#rmAIIS{{$report->id}}" class="collapsed" aria-expanded="false">
                                                Результаты мониторинга состояния АИИС
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="rmAIIS{{$report->id}}" class="panel-collapse in collapse" style="">
                                        <div class="card-body">
                                            {{--мониторинг сервер начало--}}
                                            <div class="card card-danger">
                                                <div class="card-header" style="background-color: #32749a94">
                                                    <h4 class="card-title">
                                                        <a data-toggle="collapse" data-parent="#accordion"
                                                           href="#m_server_{{$report->id}}" class="collapsed"
                                                           aria-expanded="false">
                                                            ИВК АО Газпромнефть-Ноябрьскнефтегаз
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="m_server_{{$report->id}}" class="panel-collapse in collapse"
                                                     style="">
                                                    <div class="card-body">
                                                        @foreach($serverAnalysis as $anServer)
                                                            @if ($anServer->quarter_id == $report->id)
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5>
                                                                            {{$anServer->result}}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    @foreach ($anServer->files as $media)
                                                                        @if(preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                            <div class="col-md-2">
                                                                                <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                   data-toggle="lightbox"
                                                                                   data-title="{{substr($media->name, 14)}}"
                                                                                   data-gallery="gallery">
                                                                                    <img
                                                                                        src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                        class="img-fluid mb-2"
                                                                                        alt="{{substr($media->name, 14)}}"
                                                                                        style="z-index: 9999999;">
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @foreach($serverAnalysis as $anServer)
                                                            @if ($anServer->quarter_id == $report->id)
                                                                <div class="row">
                                                                    @foreach ($anServer->files as $media)
                                                                        @if(!preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                            <div
                                                                                class="callout callout-success col-sm-12">
                                                                                <h5>{{substr($media->name, 14)}}</h5>
                                                                                <a type="button"
                                                                                   class="btn btn-block btn-success"
                                                                                   href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                   target="_blank">Скачать файл</a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            {{--мониторинг сервер конец--}}
                                            {{--мониторинг локации начало--}}
                                            @foreach($locations as $location)
                                                <div class="card card-primary">
                                                    <div class="card-header" style="background-color: #32749a94">
                                                        <h4 class="card-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                               href="#m_location_{{$location->id}}_{{$report->id}}"
                                                               class="collapsed"
                                                               aria-expanded="false">
                                                                {{$location->name}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="m_location_{{$location->id}}_{{$report->id}}"
                                                         class="panel-collapse in collapse" style="">
                                                        <div class="card-body">
                                                            {{--мониторинг УСПД начало--}}
                                                            <div class="card card-primary">
                                                                <div class="card-header"
                                                                     style="background-color: #4b7b9694">
                                                                    <h4 class="card-title">
                                                                        <a data-toggle="collapse"
                                                                           data-parent="#accordion"
                                                                           href="#m_uspd_{{$location->id}}_{{$report->id}}"
                                                                           class="collapsed"
                                                                           aria-expanded="false">
                                                                            УСПД
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="m_uspd_{{$location->id}}_{{$report->id}}"
                                                                     class="panel-collapse in collapse"
                                                                     style="">
                                                                    <div class="card-body">
                                                                        @foreach($uspdAnalysis as $anUspd)
                                                                            @if ($anUspd->location_id == $location->id && $anUspd->quarter_id == $report->id)
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <h5>
                                                                                            {{$anUspd->result}}
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    @foreach ($anUspd->files as $media)
                                                                                        @if(preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                                            <div class="col-md-2">
                                                                                                <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                                   data-toggle="lightbox"
                                                                                                   data-title="{{substr($media->name, 14)}}"
                                                                                                   data-gallery="gallery">
                                                                                                    <img
                                                                                                        src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                                        class="img-fluid mb-2"
                                                                                                        alt="{{substr($media->name, 14)}}"
                                                                                                        style="z-index: 9999999;">
                                                                                                </a>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach($uspdAnalysis as $anUspd)
                                                                            @if ($anUspd->location_id == $location->id && $anUspd->quarter_id == $report->id)
                                                                                <div class="row">
                                                                                    @foreach ($anUspd->files as $media)
                                                                                        @if(!preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                                            <div
                                                                                                class="callout callout-success col-sm-12">
                                                                                                <h5>{{substr($media->name, 14)}}</h5>
                                                                                                <a type="button"
                                                                                                   class="btn btn-block btn-success"
                                                                                                   href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                                   target="_blank">Скачать
                                                                                                    файл</a>
                                                                                            </div>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--мониторинг УСПД кнец--}}
                                                            {{--мониторинг точки начало--}}
                                                            @foreach($mpoints as $point)
                                                                @if ($point->location_id == $location->id)
                                                                    <div class="card card-primary">
                                                                        <div class="card-header"
                                                                             style="background-color: #4b7b9694">
                                                                            <h4 class="card-title">
                                                                                <a data-toggle="collapse"
                                                                                   data-parent="#accordion"
                                                                                   href="#m_point_{{$point->id}}_{{$report->id}}"
                                                                                   class="collapsed"
                                                                                   aria-expanded="false">
                                                                                    {{$point->name}}
                                                                                </a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="m_point_{{$point->id}}_{{$report->id}}"
                                                                             class="panel-collapse in collapse"
                                                                             style="">
                                                                            <div class="card-body">
                                                                                @foreach($aiisAnalysis as $anAiis)
                                                                                    @if ($anAiis->point_id == $point->id && $anAiis->quarter_id == $report->id)
                                                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                                <h5>
                                                                                                    {{$anAiis->result}}
                                                                                                </h5>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            @foreach ($anAiis->files as $media)
                                                                                                @if(preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                                                    <div
                                                                                                        class="col-md-2">
                                                                                                        <a href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                                           data-toggle="lightbox"
                                                                                                           data-title="{{substr($media->name, 14)}}"
                                                                                                           data-gallery="gallery">
                                                                                                            <img
                                                                                                                src="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl('preview'), 1)))}}"
                                                                                                                class="img-fluid mb-2"
                                                                                                                alt="{{substr($media->name, 14)}}"
                                                                                                                style="z-index: 9999999;">
                                                                                                        </a>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                                @foreach($aiisAnalysis as $anAiis)
                                                                                    @if ($anAiis->point_id == $point->id && $anAiis->quarter_id == $report->id)
                                                                                        <div class="row">
                                                                                            @foreach ($anAiis->files as $media)
                                                                                                @if(!preg_match('/\.(jpg|png|jpeg|bmp|tiff)$/', urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))))
                                                                                                    <div
                                                                                                        class="callout callout-success col-sm-12">
                                                                                                        <h5>{{substr($media->name, 14)}}</h5>
                                                                                                        <a type="button"
                                                                                                           class="btn btn-block btn-success"
                                                                                                           href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                                                                           target="_blank">Скачать
                                                                                                            файл</a>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                            {{--мониторинг точки кнец--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{--мониторинг локации конец--}}
                                        </div>
                                    </div>
                                </div>
                                {{--/////////////////////////////////////////Результаты мониторинга состояния АИИС конец//////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: #4b549694">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#rmrsAIIS{{$report->id}}" class="collapsed" aria-expanded="false">
                                                Анализ работы АИИС КУЭ
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="rmrsAIIS{{$report->id}}" class="panel-collapse in collapse" style="">
                                        <div class="card-body">
                                            @foreach($aiisKUEAnalysis as $aiisKUE)
                                                @if ($aiisKUE->quarter_id == $report->id)
                                                    <div class="callout callout-success">
                                                        <h5>Диагностическая карта за {{$report->quarter}}</h5>
                                                        @foreach ($aiisKUE->diagnostic as $media)
                                                            <a type="button" class="btn btn-block btn-success"
                                                               href="../{{urldecode(iconv('UTF-8','CP1251',substr($media->getUrl(), 1)))}}"
                                                               target="_blank">Скачать файл</a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header" style="background-color: #6f964b94">
                                        <h4 class="card-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                               href="#rPTO{{$report->id}}"
                                               class="collapsed" aria-expanded="false">
                                                Рекомендации по результатам проведения ПТО
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="rPTO{{$report->id}}" class="panel-collapse in collapse" style="">
                                        <div class="card-body">
                                            <p>
                                                {{$report->recommendations}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    @parent
    <link href='/js/ekko/ekko-lightbox.css' rel='stylesheet'/>
    <script src='/js/ekko/ekko-lightbox.js'></script>
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    {{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>--}}

    <!-- for documentation only -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/anchor-js/3.2.1/anchor.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ($) {
            // delegate calls to data-toggle="lightbox"
            $(document).on('click', '[data-toggle="lightbox"]:not([data-gallery="navigateTo"]):not([data-gallery="gallery"])', function (event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function () {
                        if (window.console) {
                            return console.log('Checking our the events huh?');
                        }
                    },
                    onNavigate: function (direction, itemIndex) {
                        if (window.console) {
                            return console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
                        }
                    }
                });
            });

            // disable wrapping
            $(document).on('click', '[data-toggle="lightbox"][data-gallery="gallery"]', function (event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    wrapping: false
                });
            });

            //Programmatically call
            $('#open-image').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            // $('#open-youtube').click(function (e) {
            //     e.preventDefault();
            //     $(this).ekkoLightbox();
            // });

            // navigateTo
            $(document).on('click', '[data-toggle="lightbox"][data-gallery="navigateTo"]', function (event) {
                event.preventDefault();

                return $(this).ekkoLightbox({
                    onShown: function () {

                        this.modal().on('click', '.modal-footer a', function (e) {

                            e.preventDefault();
                            this.navigateTo(2);

                        }.bind(this));

                    }
                });
            });
        });
    </script>
    <style>
        .ekko-lightbox.modal.fade.in.show {
            z-index: 9999999;
        }

        .ekko-lightbox.modal.fade.in img {
            object-fit: contain;
        }
    </style>


@endsection
