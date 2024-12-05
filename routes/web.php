<?php

use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\AuthorUserController;
use App\Http\Controllers\Admin\EditorUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Author\AuthorArticleController;
use App\Http\Controllers\Editor\EditorArticleController;
use App\Http\Controllers\Guests\PagesController;
use App\Http\Controllers\Guests\BlogController;
use App\Http\Controllers\Guests\CommentController;
use App\Http\Controllers\Guests\FrontEndArticleController;
use App\Http\Controllers\Guests\NewsLetterController;


Route::controller(PagesController::class)->group(function(){
   Route::get('/', 'welcome')->name('home')->breadcrumb('Home');
   Route::get('/about-us', 'about')->name('about.us')->breadcrumb('About Us', 'home'); 
   Route::get('/contact-us', 'contact')->name('contact.us')->breadcrumb('Contact Us', 'home');
   Route::post('/contact-us', 'contactStore')->name('contact.store');
   Route::get('/privacy-policy', 'policy')->name('privacy.policy')->breadcrumb('Privacy Policy Statement', 'home');
});

Route::controller(CommentController::class)->group(function(){
   Route::get('/comment-form', 'articleCommentForm');
   Route::post('/comment', 'articleComment')->name('save.comment'); 
});

Route::get('/blog', [BlogController::class, 'blog'])->name('blog')->breadcrumb('Blog', 'home');

Route::controller(FrontEndArticleController::class)->group(function(){
    Route::get('/category/{slug}/', 'categoryArticles')->name('category.articles')->breadcrumb(fn($category) => $category, 'blog');
    Route::get('/article/{slug}/', 'articleDetails')->name('article.details')->breadcrumb(fn($article) => ucwords($article), 'blog');
    Route::get('/tag/{slug}/', 'tagArticles')->name('tag.articles')->breadcrumb(fn($tag) => $tag, 'blog');
    Route::get('/article-author/{slug}/', 'authorArticles')->name('author.articles')->breadcrumb(fn($author) => ucwords($author), 'blog');
});

//Newsletter route
Route::post('/newsletter/store', [NewsLetterController::class, 'store'])->name('newsletter.store');

//Authorization route
Route::middleware('auth')->group(function () {
    Route::get('/authorization', [AuthorizationController::class, 'authourize'])->name('authorization');
});


Route::group(['middleware'=>'prevent-back-history'],function(){ // Start of prevent-back-history middleware

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified','role:visitor','visitor'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth','role:admin','admin'])->name('admin.')->group(function(){
    Route::inertia('/dashboard', 'Admin')->name('dashboard');
    Route::resource('/authors',AuthorUserController::class);
    Route::resource('/editors',EditorUserController::class);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/tags',TagController::class);
    Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');
    Route::get('/delete-contacts/{id}', [ContactController::class, 'deleteContacts'])->name('contacts.delete');

    Route::get('/comments', [AdminCommentController::class, 'comments'])->name('comments');
    Route::get('/delete-comments/{id}', [AdminCommentController::class, 'deleteComments'])->name('comments.delete');
});

// Author Routes
Route::prefix('author')->middleware(['auth','role:author','author'])->name('author.')->group(function(){
    Route::inertia('/dashboard', 'Author')->name('dashboard');
    Route::resource('/articles',AuthorArticleController::class);
});

// Editor Routes
Route::prefix('editor')->middleware(['auth','role:editor','editor'])->name('editor.')->group(function(){
    Route::inertia('/dashboard', 'Editor')->name('dashboard');
    Route::resource('/articles',EditorArticleController::class);
});

}); // End of prevent-back-history middleware

Route::feeds();

require __DIR__.'/auth.php';
