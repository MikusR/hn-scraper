<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeHN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:hn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from Hacker News website by scraping html';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $html = file_get_contents('https://news.ycombinator.com/');
        $crawler = new Crawler($html);
        $links = $crawler->filter('tr.athing');
        if ($links->count() > 0) {
            $links->each(function (Crawler $node) {
                $titleNode = $node->filter('td.title > span.titleline > a');
                $title = htmlspecialchars($titleNode->text());
                $url = $titleNode->attr('href');
                $etcNode = $node->nextAll()->filter('tr');
                $score = (int)explode(" ", $etcNode->filter('span.score')->text())[0];
                $date = $etcNode->filter('span.age')->attr('title');
                $id = substr($etcNode->filter('span.age > a')->attr('href'), 8);
                try {
                    $link = Link::withTrashed()->findOrFail($id);
                    if ($link->trashed()) {
                        return;
                    }
                    $link->update([
                        'points' => $score,
                    ]);
                } catch (ModelNotFoundException $e) {
                    if (substr($url, 0, 4) == "item") {
                        $url = "https://news.ycombinator.com/item?id=" . $id;
                    }
                    $test = Link::create([
                        'article_id' => $id,
                        'title' => $title,
                        'url' => $url,
                        'points' => $score,
                        'date' => $date,
                    ]);

                }

            });

        }


        return 0;
    }
}
