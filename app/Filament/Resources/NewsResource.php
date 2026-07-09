<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $modelLabel = 'новость';

    protected static ?string $pluralModelLabel = 'Новости';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основное')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Заголовок')
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
                            ->helperText('Генерируется из заголовка. Можно поправить вручную.'),

                        Forms\Components\Select::make('category')
                            ->label('Категория')
                            ->options([
                                'Мероприятия' => 'Мероприятия',
                                'Культура' => 'Культура',
                                'Объявления' => 'Объявления',
                                'Образование' => 'Образование',
                                'Партнёрство' => 'Партнёрство',
                            ])
                            ->native(false)
                            ->searchable(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Дата публикации')
                            ->native(false)
                            ->displayFormat('d.m.Y')
                            ->default(now()),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Изображение')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Фото новости')
                            ->image()
                            ->directory('news')
                            ->disk('public')
                            ->imageEditor()
                            ->imagePreviewHeight('220')
                            ->maxSize(4096)
                            ->helperText('Лучше загружать горизонтальные изображения. Рекомендуемый формат: 1200×800 или 1600×1000.'),
                    ]),

                Forms\Components\Section::make('Текст')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Краткое описание')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Короткий текст для карточки в карусели.')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Полный текст')
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
                    ]),

                Forms\Components\Section::make('Публикация')
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Опубликовано')
                            ->default(true),

                        Forms\Components\Toggle::make('show_on_home')
                            ->label('Показывать на главной')
                            ->default(true),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок')
                            ->numeric()
                            ->default(0)
                            ->helperText('Чем меньше число, тем выше новость в списке.'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Фото')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(45)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Дата')
                    ->date('d.m.Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Опубл.')
                    ->boolean(),

                Tables\Columns\IconColumn::make('show_on_home')
                    ->label('Главная')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Опубликовано'),

                Tables\Filters\TernaryFilter::make('show_on_home')
                    ->label('На главной'),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Категория')
                    ->options([
                        'Мероприятия' => 'Мероприятия',
                        'Культура' => 'Культура',
                        'Объявления' => 'Объявления',
                        'Образование' => 'Образование',
                        'Партнёрство' => 'Партнёрство',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Редактировать'),

                Tables\Actions\DeleteAction::make()
                    ->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Удалить выбранные'),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}