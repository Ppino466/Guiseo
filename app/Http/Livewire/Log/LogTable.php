<?php

namespace App\Http\Livewire\Log;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;



class LogTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Log::query()
        ->orderBy('created_at', 'desc');
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDisabled();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Registrado por')
                ->options([
                    User::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($tag) => $tag->name)
                        ->toArray()
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('causer_id','=', $value);
                }),
            DateFilter::make('Fecha')
            ->filter(function(Builder $builder, string $value) {
                $builder->where('created_at','>=', $value);
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Descripción", "description")
                ->sortable()
                ->searchable(),
                Column::make("Modelo", "subject_type")
                ->format(function ($value) {
                    $parts = explode('\\', $value);
                    return end($parts);
                }),
            Column::make("Evento", "event")
                ->sortable()
                ->searchable(),
                Column::make("Usuario", "causer_id")
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    if($value){
                    $value = User::find($value)
                        ->where('id', $value)
                        ->value('name');
                    return $value;
                }return 'Sistema';
                }),    
            Column::make("Fecha de registro", "created_at")
                ->sortable()
                ->searchable(),
        ];
    }
}
