<?php

namespace App\Http\Controllers\Guests;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Contact;
use Spatie\SchemaOrg\Schema;
use Illuminate\Support\Facades\URL;
use App\Jobs\SendContactJob;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Esign\Breadcrumbs\Breadcrumb;
use Esign\Breadcrumbs\Facades\Breadcrumbs;

class PagesController extends Controller
{
    protected $appLogo,$appMail,$appName,$tel,$appAddress;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->appLogo = URL::secureAsset('/static/logo.png');
        $this->appMail = config('constants.email');
        $this->appName = config('app.name');
        $this->tel = config('constants.telephone');
        $this->appAddress = config('constants.postAddress');
        $this->robots = 'index, follow';
    }

    public function welcome()
    {
        $title = 'Damiko Technologies';
        $description = "Damiko Technologies, the hub of modern programming technologies that include Laravel, Python Framework, React Js, Vue Js, Bootstrap, Tailwind Css, Flutter, Html";
        $keywords = "programming company, Larave, Python, React Js, Vue Js, Bootstrap, Tailwind Css, Flutter, Html";
        $canonical_url = route('home');
        $robots = $this->robots;
        $site_type = 'Organization';
        $site_url = route('home');
        $site_secure_url = route('home');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');

        $webSite = Schema::Organization()
                    ->name($this->appName)
                    ->headline($title)
                    ->description($description)
                    ->keywords($keywords)
                    ->email($this->appMail)
                    ->url($canonical_url)
                    ->contactPoint(Schema::ContactPoint()->telephone($this->tel)->areaServed('Worldwide'))
                    ->address(Schema::PostalAddress()->addressCountry('Kenya')->postalCode('254')->streetAddress('688'))
                    ->sameAS("https://www.damiko.com")
                    ->logo(Schema::ImageObject()->url($this->appLogo));
                
        $homeSchemaOrg = $webSite->toArray();

        $breadcrumb = Breadcrumbs::add('Home', route('home'));
        $homeJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        return Inertia::render('Guests/Home', compact('title','description','keywords','canonical_url','robots','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','homeSchemaOrg','homeJsonLdBreadcrumb'));
    }

    public function about()
    {
        $title = 'About Us';
        $description = config('app.name')." "."Is a web and mobile apps development company based in Nairobi, Kenya";
        $keywords = "Damiko, Damiko Technologies,Web and Mobile App Development Company, Web Development, Mobile App Development, Website Development";
        $canonical_url = route('about.us');
        $robots = $this->robots;
        $site_type = 'AboutPage';
        $site_url = route('about.us');
        $site_secure_url = route('about.us');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');

        $about = Schema::AboutPage()
                ->name($title)
                ->description($description)
                ->url($canonical_url)
                ->logo($this->appLogo)
                ->sameAS("https://www.damiko.com/about-us")
                ->contactPoint([Schema::ContactPoint()
                ->telephone($this->tel)
                ->email($this->appMail)]);
        $aboutSchemaOrg = $about->toArray();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('About Us'),
                                ]);
        $aboutJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        return Inertia::render('Guests/About', compact('title','description','keywords','canonical_url','robots','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','aboutSchemaOrg','aboutJsonLdBreadcrumb'));
    }

    public function contact()
    {
        $title = 'Contact Us';
        $description = 'Damiko Web And Mobile Apps Development Company Social Media Links, Contact Details and Contact Form';
        $keywords = "Contact Details, Contact Information,Organization Contacts, Company Contacts";
        $canonical_url = route('contact.us');
        $robots = $this->robots;
        $site_type = 'ContactPage';
        $site_url = route('contact.us');
        $site_secure_url = route('contact.us');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');
        $postCode = '50200';

        $contact = Schema::ContactPage()
                ->name($title)
                ->description($description)
                ->url($canonical_url)
                ->logo($this->appLogo)
                ->sameAS("https://www.damiko.com/contact-us")
                ->contactPoint([Schema::ContactPoint()
                ->telephone($this->tel)
                ->email($this->appMail)]);
        $contactSchemaOrg = $contact->toArray();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Contact Us'),
                                ]);
        $contactJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        return Inertia::render('Guests/Contact', compact('title','description','keywords','canonical_url','robots','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','contactSchemaOrg','contactJsonLdBreadcrumb'));
    }

    public function contactStore(ContactFormRequest $request)
    {
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        // Mail Delivery logic goes here
        SendContactJob::dispatch($contact)->delay(Carbon::now()->addMinutes(2));

        return redirect()->back()->with('message','Thank you for contacting us. We value your concerns');
        //  return redirect()->route('contact.create');
    }

    public function policy()
    {
        $title = 'Privacy Policy Statement';
        $description = "Damiko Web And Mobile Apps Development Company Privacy Policy Statement";
        $keywords = "Privacy Policy Statement, Policy Statement, Privacy Policy, Damiko Privacy Policy Statement";
        $canonical_url = route('privacy.policy');
        $robots = $this->robots;
        $site_type = 'PolicyPage';
        $site_url = route('privacy.policy');
        $site_secure_url = route('privacy.policy');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');

        $policy = Schema::WebPage()
                ->name($title)
                ->description($description)
                ->url($canonical_url)
                ->logo($this->appLogo)
                ->sameAS("https://www.damiko.com/privacy-policy")
                ->contactPoint([Schema::ContactPoint()
                ->telephone($this->tel)
                ->email($this->appMail)]);
        $policySchemaOrg = $policy->toArray();

        $breadcrumb = Breadcrumbs::add([
                                    Breadcrumb::create('Home', route('home')),
                                    Breadcrumb::create('Privacy Policy Statement'),
                                ]);
        $policyJsonLdBreadcrumb = $breadcrumb->toJsonLd();

        return Inertia::render('Guests/Policy', compact('title','description','keywords','canonical_url','robots','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','policySchemaOrg','policyJsonLdBreadcrumb'));
    }
}
