<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = new Sitemap();

        $sitemap->add(Url::create('/')
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(1));

        $sitemap->add(Url::create(route('client.events.list'))
                        ->setLastModificationDate(Carbon::yesterday())
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.9));

        $blogs = \App\Models\Blog::where('active', 1)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        $events = \App\Models\Event::where('active', 1)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                                  
        foreach ($blogs as $index => $blog) {
            $sitemap->add(Url::create(route('client.blogs', ['slug' => $blog['slug']]))
                        ->setLastModificationDate($blog->created_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.8));
        }

        foreach ($events as $index => $event) {
            $sitemap->add(Url::create(route('client.events', ['slug' => $event['slug']]))
                        ->setLastModificationDate($event->created_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.8));
        }

        $sitemap->writeToFile(public_path() . '/sitemap.xml');

        if (\File::exists(public_path() . '/sitemap.xml')) {
            chmod(public_path() . '/sitemap.xml', 0777);
        }
    }
}
