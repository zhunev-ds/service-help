<?php

return [
    'userManagement'            => [
        'title'          => 'Управление пользователями',
        'title_singular' => 'Управление пользователями',
    ],
    'permission'                => [
        'title'          => 'Разрешения',
        'title_singular' => 'Разрешение',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Доступ',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'                      => [
        'title'          => 'Роли',
        'title_singular' => 'Роль',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Роль',
            'title_helper'       => '',
            'permissions'        => 'Описание',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'                      => [
        'title'          => 'Пользователи',
        'title_singular' => 'Пользователь',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Имя',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email подтверждён',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Роль',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'surname'                  => 'Фамилия',
            'surname_helper'           => '',
            'patronymic'               => 'Отчество',
            'patronymic_helper'        => '',
            'photo'                    => 'Фотография',
            'photo_helper'             => '',
            'position'                 => 'Должность',
            'position_helper'          => '',
            'company'                  => 'Компания',
            'company_helper'           => '',
            'phone'                    => 'Телефон',
            'phone_helper'             => '',
        ],
    ],
    'taskManagement'            => [
        'title'          => 'Журнал ВОиАР',
        'title_singular' => 'Журнал ВОиАР',
    ],
    'taskStatus'                => [
        'title'          => 'Статусы',
        'title_singular' => 'Статусы',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Название',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'taskTag'                   => [
        'title'          => 'Типы работ',
        'title_singular' => 'Типы работ',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Тип',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'task'                      => [
        'title'          => 'События',
        'title_singular' => 'События',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Название',
            'name_helper'        => '',
            'description'        => 'Описание',
            'description_helper' => '',
            'status'             => 'Статус',
            'status_helper'      => '',
            'tag'                => 'Тип выполнения работ',
            'tag_helper'         => '',
            'attachment'         => 'Документы',
            'attachment_helper'  => '',
            'due_date'           => 'Дата выезда',
            'due_date_helper'    => '',
            'assigned_to'        => 'Сотрудник',
            'assigned_to_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => '',
            'end_date'           => 'Дата окончания выезда',
            'end_date_helper'    => '',
            'type'               => 'Тип события',
            'type_helper'        => '',
        ],
    ],
    'tasksCalendar'             => [
        'title'          => 'График работ ТО АИИС',
        'title_singular' => 'График работ ТО АИИС',
    ],
    'contentManagement'         => [
        'title'          => 'Управление контентом',
        'title_singular' => 'Управление контентом',
    ],
    'contentCategory'           => [
        'title'          => 'Категории',
        'title_singular' => 'Категории',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Название',
            'name_helper'       => '',
            'slug'              => 'Slug',
            'slug_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'contentTag'                => [
        'title'          => 'Теги',
        'title_singular' => 'Теги',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Название',
            'name_helper'       => '',
            'slug'              => 'Slug',
            'slug_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => '',
        ],
    ],
    'contentPage'               => [
        'title'          => 'Страницы',
        'title_singular' => 'Страницы',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'title'                 => 'Заголовок',
            'title_helper'          => '',
            'category'              => 'Категория',
            'category_helper'       => '',
            'tag'                   => 'Тег',
            'tag_helper'            => '',
            'page_text'             => 'Текст',
            'page_text_helper'      => '',
            'excerpt'               => 'Выдержка',
            'excerpt_helper'        => '',
            'featured_image'        => 'Изображение',
            'featured_image_helper' => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated At',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted At',
            'deleted_at_helper'     => '',
        ],
    ],
    'toAii'                     => [
        'title'          => 'Техническое обслуживание АИИС',
        'title_singular' => 'Техническое обслуживание АИИС',
    ],
    'locatoinEquipment'         => [
        'title'          => 'Локации и точки учёта',
        'title_singular' => 'Локации и точки учёта',
    ],
    'location'                  => [
        'title'          => 'Локации',
        'title_singular' => 'Локации',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Объект/Локация',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'mpoint'                    => [
        'title'          => 'Точки учёта',
        'title_singular' => 'Точки учёта',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Название',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'location'          => 'Локация',
            'location_helper'   => '',
        ],
    ],
    'zip'                       => [
        'title'          => 'Состав ЗИП',
        'title_singular' => 'Состав ЗИП',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Наименование оборудования',
            'name_helper'       => '',
            'count'             => 'Количество ЗИП',
            'count_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'proposal'                  => [
        'title'          => 'Предложения по модернизации',
        'title_singular' => 'Предложения по модернизации',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Предложение',
            'title_helper'       => '',
            'description'        => 'Описание предложения',
            'description_helper' => '',
            'date'               => 'Дата',
            'date_helper'        => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
            'files'              => 'Файлы',
            'files_helper'       => '',
        ],
    ],
    'reportPto'                 => [
        'title'          => 'Отчёты ПТО',
        'title_singular' => 'Отчёты ПТО',
    ],
    'report'                    => [
        'title'          => 'Отчёты ПТО',
        'title_singular' => 'Отчёты ПТО',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => '',
            'quarter'                => 'Квартал',
            'quarter_helper'         => '',
            'responsible'            => 'Ответственный',
            'responsible_helper'     => '',
            'brigade'                => 'Бригада',
            'brigade_helper'         => '',
            'recommendations'        => 'Рекомендации по результатам проведения ПТО',
            'recommendations_helper' => '',
            'created_at'             => 'Created at',
            'created_at_helper'      => '',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => '',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => '',
        ],
    ],
    'visualInspectionOfAii'     => [
        'title'          => 'Результаты визуального обследования оборудования АИИС',
        'title_singular' => 'Результаты визуального обследования оборудования АИИС',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
            'result'            => 'Результат обследования',
            'result_helper'     => '',
            'photo'             => 'Фотографии',
            'photo_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'point'             => 'Точка учёта',
            'point_helper'      => '',
        ],
    ],
    'monitoringStatusOfMd'      => [
        'title'          => 'Результаты мониторинга состояния АИИС',
        'title_singular' => 'Результаты мониторинга состояния АИИС',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
            'result'            => 'Результат мониторинга',
            'result_helper'     => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'point'             => 'Точка учёта',
            'point_helper'      => '',
            'files'             => 'Файлы и фото',
            'files_helper'      => '',
        ],
    ],
    'toAiisU'                   => [
        'title'          => 'Техническое обслуживание АИИС',
        'title_singular' => 'Техническое обслуживание АИИС',
    ],
    'reportU'                   => [
        'title'          => 'Отчёты ПТО',
        'title_singular' => 'Отчёты ПТО',
    ],
    'journalVoiar'              => [
        'title'          => 'Журнал ВОиАР',
        'title_singular' => 'Журнал ВОиАР',
    ],
    'zipU'                      => [
        'title'          => 'Состав ЗИП',
        'title_singular' => 'Состав ЗИП',
    ],
    'proposalsU'                => [
        'title'          => 'Предложения по модернизации',
        'title_singular' => 'Предложения по модернизации',
    ],
    'stateAii'                  => [
        'title'          => 'Текущее состояние АИИС',
        'title_singular' => 'Текущее состояние АИИС',
    ],
    'stateAiisU'                => [
        'title'          => 'Текущее состояние АИИС',
        'title_singular' => 'Текущее состояние АИИС',
    ],
    'aiisDataCompleteness'      => [
        'title'          => 'Информация о полноте сбора данных АИИС',
        'title_singular' => 'Информация о полноте сбора данных АИИС',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'date'               => 'Дата',
            'date_helper'        => '',
            'state'              => 'Состояние',
            'state_helper'       => '',
            'description'        => 'Описание',
            'description_helper' => '',
            'file'               => 'Файл',
            'file_helper'        => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'aiisWithOremRequirement'   => [
        'title'          => 'Информация о соответствии АИИС требованиям ОРЭМ',
        'title_singular' => 'Информация о соответствии АИИС требованиям ОРЭМ',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'data'               => 'Дата',
            'data_helper'        => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
            'state_p_313'        => 'АИИС соответствует требованиям по параметру П313',
            'state_p_313_helper' => '',
            'state_p_314'        => 'АИИС соответствует требованиям по параметру П314',
            'state_p_314_helper' => '',
            'state_p_315'        => 'АИИС соответствует требованиям по параметру П315',
            'state_p_315_helper' => '',
            'state_pf_2'         => 'АИИС соответствует требованиям по параметру Пф2',
            'state_pf_2_helper'  => '',
            'state_pf_4'         => 'АИИС соответствует требованиям по параметру Пф4',
            'state_pf_4_helper'  => '',
            'state_pf_7'         => 'АИИС соответствует требованиям по параметру Пф7',
            'state_pf_7_helper'  => '',
            'state_pf_8'         => 'АИИС соответствует требованиям по параметру Пф8',
            'state_pf_8_helper'  => '',
            'state_pf_9'         => 'АИИС соответствует требованиям по параметру Пф9',
            'state_pf_9_helper'  => '',
            'state_pf_10'        => 'АИИС соответствует требованиям по параметру Пф10',
            'state_pf_10_helper' => '',
            'state_pf_11'        => 'АИИС соответствует требованиям по параметру Пф11',
            'state_pf_11_helper' => '',
            'state_pf_13'        => 'АИИС соответствует требованиям по параметру Пф13',
            'state_pf_13_helper' => '',
            'state_pf_16'        => 'АИИС соответствует требованиям по параметру Пф16',
            'state_pf_16_helper' => '',
            'state_pf_24'        => 'АИИС соответствует требованиям по параметру Пф24',
            'state_pf_24_helper' => '',
            'state_pf_28'        => 'АИИС соответствует требованиям по параметру Пф28',
            'state_pf_28_helper' => '',
            'state_pf_32'        => 'АИИС соответствует требованиям по параметру Пф32',
            'state_pf_32_helper' => '',
            'state_pf_40'        => 'АИИС соответствует требованиям по параметру Пф40',
            'state_pf_40_helper' => '',
            'state_pf_41'        => 'АИИС соответствует требованиям по параметру Пф41',
            'state_pf_41_helper' => '',
            'state_pf_42'        => 'АИИС соответствует требованиям по параметру Пф42',
            'state_pf_42_helper' => '',
        ],
    ],
    'aiisDocumentationUpdate'   => [
        'title'          => 'График актуализации документации АИИС',
        'title_singular' => 'График актуализации документации АИИС',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'verification_si'          => 'Поверка СИ',
            'verification_si_helper'   => '',
            'verification_aiis'        => 'Поверка АИИС',
            'verification_aiis_helper' => '',
            'year'                     => 'Год',
            'year_helper'              => '',
            'actual_metr_data'         => 'Актуализция метрологических данных',
            'actual_metr_data_helper'  => '',
            'mapping'                  => 'Установление соответствий',
            'mapping_helper'           => '',
        ],
    ],
    'aiisDataCompletenessU'     => [
        'title'          => 'Информация о полноте сбора данных АИИС',
        'title_singular' => 'Информация о полноте сбора данных АИИС',
    ],
    'aiisWithOremRequirementsU' => [
        'title'          => 'Информация о соответствии АИИС требованиям ОРЭМ',
        'title_singular' => 'Информация о соответствии АИИС требованиям ОРЭМ',
    ],
    'aiisDocumentationUpdateU'  => [
        'title'          => 'График актуализации документации АИИС',
        'title_singular' => 'График актуализации документации АИИС',
    ],
    'mainWork'                  => [
        'title'          => 'Перечень работ с отметкой о выполнении в рамках ПТО',
        'title_singular' => 'Перечень работ с отметкой о выполнении в рамках ПТО',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'comment'           => 'Комментарий',
            'comment_helper'    => '',
            'files'             => 'Файлы',
            'files_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
        ],
    ],
    'analysisWorkAii'           => [
        'title'          => 'Анализ работы АИИС КУЭ',
        'title_singular' => 'Анализ работы АИИС КУЭ',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
            'diagnostic'        => 'Диагностическая карта',
            'diagnostic_helper' => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'dataCollectionResult'      => [
        'title'          => 'Результаты сбора данных об актуальном составе АИИС',
        'title_singular' => 'Результаты сбора данных об актуальном составе АИИС',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => '',
            'date'                           => 'Дата',
            'date_helper'                    => '',
            'change_character'               => 'Характер изменения',
            'change_character_helper'        => '',
            'considered_metrological'        => 'Учтено в метрологических документах',
            'considered_metrological_helper' => '',
            'files'                          => 'Файлы',
            'files_helper'                   => '',
            'created_at'                     => 'Created at',
            'created_at_helper'              => '',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => '',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => '',
        ],
    ],
    'dataCollectionResultU'     => [
        'title'          => 'Результаты сбора данных об актуальном составе АИИС',
        'title_singular' => 'Результаты сбора данных об актуальном составе АИИС',
    ],
    'serverAnalysi'             => [
        'title'          => 'Результаты мониторинга работы сервера АИИС',
        'title_singular' => 'Результаты мониторинга работы сервера АИИС',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
            'result'            => 'Результат мониторинга',
            'result_helper'     => '',
            'files'             => 'Файлы и фото',
            'files_helper'      => '',
        ],
    ],
    'uspdAnalysi'               => [
        'title'          => 'Результаты мониторинга работы УСПД',
        'title_singular' => 'Результаты мониторинга работы УСПД',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'location'          => 'Локация',
            'location_helper'   => '',
            'result'            => 'Результат мониторинга',
            'result_helper'     => '',
            'files'             => 'Файлы и фото',
            'files_helper'      => '',
        ],
    ],
    'resultVisualServer'        => [
        'title'          => 'Результаты визуального обследования сервера АИИС',
        'title_singular' => 'Результаты визуального обследования сервера АИИС',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'resut'             => 'Результат обследования',
            'resut_helper'      => '',
            'photo'             => 'Фотографии',
            'photo_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
        ],
    ],
    'resultVisualUspd'          => [
        'title'          => 'Результаты визуального обследования УСПД',
        'title_singular' => 'Результаты визуального обследования УСПД',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'result'            => 'Результат обследования',
            'result_helper'     => '',
            'photo'             => 'Фотографии',
            'photo_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'location'          => 'Локация',
            'location_helper'   => '',
            'quarter'           => 'Отчёт ПТО',
            'quarter_helper'    => '',
        ],
    ],
    'journalPto'                => [
        'title'          => 'Журнал ПТО',
        'title_singular' => 'Журнал ПТО',
    ],
];
