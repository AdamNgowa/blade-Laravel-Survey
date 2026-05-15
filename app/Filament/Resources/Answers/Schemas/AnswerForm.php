<?php

namespace App\Filament\Resources\Answers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([             

            Select::make('question_id')
                    ->relationship('question', 'question')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('answer')
                    ->label('Answer Text')
                    ->required(),
                TextInput::make('marks')
                    ->required()
                    ->numeric()
                    ->integer(),
                TextInput::make('sequence')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->minValue(1)
                    
            ]);
    }
}
