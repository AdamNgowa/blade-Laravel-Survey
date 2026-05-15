<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Select::make('topic_id')
                    ->relationship('topic','title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('question')
                    ->required(),                    
                TextInput::make('sequence')
                    ->required()
                    ->numeric()
                    ->integer()
                    ->minValue(1)
                    ->default(1)
                    
            ]);
    }
}
