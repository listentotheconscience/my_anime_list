<?php

namespace App\Nova;

use App\Enums\TitleStatus;
use App\Nova\Actions\SetAbandonedAction;
use App\Nova\Actions\SetDroppedAction;
use App\Nova\Actions\SetFavoriteAction;
use App\Nova\Actions\SetPlannedAction;
use App\Nova\Actions\SetWatchedAction;
use App\Nova\Actions\SetWatchingAction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Title extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Title::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            ID::make(__('ID'), 'id')->sortable(),

            MorphTo::make('Titlable')
                ->types([
                    Anime::class,
                    Manga::class
                ]),

            Select::make('Status')
                ->options(TitleStatus::asArray()),

            BelongsTo::make('User', 'user')
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
            SetDroppedAction::make()->withoutConfirmation(),
            SetFavoriteAction::make()->withoutConfirmation(),
            SetPlannedAction::make()->withoutConfirmation(),
            SetWatchedAction::make()->withoutConfirmation(),
            SetWatchingAction::make()->withoutConfirmation()
        ];
    }
}
