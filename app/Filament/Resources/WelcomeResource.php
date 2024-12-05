<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WelcomeResource\Pages;
use App\Filament\Resources\WelcomeResource\RelationManagers;
use App\Models\Welcome;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\IconColumn;

class WelcomeResource extends Resource
{
    protected static ?string $model = Welcome::class;

    protected static ?string $navigationLabel = 'Mensaje de bienvenida', $navigationIcon = 'heroicon-o-hand-raised';

    public static function getPluralLabel(): string
    {
        return ('Mensaje de Bienvenida para el cliente');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('welcomereply')
                        ->label('Bienvenida') 
                        ->required()           
                        ->maxLength(255),
                                  
                    Forms\Components\FileUpload::make('mediaPath')
                        ->label('Archivo') // Etiqueta visible para el usuario
                        ->hint('Seleccione un archivo para subir') // Descripción o ayuda para el campo
                        ->disk('public')
                        ->directory('media')
                        ->preserveFilenames()
                        ->previewable(true) // Permitir vista previa si es aplicable
                        ->openable(), // Almacenamiento en el disco 'public'
                         // Directorio 'media' dentro del disco 'public'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('welcomereply')
                ->label('Bienvenida') 
                ->wrap()    
                ->words(15)       
                ->searchable(),
                
            Tables\Columns\IconColumn::make('mediaPath')
                ->label('Archivo Media')
                ->icon('heroicon-o-folder-open')                
                ->searchable(),  
                
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWelcomes::route('/'),
            'create' => Pages\CreateWelcome::route('/create'),
            'edit' => Pages\EditWelcome::route('/{record}/edit'),
        ];
    }
}
