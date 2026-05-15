<?php

namespace App\Filament\Resources\Topics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
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
