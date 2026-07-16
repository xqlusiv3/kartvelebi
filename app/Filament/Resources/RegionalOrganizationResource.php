<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionalOrganizationResource\Pages;
use App\Models\RegionalOrganization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RegionalOrganizationResource extends Resource
{
    protected static ?string $model = RegionalOrganization::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Региональные организации';

    protected static ?string $modelLabel = 'региональную организацию';

    protected static ?string $pluralModelLabel = 'Региональные организации';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основное')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Название организации')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        Forms\Components\TextInput::make('slug')
                            ->label('Адрес страницы')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Например: moskva или krasnodar.'),

                        Forms\Components\Select::make('type')
                            ->label('Тип организации')
                            ->options([
                                'Федеральная НКА' => 'Федеральная НКА',
                                'Региональная НКА' => 'Региональная НКА',
                                'Городская НКА' => 'Городская НКА',
                                'Диаспора' => 'Диаспора',
                                'Культурный центр' => 'Культурный центр',
                                'Представительство' => 'Представительство',
                            ])
                            ->native(false)
                            ->searchable(),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('is_published')
                            ->label('Опубликовано')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Регион и локация')
                    ->schema([
                        Forms\Components\Select::make('federal_district')
                            ->label('Федеральный округ')
                            ->options([
                                'ЦФО' => 'ЦФО',
                                'СЗФО' => 'СЗФО',
                                'ЮФО' => 'ЮФО',
                                'СКФО' => 'СКФО',
                                'ПФО' => 'ПФО',
                                'УФО' => 'УФО',
                                'СФО' => 'СФО',
                                'ДФО' => 'ДФО',
                            ])
                            ->native(false)
                            ->searchable(),

                        Forms\Components\TextInput::make('region')
                            ->label('Регион')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('city')
                            ->label('Город')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('address')
                            ->label('Адрес')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('show_address')
                            ->label('Показывать адрес на сайте')
                            ->default(true),

                        Forms\Components\Select::make('location_precision')
                            ->label('Точность локации')
                            ->options([
                                'address' => 'Точный адрес',
                                'city' => 'Город',
                                'region' => 'Регион',
                                'hidden' => 'Адрес не публикуется',
                            ])
                            ->native(false),

                        Forms\Components\TextInput::make('latitude')
                            ->label('Широта')
                            ->numeric()
                            ->helperText('Для будущей карты. Можно оставить пустым.'),

                        Forms\Components\TextInput::make('longitude')
                            ->label('Долгота')
                            ->numeric()
                            ->helperText('Для будущей карты. Можно оставить пустым.'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Руководитель')
                    ->schema([
                        Forms\Components\TextInput::make('leader_name')
                            ->label('ФИО руководителя')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('leader_position')
                            ->label('Должность')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('leader_photo')
                            ->label('Фото руководителя')
                            ->image()
                            ->disk('public')
                            ->directory('regional-leaders')
                            ->imageEditor()
                            ->imagePreviewHeight('220')
                            ->maxSize(4096),

                        Forms\Components\Textarea::make('leader_bio')
                            ->label('Краткое био')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Контакты')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Телефон')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('website')
                            ->label('Сайт')
                            ->url()
                            ->maxLength(255),

                        Forms\Components\Repeater::make('social_links')
                            ->label('Социальные ссылки')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Тип')
                                    ->options([
                                        'telegram' => 'Telegram',
                                        'vk' => 'ВКонтакте',
                                        'max' => 'MAX',
                                        'ok' => 'Одноклассники',
                                        'youtube' => 'YouTube',
                                        'rutube' => 'RuTube',
                                        'other' => 'Другое',
                                    ])
                                    ->native(false)
                                    ->required(),

                                Forms\Components\TextInput::make('label')
                                    ->label('Название')
                                    ->maxLength(80),

                                Forms\Components\TextInput::make('url')
                                    ->label('Ссылка')
                                    ->url()
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(3)
                            ->columnSpanFull()
                            ->addActionLabel('Добавить ссылку'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Описание')
                    ->schema([
                        Forms\Components\Textarea::make('short_description')
                            ->label('Краткое описание')
                            ->rows(3)
                            ->maxLength(600)
                            ->helperText('Показывается в карточке списка.')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Подробное описание')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'bulletList',
                                'orderedList',
                                'link',
                                'blockquote',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('work_hours')
                            ->label('График связи / приёма')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(44),

                Tables\Columns\TextColumn::make('city')
                    ->label('Город')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('region')
                    ->label('Регион')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('federal_district')
                    ->label('Округ')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('leader_name')
                    ->label('Руководитель')
                    ->searchable()
                    ->limit(32),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубл.')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликовано'),

                Tables\Filters\SelectFilter::make('federal_district')
                    ->label('Федеральный округ')
                    ->options([
                        'ЦФО' => 'ЦФО',
                        'СЗФО' => 'СЗФО',
                        'ЮФО' => 'ЮФО',
                        'СКФО' => 'СКФО',
                        'ПФО' => 'ПФО',
                        'УФО' => 'УФО',
                        'СФО' => 'СФО',
                        'ДФО' => 'ДФО',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранные'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegionalOrganizations::route('/'),
            'create' => Pages\CreateRegionalOrganization::route('/create'),
            'edit' => Pages\EditRegionalOrganization::route('/{record}/edit'),
        ];
    }
}
