<?php

namespace App\Nova;

use App\Enums\Genres;
use App\Enums\MangaStatus;
use App\Enums\MangaTypes;
use App\Nova\Actions\SetAbandonedAction;
use App\Nova\Actions\SetAnnouncedAction;
use App\Nova\Actions\SetFinishedAction;
use App\Nova\Actions\SetOngoingAction;
use App\Nova\Actions\SetPausedAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\MultiselectField\Multiselect;

class Manga extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Manga::class;

    public static $group = 'Manga';

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

            Number::make('Chapters')
                ->min(0)
                ->sortable(),

            BelongsTo::make('Mangaka', 'mangakas', Mangaka::class)
                ->hideFromIndex(),

            Multiselect::make('Genres')
                ->options(Genres::asSelectArray()),

            Number::make('Rating')
                ->step(0.01)
                ->min(0)
                ->max(10)
                ->sortable(),

            Number::make('Year')
                ->min(1930)
                ->max(Carbon::now()->format('Y'))
                ->sortable(),

            Select::make('Type')
                ->options(MangaTypes::asArray()),

            Select::make('Status')
                ->options(MangaStatus::asArray()),


            Image::make('Image')
                ->prunable()
                ->disk('public')
                ->disableDownload(),

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
            SetOngoingAction::make()->withoutConfirmation(),
            SetAnnouncedAction::make()->withoutConfirmation(),
            SetFinishedAction::make()->withoutConfirmation(),
            SetPausedAction::make()->withoutConfirmation(),
            SetAbandonedAction::make()->withoutConfirmation()
        ];
    }
}
