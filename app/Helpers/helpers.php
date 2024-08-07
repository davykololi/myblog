<?php

use App\Models\Category;
use App\Models\Article;

function categories()
{
	return Category::eagerLoaded()->latest('id')->limit(10)->get();
}

function footer_categories()
{
	return Category::eagerLoaded()->get();
}

function sidebar_articles()
{
   return Article::with('category','user')->latest('id')->limit(50)->get();
}

function addWwwToUrl($url) {

   $bits = parse_url($url);

   $newHost = substr($bits["host"],0,4) !== "www." ? "www." . $bits["host"] : $bits["host"];

   $newUrl = $bits["scheme"]. "://" . $newHost . (isset($bits["port"]) ? ":" . $bits["port"] : "" ) . (isset($bits["path"]) ? $bits["path"] : "" ) . (!empty($bits["query"])? "?" . $bits["query"]: "");

   return $newUrl;
}
