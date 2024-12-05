<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';

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
        $homeUrl = URL::create('/')->setLastModificationDate(Carbon::yesterday())->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY);
        $contactUrl = URL::create('/contact-us')->setLastModificationDate(Carbon::yesterday())->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);
        $aboutUrl = URL::create('/about-us')->setLastModificationDate(Carbon::yesterday())->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);
        $policyUrl = URL::create('/privacy-policy')->setLastModificationDate(Carbon::yesterday())->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY);
        $blogUrl = URL::create('/blog')->setLastModificationDate(Carbon::yesterday())->setPriority(0.1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS);

        $sitemap = Sitemap::create()
            ->add($homeUrl)
            ->add($contactUrl)
            ->add($aboutUrl)
            ->add($blogUrl)
            ->add($policyUrl);

        $categories = Category::all();
        foreach($categories as $category){
            $categoryUrl = Url::create($category->absolute_url)->setLastModificationDate(Carbon::create($category->updated_at));
            $sitemap->add($categoryUrl);
        }

        $articles = Article::published()->get();
        foreach($articles as $article){
            $articleUrl = Url::create($article->absolute_url)->setLastModificationDate(Carbon::create($article->updated_at));
            $sitemap->add($articleUrl);
        }

        $tags = Tag::all();
        foreach($tags as $tag){
            $sitemap->add(Url::create($tag->absolute_url)->setLastModificationDate($tag->updated_at)->setPriority(0.9));
        }

        $authors = User::where('assigned_role','author')->get();
        foreach($authors as $author){
            $sitemap->add(Url::create($author->absolute_url)->setLastModificationDate($author->updated_at)->setPriority(0.9));
        }
        
        $sitemap->writeToFile(public_path('sitemap.xml'));      
    }
}
