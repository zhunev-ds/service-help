@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Панель состояния
                    </div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{--Clock begin--}}
                        <div class="row">
                            <div class="col-lg-6 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Выполненные работы</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="flex: 1 1 auto; overflow-y: auto; height: 485px;">
                                        @foreach($tasks as $task)
                                            <div class="callout callout-success">
                                                <h5>{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$task->due_date)->format('Y-m-d') }} {{$task->name}}</h5>
                                                <p>{{$task->description}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Результаты сбора данных об актуальном составе АИИС</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="flex: 1 1 auto; overflow-y: auto; height: 110px;">
                                        <div class="info-box" style="display:block !important;">
                                            @if ($dataCollectionResultsStatus == true)
                                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-number">Все изменения учтённы в метрологии</span>
                                                </div>
                                            @endif
                                            @if ($dataCollectionResultsStatus == false)
                                                @foreach($dataCollectionResults as $dataCollectionResult)
                                                    @if ($dataCollectionResult->considered_metrological == "false")
                                                        <div class="row">
                                                            <div class="callout callout-danger col-md-12">
                                                                <h5>{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$dataCollectionResult->date)->format('Y-m-d')}} {{$dataCollectionResult->change_character}}</h5>
                                                                <p>Не учтено в метрологических документах</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-2">
                                <div class="card card-info">
                                    <div class="card-header">
                                        {{ trans('cruds.tasksCalendar.title') }}
                                    </div>

                                    <div class="card-body">
                                        <link rel="stylesheet"
                                              href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css"/>
                                        <div id="calendar"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Информация о полноте сбора данных в АИИС</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom: 10px;">
                                            @foreach($aiisDatas as $aiisData)
                                                <div class="col-lg-4 col-6">
                                                    <!-- small box -->
                                                    @if ($aiisData->state == 100)
                                                        <div class="small-box bg-success">
                                                            <div class="inner">
                                                                <h3>{{$aiisData->state}}<sup style="font-size: 20px">%</sup></h3>
                                                                <p>Сбор данных в АИИС за {{$aiisData->date}}</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-stats-bars"></i>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="small-box bg-warning">
                                                            <div class="inner">
                                                                <h3>{{$aiisData->state}}<sup style="font-size: 20px">%</sup></h3>
                                                                <p>Сбор данных в АИИС за {{$aiisData->date}}</p>
                                                            </div>
                                                            <div class="icon">
                                                                <i class="ion ion-stats-bars"></i>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- ./col bg-warning -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        <div class="row">
                            <div class="col-lg-6 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-size: 18px;">Общее количество выездов в
                                            рамках проведения внеплановых и восстановительных работ на объекты
                                            АИИС.</h4>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom: 10px;">
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')}}</span>
                                                        <span class="info-box-number">{{$AllDepartureNow}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')-1}}</span>
                                                        <span class="info-box-number">{{$AllDepartureBackOne}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')-2}}</span>
                                                        <span class="info-box-number">{{$AllDepartureBackTwo}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h4 class="card-title" style="font-size: 18px;">Общее количество
                                            восстановительных работ (в том числе с использованием удалённого доступа к
                                            серверу АИИС).</h4>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom: 10px;">
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')}}</span>
                                                        <span class="info-box-number">{{$AllTasksNow}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')-1}}</span>
                                                        <span class="info-box-number">{{$AllTasksBackOne}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-4 col-sm-6 col-12">
                                                <div class="info-box">
                                                    <span class="info-box-icon"
                                                          style="background-color: #ff851b; color: white;"><i
                                                            class="far fa-flag"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">За {{date('Y')-2}}</span>
                                                        <span class="info-box-number">{{$AllTasksBackTwo}}</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--Текущее состояние АИИС--}}
                        <div class="row">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Информация о соответствии АИИС требованиям ОРЭМ</h3>
                                </div>
                                <!-- /.card-header -->
                                @foreach ($orems as $orem)
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom: 10px;">
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_p_313 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П313</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П313</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_p_314 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П314</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П314</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_p_315 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П315</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру П315</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_2 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф2</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф2</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_4 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф4</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф4</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_7 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф7</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф7</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_8 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф8</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф8</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_9 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф9</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф9</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_10 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф10</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф10</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_11 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф11</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф11</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_13 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф13</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф13</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_16 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф16</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф16</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_24 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф24</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф24</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_28 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф28</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф28</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_32 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф32</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф32</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_40 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф40</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф40</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_41 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф41</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф41</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="info-box">
                                                    @if ($orem->state_pf_42 == 'true')
                                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф42</span>
                                                            <span class="info-box-number">Соответствует</span>
                                                        </div>
                                                    @else
                                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                                                        <div class="info-box-content">
                                                    <span
                                                        class="info-box-text">АИИС требованиям по параметру Пф42</span>
                                                            <span class="info-box-number">Не соответствует</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /.info-box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Контакты</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row" style="margin-bottom: 10px; ">
                                            <h3 class="card-title">Менеджер объекта со стороны АО "РЭС Групп":</h3>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px; ">
                                            <h3 class="card-title">Крузанов Алексей Дмитриевич</h3>
                                        </div>
                                        <div class="row" style="margin-bottom: 10px; ">
                                            <h3 class="card-title">+7 (910) 036-05-97, kurzanov@orem.su</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-1">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Написать в техническую поддержку АО "РЭС Групп"</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal" action="../../app/send.php" method="post">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-3 col-form-label">Имя</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Имя Фамилия">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputMessage"
                                                       class="col-sm-3 col-form-label">Сообщение</label>
                                                <div class="col-sm-9">
                                                    {{--<input type="textarea" class="form-control" id="inputMessage" placeholder="Сообщение">--}}
                                                    <textarea class="form-control" rows="3" name="message" placeholder="Сообщение ..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info">Отправить</button>
                                            <button type="cancel" class="btn btn-default float-right">Отмена</button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    @parent
    <link href='/js/fullcalendar/fullcalendar.css' rel='stylesheet'/>
    <script src='/js/fullcalendar/fullcalendar.js'></script>
    <script src='/js/fullcalendar/locale/ru.js'></script>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            locale: 'ru'
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: [
                        @foreach($events as $event)
                        @if($event->due_date && $event->type == "pto")
                    {
                        title : '{{ $event->name }}',
                        start : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                        end : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->end_date)->modify('+1 day')->format('Y-m-d') }}',
                        url : '{{ url('admin/tasks').'/'.$event->id.'/' }}',
                        color: '#257e4a'
                    },
                        @endif
                        @if($event->due_date && $event->type == "void")
                    {
                        title : '{{ $event->name }}',
                        start : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->due_date)->format('Y-m-d') }}',
                        end : '{{ \Carbon\Carbon::createFromFormat(config('panel.date_format'),$event->end_date)->modify('+1 day')->format('Y-m-d') }}',
                        url : '{{ url('admin/tasks').'/'.$event->id.'/' }}',
                        color: '#911e1e'
                    },
                    @endif
                    @endforeach
                ]
            })
        });
    </script>
@endsection
