<?php

namespace App\Http\Controllers\Guests;

use Str;
use Share;
use ShareButtons;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Services\TagService;
use Illuminate\Support\Arr;
use Esign\Breadcrumbs\Breadcrumb;
use Esign\Breadcrumbs\Facades\Breadcrumbs;

class FrontEndArticleController extends Controller
{
    protected $articleService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
        $this->appLogo = asset('/static/logo.svg');
        $this->appMail = 'damiko.co.org';
        $this->appName = config('app.name');
        $this->tel = '+254724351952';
        $this->robots = 'index, follow';
    }

    // Category Articles
    public function categoryArticles($slug,Request $request)
    { 
        $category = Category::whereSlug($slug)->eagerLoaded()->firstOrFail();
        $categoryArticles = $category->articles()->eagerLoaded()->published()->latest('id')->get();
        $asides = $category->articles()->latest('id')->published()->eagerLoaded()->limit(10)->get();
        $all = Article::published()->eagerLoaded();
        $articles = $all->inRandomOrder()->limit(10)->get();
        $articlesAside = $all->latest('id')->limit(10)->get();

        $sameAs = 'https://www.damiko.com/category/'.$category->slug;
        $site_creator = config('constants.site_creator');
        $site_type = 'Articles';
        $canonical_url = route('blog');

        $categorySchema = Schema::Article()
                ->articleSection($category->name)
                ->description($category->description)
                ->datePublished($category->created_at)
                ->dateModified($category->updated_at)
                ->email($this->appMail)
                ->url($category->absolute_url)
                ->sameAS('https://www.damiko.com/category/'.$category->slug)
                ->logo(Schema::ImageObject()->url($this->appLogo));

        $catSchemaOrg = $categorySchema->toArray();


        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Blog', route('blog')),
                                    Breadcrumb::create(ucwords($category->name." "."Articles")),
                                ]);
        $categoryJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        $data = [
            'category' => fn() => $category,
            'categoryArticles' => fn() => $categoryArticles,
            'sameAs' => $sameAs,
            'site_creator' => $site_creator,
            'site_type' => $site_type,
            'canonical_url' => $canonical_url,
            'robots' => $this->robots,
            'catSchemaOrg' =>$catSchemaOrg,
            'categoryJsonLdBreadcrumb' => $categoryJsonLdBreadcrumb,
        ];

        return Inertia::render('Guests/Category/Articles',$data);
    }
    
    public function articleDetails($slug,Request $request)
    {
        Article::where('slug',$slug)->published()->firstOrFail()->increment('total_views');
        $article = Article::where('slug',$slug)->published()->eagerLoaded()->firstOrFail();
        $all = Article::published()->eagerLoaded();
        $featuredArticles = $all->inRandomOrder()->whereNotIn('id',[$article->id])->limit('10')->get();
        $categoryArticles = $all->whereNotIn('id',[$article->id])->where('category_id',$article->category_id)->inRandomOrder()->get();
        $articlesAside = $all->whereNotIn('id',[$article->id])->latest('id')->limit(10)->get();
        $asides = $article->category->articles()->published()->whereNotIn('id',[$article->id])->inRandomOrder()->eagerLoaded()->limit(10)->get();
        $articleTags = $article->tags;
        $comments = $article->comments()->latest('id')->get();
        $tagsNames = $article->tags()->pluck('name');
        $tagsNamesArray = collect($tagsNames->toArray())->implode(',');

        $sameAs = "https://www.damiko.com/article/".$article->slug;
        $imageHeight = "628";
        $imageWidth = '1200';
        $site_type = 'Article';
        $canonical_url = route('blog');
        $site_name = config('app.name');
        $twitter_card = 'summary_large_image';
        $address = 'P.O Box 688, Bungoma, Kenya';
        $email = 'damikotech@gmail.com';
        $logo = asset('/static/logo.png');
        $tel = '0724351952';
        $postCode = '50200';

        $articleSchema = Schema::Article()
                ->headline($article->title)
                ->description($article->description)
                ->datePublished($article->created_at)
                ->dateModified($article->updated_at)
                ->image(Schema::ImageObject()->url($article->image_url)->width($imageWidth)->height($imageHeight))
                ->author(Schema::Person()->name($article->user->name)->url($article->user->absolute_url))
                ->publisher(Schema::Organization()->name($this->appName))
                ->email($this->appMail)
                ->url($article->absolute_url)
                ->sameAS('https://www.damiko.com/article/'.$article->slug)
                ->affiliate(Schema::Organization()->name($this->appName))
                ->logo(Schema::ImageObject()->url($this->appLogo));

        $artSchemaOrg =  $articleSchema->toArray();

        $shareComponent = ShareButtons::page('https://damiko.com', $article->title, [
                                                'title' => $article->title,
                                                'rel' => 'nofollow noopener noreferrer',
                                            ])  ->facebook()
                                                ->twitter()
                                                ->linkedin(['rel' => 'follow'])
                                                ->whatsapp()
                                                ->pinterest()
                                                ->reddit()
                                                ->telegram()
                                                ->render();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Blog', route('blog')),
                                    Breadcrumb::create(ucwords($article->category->name." "."Articles"), route('category.articles',['slug'=>$article->category->slug])),
                                    Breadcrumb::create(ucwords($article->title)),
                                ]);
        $articleJsonLdBreadcrumb = $breadcrumb->toJsonLd();


        $data = [
                'article' => fn() => $article,
                'featuredArticles' => fn() => $featuredArticles,
                'categoryArticles' => fn() => $categoryArticles,
                'articlesAside' => fn() => $articlesAside,
                'tagsNamesArray' => fn() => $tagsNamesArray,
                'comments' => fn() => $comments,
                'sameAs' => $sameAs,
                'imageHeight' => $imageHeight,
                'imageWidth' => $imageWidth,
                'site_type' => $site_type,
                'site_name' => $site_name,
                'canonical_url' => $canonical_url,
                'robots' => $this->robots,
                'twitter_card' => $twitter_card,
                'shareComponent' => $shareComponent,
                'artSchemaOrg' => $artSchemaOrg,
                'articleJsonLdBreadcrumb' => $articleJsonLdBreadcrumb,
            ];

        return Inertia::render('Guests/Article/Details',$data);
    }

    public function tagArticles($slug,Request $request)
    {
        $tag = Tag::whereSlug($slug)->eagerLoaded()->firstOrFail();
        $tagArticles = $tag->articles()->published()->eagerLoaded()->latest('id')->get();
        $asides = $tag->articles()->published()->latest('id')->eagerLoaded()->take(10)->get();
        $all = Article::published()->eagerLoaded();
        $articles = $all->inRandomOrder()->limit(10)->get();
        $articlesAside = $all->latest('id')->limit(10)->get();

        $sameAs = 'https://www.damiko.com/tag/'.$tag->slug;
        $site_creator = config('constants.site_creator');
        $site_type = 'Articles';
        $canonical_url = route('blog');

        $tagSchema = Schema::Article()
                ->headline($tag->name)
                ->description($tag->description)
                ->datePublished($tag->created_at)
                ->dateModified($tag->updated_at)
                ->email($this->appMail)
                ->url($tag->absolute_url)
                ->sameAS('https://www.damiko.com/tag/'.$tag->slug)
                ->logo(Schema::ImageObject()->url($this->appLogo));

        $tagSchemaOrg = $tagSchema->toArray();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Blog', route('blog')),
                                    Breadcrumb::create(ucwords($tag->name." "."Articles")),
                                ]);
        $tagJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        $data = [
                'articles' => fn() => $articles,
                'tag' => fn() => $tag,
                'tagArticles' => fn() => $tagArticles,
                'sameAs' => $sameAs,
                'site_creator' => $site_creator,
                'site_type' => $site_type,
                'canonical_url' => $canonical_url,
                'robots' => $this->robots,
                'tagSchemaOrg' => $tagSchemaOrg,
                'tagJsonLdBreadcrumb' => $tagJsonLdBreadcrumb,
            ];

        return Inertia::render('Guests/Tag/Articles',$data);
    }

    public function authorArticles($slug,Request $request)
    {
        $author = User::where('assigned_role','author')->whereSlug($slug)->eagerLoaded()->firstOrFail();
        $authorArticles = $author->articles()->published()->latest('id')->eagerLoaded()->get();
        $asides = $author->articles()->published()->latest('id')->eagerLoaded()->limit(10)->get();
        $categories = categories();
        $tags = Tag::eagerLoaded()->get();
        $all = Article::published()->eagerLoaded();
        $articles = $all->inRandomOrder()->limit(10)->get();
        $articlesAside = $all->latest('id')->limit(10)->get();

        $sameAs = 'https://www.damiko.com/author-articles/'.$author->slug;
        $site_creator = config('constants.site_creator');
        $site_type = 'Articles';
        $canonical_url = route('blog');

        $authorSchema = Schema::Person()
                ->name($author->name)
                ->image($author->image_url)
                ->logo(Schema::ImageObject()->url($this->appLogo))
                ->url($author->absolute_url)
                ->sameAS('https://www.damiko.com/article-author/'.$author->slug)
                ->datePublished($author->created_at)
                ->dateModified($author->updated_at)
                ->contactPoint([Schema::ContactPoint()->email($this->appMail)->phone($this->tel)->areaServed('worldwide')])
                ->affiliate(Schema::Organization()->name($this->appName)->email($this->appMail));

        $authorSchemaOrg =  $authorSchema->toArray();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Blog', route('blog')),
                                    Breadcrumb::create(ucwords($author->name." "."Articles")),
                                ]);
        $authorJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        $data = [
                'author' => fn() => $author,
                'authorArticles' => fn() => $authorArticles,
                'sameAs' => $sameAs,
                'site_creator' => $site_creator,
                'site_type' => $site_type,
                'canonical_url' => $canonical_url,
                'robots' => $this->robots,
                'authorSchemaOrg' => $authorSchemaOrg,
                'authorJsonLdBreadcrumb' => $authorJsonLdBreadcrumb,
            ];

        return Inertia::render('Guests/Author/Articles',$data);
    }
}
