<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view): void {
            $navCategories = collect();
            $navLevels = collect(Program::LEVELS);
            $navFormats = collect(Program::FORMATS);

            if (Schema::hasTable('departments') && Schema::hasTable('programs')) {
                $navCategories = Department::query()
                    ->where('show_in_nav', true)
                    ->with(['programs' => fn ($query) => $query->published()->orderBy('title')])
                    ->withCount(['programs' => fn ($query) => $query->published()])
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get();

                $publishedLevels = Program::query()
                    ->published()
                    ->pluck('level')
                    ->filter()
                    ->unique()
                    ->values();

                if ($publishedLevels->isNotEmpty()) {
                    $navLevels = collect(Program::LEVELS)
                        ->intersect($publishedLevels)
                        ->merge($publishedLevels)
                        ->unique()
                        ->values();
                }

                $publishedFormats = Program::query()
                    ->published()
                    ->get(['formats'])
                    ->pluck('formats')
                    ->flatten()
                    ->filter()
                    ->unique()
                    ->values();

                if ($publishedFormats->isNotEmpty()) {
                    $navFormats = collect(Program::FORMATS)
                        ->intersect($publishedFormats)
                        ->merge($publishedFormats)
                        ->unique()
                        ->values();
                }
            }

            $view->with([
                'navCategories' => $navCategories,
                'navLevels' => $navLevels,
                'navFormats' => $navFormats,
            ]);
        });
    }
}
