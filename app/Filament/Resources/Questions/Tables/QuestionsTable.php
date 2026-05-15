<?php

namespace App\Filament\Resources\Questions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->defaultSort('sequence')
            ->columns([
                TextColumn::make('topic.title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('question')
                ->limit(50)
                ->searchable(),    
                TextColumn::make('sequence')
                    ->numeric()
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
