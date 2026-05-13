<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Products';

    protected static ?string $modelLabel = 'Product';

    protected static ?string $pluralModelLabel = 'Products';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product')
                    ->tabs([
                        // 基本信息标签
                        Forms\Components\Tabs\Tab::make('Basic Info')
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->translatable()
                                            ->label('Product Name')
                                            ->placeholder('e.g. Stainless Steel Water Tank 1000L'),

                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->label('URL Slug')
                                            ->placeholder('e.g. stainless-steel-water-tank-1000l'),

                                        Forms\Components\TextInput::make('sku')
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->label('SKU')
                                            ->placeholder('e.g. SST-1000'),

                                        Forms\Components\Select::make('category_id')
                                            ->relationship('category', 'name', function (Builder $query) {
                                                return $query->where('type', 'product')->where('is_active', true);
                                            })
                                            ->required()
                                            ->searchable()
                                            ->preload()
                                            ->label('Category'),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Pricing')
                                    ->schema([
                                        Forms\Components\TextInput::make('base_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('Base Price')
                                            ->placeholder('0.00'),

                                        Forms\Components\Select::make('currency')
                                            ->options([
                                                'USD' => 'USD',
                                                'CNY' => 'CNY',
                                                'EUR' => 'EUR',
                                            ])
                                            ->default('USD')
                                            ->label('Currency'),

                                        Forms\Components\TextInput::make('unit')
                                            ->default('piece')
                                            ->label('Unit')
                                            ->placeholder('piece, set, ton...'),
                                    ])
                                    ->columns(3),
                            ]),

                        // 内容标签
                        Forms\Components\Tabs\Tab::make('Content')
                            ->schema([
                                Forms\Components\Section::make('Descriptions')
                                    ->schema([
                                        Forms\Components\Textarea::make('description')
                                            ->maxLength(1000)
                                            ->rows(3)
                                            ->translatable()
                                            ->label('Short Description')
                                            ->placeholder('Brief product description for listing page...'),

                                        Forms\Components\RichEditor::make('content')
                                            ->fileAttachmentsDisk('public')
                                            ->fileAttachmentsDirectory('products/content')
                                            ->translatable()
                                            ->label('Full Description')
                                            ->placeholder('Detailed product description...'),
                                    ]),

                                Forms\Components\Section::make('Specifications & Features')
                                    ->schema([
                                        Forms\Components\Textarea::make('specifications')
                                            ->rows(5)
                                            ->translatable()
                                            ->label('Specifications')
                                            ->helperText('One per line, format: Key: Value')
                                            ->placeholder("Material: Stainless Steel 304\nCapacity: 1000L\nThickness: 2mm\n..."),

                                        Forms\Components\Textarea::make('features')
                                            ->rows(5)
                                            ->translatable()
                                            ->label('Key Features')
                                            ->helperText('One feature per line')
                                            ->placeholder("Corrosion resistant\nEasy to install\nLong service life\n..."),

                                        Forms\Components\Textarea::make('applications')
                                            ->rows(5)
                                            ->translatable()
                                            ->label('Applications')
                                            ->helperText('One application per line')
                                            ->placeholder("Industrial water storage\nChemical processing\nFood & beverage industry\n..."),
                                    ])
                                    ->columns(1),
                            ]),

                        // 图片标签
                        Forms\Components\Tabs\Tab::make('Images')
                            ->schema([
                                Forms\Components\Section::make('Main Image')
                                    ->schema([
                                        Forms\Components\FileUpload::make('main_image')
                                            ->image()
                                            ->directory('products/main')
                                            ->maxSize(5120)
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('4:3')
                                            ->imageResizeTargetWidth('800')
                                            ->imageResizeTargetHeight('600')
                                            ->label('Main Product Image'),
                                    ]),

                                Forms\Components\Section::make('Gallery')
                                    ->schema([
                                        Forms\Components\FileUpload::make('gallery')
                                            ->multiple()
                                            ->image()
                                            ->directory('products/gallery')
                                            ->maxSize(5120)
                                            ->reorderable()
                                            ->label('Product Gallery'),
                                    ]),

                                Forms\Components\Section::make('Documents')
                                    ->schema([
                                        Forms\Components\FileUpload::make('documents')
                                            ->multiple()
                                            ->directory('products/documents')
                                            ->maxSize(10240)
                                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                                            ->label('Product Documents (PDF/DOC)'),
                                    ]),
                            ]),

                        // SEO 标签
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\Section::make('Meta Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title')
                                            ->maxLength(255)
                                            ->translatable()
                                            ->label('Meta Title')
                                            ->placeholder('Product Name | Cosens Industrial'),

                                        Forms\Components\Textarea::make('meta_description')
                                            ->maxLength(500)
                                            ->rows(2)
                                            ->translatable()
                                            ->label('Meta Description')
                                            ->placeholder('Brief description for search engines...'),

                                        Forms\Components\TextInput::make('meta_keywords')
                                            ->maxLength(500)
                                            ->translatable()
                                            ->label('Meta Keywords')
                                            ->placeholder('water tank, stainless steel, industrial...'),
                                    ])
                                    ->columns(1),
                            ]),

                        // 状态标签
                        Forms\Components\Tabs\Tab::make('Status')
                            ->schema([
                                Forms\Components\Section::make('Display Settings')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->default(true)
                                            ->label('Active')
                                            ->helperText('Show this product on the website'),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->default(false)
                                            ->label('Featured')
                                            ->helperText('Show on homepage featured section'),

                                        Forms\Components\TextInput::make('sort_order')
                                            ->numeric()
                                            ->default(0)
                                            ->label('Sort Order'),
                                    ])
                                    ->columns(3),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->square()
                    ->defaultImageUrl(url('/images/placeholder-product.png'))
                    ->label('Image'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->label('Name'),

                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->label('Category'),

                Tables\Columns\TextColumn::make('sku')
                    ->searchable()
                    ->sortable()
                    ->label('SKU'),

                Tables\Columns\TextColumn::make('base_price')
                    ->money('USD')
                    ->sortable()
                    ->label('Price'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Order'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created'),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name', function (Builder $query) {
                        return $query->where('type', 'product');
                    })
                    ->searchable()
                    ->preload()
                    ->label('Category'),

                Tables\Filters\Filter::make('is_featured')
                    ->query(fn (Builder $query): Builder => $query->where('is_featured', true))
                    ->toggle()
                    ->label('Featured Only'),

                Tables\Filters\Filter::make('is_active')
                    ->query(fn (Builder $query): Builder => $query->where('is_active', true))
                    ->toggle()
                    ->label('Active Only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
