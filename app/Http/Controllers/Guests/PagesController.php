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
    }

    public function welcome()
    {
        $title = 'Home';
        $description = "Damiko Technologies, the hub of modern programming technologies that include Laravel, Python Framework, React Js, Vue Js, Bootstrap, Tailwind Css, Flutter, Html";
        $keywords = "programming company, Larave, Python, React Js, Vue Js, Bootstrap, Tailwind Css, Flutter, Html";
        $canonical_url = route('home');
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

        return Inertia::render('Guests/Welcome', compact('title','description','keywords','canonical_url','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','homeSchemaOrg'));
    }

    public function about()
    {
        $title = 'About Us';
        $description = config('app.name')." "."Is a web and mobile apps development company based in Nairobi, Kenya";
        $keywords = "Damiko, Damiko Technologies,Web and Mobile App Development Company, Web Development, Mobile App Development, Website Development";
        $canonical_url = route('about.us');
        $site_type = 'AboutPage';
        $site_url = route('about.us');
        $site_secure_url = route('about.us');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');

        $about = Schema::Organization()
                ->name($title)
                ->description($description)
                ->url($canonical_url)
                ->logo($this->appLogo)
                ->sameAS("https://www.damiko.com/about-us")
                ->contactPoint([Schema::ContactPoint()
                ->telephone($this->tel)
                ->email($this->appMail)]);
        $aboutSchemaOrg = $about->toArray();

        return Inertia::render('Guests/About', compact('title','description','keywords','canonical_url','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','aboutSchemaOrg'));
    }

    public function contact()
    {
        $title = 'Contact Us';
        $description = 'Damiko Web And Mobile Apps Development Company Contact Page';
        $keywords = "Contact Us, Contact Damiko Company,Contact Damiko Organization, Contact Pace, Contacts";
        $canonical_url = route('contact.us');
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

        return Inertia::render('Guests/Contact', compact('title','description','keywords','canonical_url','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','contactSchemaOrg'));
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
        $title = 'Private Policy Statement';
        $description = "Damiko Web And Mobile Apps Development Company Private Policy Statement";
        $keywords = "Private Policy Statement, Policy Statement, Private Policy, Statement";
        $canonical_url = route('private.policy');
        $site_type = 'PolicyPage';
        $site_url = route('private.policy');
        $site_secure_url = route('private.policy');
        $site_name = config('app.name');
        $twitter_card = "summary_large_image";
        $site_creator = config('constants.site_creator');

        $policy = Schema::Organization()
                ->name($title)
                ->description($description)
                ->url($canonical_url)
                ->logo($this->appLogo)
                ->sameAS("https://www.damiko.com/private-policy")
                ->contactPoint([Schema::ContactPoint()
                ->telephone($this->tel)
                ->email($this->appMail)]);
        $policySchemaOrg = $policy->toArray();

        return Inertia::render('Guests/Policy', compact('title','description','keywords','canonical_url','site_type','site_url','site_secure_url','site_name','twitter_card','site_creator','policySchemaOrg'));
    }
}
