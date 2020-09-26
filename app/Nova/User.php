<?php

namespace App\Nova;

use Illuminate\Http\Request;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;

use App\Nova\Actions\UserImportAction;
use App\Nova\Actions\ModelExportAction;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'User';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
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

            Gravatar::make(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Mobile')
                ->sortable()
                ->rules('required', 'max:254'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Text::make('Gender')
                ->sortable()
                ->rules('required', 'max:254'),

            Text::make('Date of Birth', 'dob')
                ->sortable()
                ->rules('required', 'max:254'),

            Text::make('Unique ID', 'unique_id')->sortable(),

            Text::make('City')
                ->sortable()
                ->rules('required', 'max:254'),

            HasMany::make("Subscriptions"),

            HasMany::make("Device Tokens", "device_tokens", DeviceToken::class),

            Date::make('Joined On', "created_at")
                ->exceptOnForms()
                ->resolveUsing(function ($date) {
                    return $date->format('d/m/Y h:m A');
                })
                ->sortable(),

            Boolean::make('Status')
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
            new UserImportAction,
            (new ModelExportAction('users'))->withHeadings(),
        ];
    }
}
