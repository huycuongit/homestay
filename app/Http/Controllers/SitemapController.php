<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Tip;
use App\Models\News;
use App\Models\Event;
use App\Models\Service;

class SitemapController extends Controller
{
    // public function index()
    // {
    //     // Create a new sitemap instance
    //     $sitemap = Sitemap::create();

    //     // Get the base URL from the config
    //     $baseUrl = rtrim(config('app.url'), '/');

    //     // Add tips
    //     $tips = Tip::all();
    //     foreach ($tips as $tip) {
    //         $sitemap->add(Url::create("{$baseUrl}/tips/{$tip->slug}")
    //             ->setLastModificationDate($tip->updated_at)
    //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
    //             ->setPriority(0.8));
    //     }

    //     // Add news
    //     $newsItems = News::all();
    //     foreach ($newsItems as $news) {
    //         $sitemap->add(Url::create("{$baseUrl}/news/{$news->slug}")
    //             ->setLastModificationDate($news->updated_at)
    //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
    //             ->setPriority(0.8));
    //     }

    //     // Add events
    //     $events = Event::all();
    //     foreach ($events as $event) {
    //         $sitemap->add(Url::create("{$baseUrl}/events/{$event->slug}")
    //             ->setLastModificationDate($event->updated_at)
    //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
    //             ->setPriority(0.6));
    //     }

    //     // Return the sitemap in XML format
    //     return response($sitemap->render())
    //         ->header('Content-Type', 'application/xml');
    // }
    public function index()
    {
        // Cache the sitemap for 24 hours
        $sitemap = Cache::remember('sitemap', 1440, function () {
            $sitemap = Sitemap::create();
            $baseUrl = rtrim(
                config('app.url'),
                '/'
            );

            $fixedPages = [
                'dich-vu',
                'lien-he',
                'gioi-thieu',
                'thu-vien-anh'
            ];

            foreach ($fixedPages as $page) {
                $sitemap->add(Url::create("{$baseUrl}/{$page}")
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8));
            }

            // Add tips
            $careers = Service::all();
            foreach ($careers as $career) {
                $sitemap->add(Url::create("{$baseUrl}/dich-vu/{$career->slug}")
                    ->setLastModificationDate($career->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.8));
            }

            // Add news
            // $newsItems = News::all();
            // foreach ($newsItems as $news) {
            //     $sitemap->add(Url::create("{$baseUrl}/tin-tuc/{$news->slug}")
            //         ->setLastModificationDate($news->updated_at)
            //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            //         ->setPriority(0.8));
            // }

            // Add events
            // $events = Event::all();
            // foreach ($events as $event) {
            //     $sitemap->add(Url::create("{$baseUrl}/su-kien/{$event->slug}")
            //         ->setLastModificationDate($event->updated_at)
            //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            //         ->setPriority(0.6));
            // }

            return $sitemap;
        });

        // Return the sitemap in XML format
        return response($sitemap->render())
            ->header('Content-Type', 'application/xml');
    }
}
