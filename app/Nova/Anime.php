<?php

namespace App\Nova;

use App\Enums\Genres;
use App\Enums\Status;
use App\Enums\Type;
use App\Nova\Actions\SetAnnouncedAction;
use App\Nova\Actions\SetFinishedAction;
use App\Nova\Actions\SetOngoingAction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use OptimistDigital\MultiselectField\Multiselect;

class Anime extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Anime::class;

    public static $group = 'Anime';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),

            Text::make('Name')
                ->sortable(),

            Number::make('Episodes')
                ->sortable(),

            BelongsTo::make('Licensor', 'licensors', Licensor::class)
                ->hideFromIndex(),

            Multiselect::make('Genres')
                ->options(Genres::asSelectArray()),

            Number::make('Rating')
                ->step(0.01)
                ->default(fn () => 0)
                ->min(0)
                ->max(10)
                ->sortable(),

            Text::make('Season')
                ->sortable(),

            Select::make('Type')
                ->options(Type::asArray()),

            Select::make('Status')
                ->options(Status::asArray()),

            BelongsTo::make('Producer', 'producers', Producer::class)
                ->hideFromIndex(),

            BelongsTo::make('Studio', 'studios', Studio::class)
                ->hideFromIndex(),

            Image::make('Image')
                ->prunable()
                ->path('images')
                ->disk('public'),

            HasMany::make('Votes', 'Votes')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            SetAnnouncedAction::make()->withoutConfirmation(),

            SetOngoingAction::make()->withoutConfirmation(),

            SetFinishedAction::make()->withoutConfirmation()
        ];
    }
}
