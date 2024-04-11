<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetHNFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:fromapi {type=best}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data from Hacker News website by using official api';

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
        $type = $this->argument('type');
        switch ($type) {
            case 'top':
                $url = 'https://hacker-news.firebaseio.com/v0/topstories.json';
                break;
            case 'new':
                $url = 'https://hacker-news.firebaseio.com/v0/newstories.json';
                break;
            default:
                $url = 'https://hacker-news.firebaseio.com/v0/beststories.json';
                break;
        }

        $json = file_get_contents($url);
        $data = json_decode($json, true);

        foreach ($data as $row) {
            try {
                $link = Link::withTrashed()->findOrFail($row);

                if ($link->trashed() === false) {
                    $scoreBefore = $link->points;
                    $this->updateLink($link);
                    $test = $link->points - $scoreBefore;
                    if ($test > 0) {
                        echo $link->title . "\n";
                        echo "score changed by: " . ($test) . "\n";
                    }

                }
            } catch (ModelNotFoundException $e) {
                $story = $this->makeModel($this->getStory($row));
                $story->save();
                echo "New article: $story->title\n";
            }
            usleep(30000);
        }
        return 0;
    }

    private function updateLink(Link $link)
    {
        $params = $this->getStory($link->article_id);
        if (!isset($params['url'])) {
            $params['url'] = 'https://news.ycombinator.com/item?id=' . $link['id'];
        }
        $link->update([
            'points' => $params['score'],
            'title' => $params['title'],
            'url' => $params['url']]);

    }

    private function getStory(string $story): array
    {
        $storyUrl = file_get_contents("https://hacker-news.firebaseio.com/v0/item/$story.json");
        return json_decode($storyUrl, true);
    }

    private function makeModel(array $storyData): Link
    {
        if (!isset($storyData['url'])) {
            $storyData['url'] = 'https://news.ycombinator.com/item?id=' . $storyData['id'];
        }
        $story = new Link();
        $story->article_id = $storyData['id'];
        $story->title = $storyData['title'];
        $story->url = $storyData['url'];
        $story->points = $storyData['score'];
        $story->date = $storyData['time'];
        return $story;
    }
}
