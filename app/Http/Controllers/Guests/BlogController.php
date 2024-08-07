<?php

namespace App\Http\Controllers\Guests;

use Inertia\Inertia;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->appLogo = asset('/static/logo.svg');
        $this->appMail = config('constants.email');
        $this->appName = config('app.name');
        $this->tel = config('constants.telephone');
        $this->appAddress = config('constants.postAddress');
        $this->postalCode = config('constants.postalCode');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blog(Request $request)
    {
        //
        $search = $request->has('search');
        if($search){
            $articles = Article::published()->search($request->search)->get();
        }else{
            $articles = Article::query()->published()->eagerLoaded()->latest('id')->get();
            $articlesAside = Article::published()->latest('id')->eagerLoaded()->limit(10)->get();

            $title = 'Blog';
            $description = 'The web and mobile app development blog in Kenya';
            $keywords = 'Damiko Technologies Blog, blog, programming blog, web application blog, mobile application blog, web development blog, mobile apps development blog';
            $canonical_url = route('blog');
            $site_type = 'Website';
            $site_url = $canonical_url;
            $site_secure_url = $canonical_url;
            $site_name = config('app.name');
            $twitter_card = 'summary_large_image';
            $site_creator = config('constants.site_creator');

            $webSite = Schema::Organization()
                    ->name($this->appName)
                    ->headline($title)
                    ->description($description)
                    ->keywords($keywords)
                    ->email($this->appMail)
                    ->url($canonical_url)
                    ->contactPoint(Schema::ContactPoint()->telephone($this->tel)->areaServed('Worldwide'))
                    ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode($this->postalCode)->streetAddress($this->appAddress))
                    ->sameAS("https://www.damiko.com/blog")
                    ->logo(Schema::ImageObject()->url($this->appLogo));
            $bschema = $webSite->toArray();

            $data = [
                'articles' => fn() => $articles,
                'articlesAside' => fn() => $articlesAside,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'canonical_url' => $canonical_url,
                'site_type' => $site_type,
                'site_url' => $site_url,
                'site_secure_url' => $site_secure_url,
                'site_name' => $site_name,
                'twitter_card' => $twitter_card,
                'site_creator' => $site_creator,
                'bschema' => $bschema,
            ];

            return Inertia::render('Guests/Blog',$data);
        }    
    }
}
