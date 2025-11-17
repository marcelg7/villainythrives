<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Accounting';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Expense Details')
                    ->schema([
                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Brief description of expense'),

                        Forms\Components\Select::make('category')
                            ->required()
                            ->options([
                                'materials' => 'Materials',
                                'shipping' => 'Shipping',
                                'printing' => 'Printing & Production',
                                'marketing' => 'Marketing & Advertising',
                                'supplies' => 'Office Supplies',
                                'utilities' => 'Utilities',
                                'fees' => 'Fees & Services',
                                'other' => 'Other',
                            ])
                            ->native(false),

                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step(0.01),

                        Forms\Components\DatePicker::make('expense_date')
                            ->required()
                            ->default(now())
                            ->native(false)
                            ->displayFormat('F j, Y'),

                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'etransfer' => 'E-Transfer',
                                'credit' => 'Credit Card',
                                'debit' => 'Debit Card',
                                'cheque' => 'Cheque',
                                'other' => 'Other',
                            ])
                            ->native(false),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3)
                            ->placeholder('Additional notes or details...'),

                        Forms\Components\FileUpload::make('receipt_path')
                            ->label('Receipt')
                            ->directory('receipts')
                            ->image()
                            ->maxSize(5120) // 5MB
                            ->acceptedFileTypes(['image/*', 'application/pdf'])
                            ->helperText('Upload receipt image or PDF (max 5MB)'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_date')
                    ->date('M j, Y')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'materials' => 'info',
                        'shipping' => 'warning',
                        'printing' => 'success',
                        'marketing' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('amount')
                    ->money('CAD')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('CAD')
                            ->label('Total'),
                    ]),

                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->searchable(),

                Tables\Columns\IconColumn::make('receipt_path')
                    ->label('Receipt')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('expense_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'materials' => 'Materials',
                        'shipping' => 'Shipping',
                        'printing' => 'Printing & Production',
                        'marketing' => 'Marketing & Advertising',
                        'supplies' => 'Office Supplies',
                        'utilities' => 'Utilities',
                        'fees' => 'Fees & Services',
                        'other' => 'Other',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'cash' => 'Cash',
                        'etransfer' => 'E-Transfer',
                        'credit' => 'Credit Card',
                        'debit' => 'Debit Card',
                        'cheque' => 'Cheque',
                        'other' => 'Other',
                    ]),

                Tables\Filters\Filter::make('expense_date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expense_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('expense_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
