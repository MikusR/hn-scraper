<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
    protected $description = 'Command description';

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
//        return $crawler;
//        dd($crawler->filterXPath('//tr[@class="athing"]/..')->children());
        echo "<pre>";
//        dd($crawler->filterXPath('//tr[@class="athing"]/..')->children()->count());
        foreach ($crawler->filterXPath('//tr[@class="athing"]/..')->children() as $element) {
//            dd($element->ownerDocument->saveHTML($element));
//            dd($element->childNodes);

//            var_dump($element->childNodes->item(4)->nodeValue);
//            foreach ($element->childNodes as $child) {
//                var_dump($child->nodeValue);
//            }
//            var_dump($element->childNodes->count());
            if ($element->childNodes->count() === 5) {
                $rowCrawler = new Crawler($element);
                $title = htmlspecialchars($rowCrawler->filterXPath('//span[@class="titleline"]/a')->text());
//                var_dump(htmlspecialchars($title));
                $url = $rowCrawler->filterXPath('//span[@class="titleline"]/a')->attr('href');
                echo "<a href=\"$url\">$title</a>";
                echo "</br>";
            }
            if ($element->childNodes->count() === 2) {
                $rowCrawler = new Crawler($element);
                $age = $rowCrawler->filterXPath('//span[@class="age"]')->attr('title');
//                dd($age);
//                var_dump(htmlspecialchars($title));
                $score = $rowCrawler->filterXPath('//span[@class="score"]')->text();
                echo "<span>($score) $age</span>";
                echo "</br>";
            }
            if ($element->childNodes->count() === 6) {
                break;
            }

////            dd($element->ownerDocument->saveHTML($element));

        }
        return 0;
    }
}
