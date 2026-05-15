<?php

namespace App\Filament\Resources\Answers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnswersTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->defaultSort('sequence')
            ->columns([
                TextColumn::make('question.question')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('answer'),                    
                TextColumn::make('marks')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sequence')                   
                    ->sortable(),
                ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
