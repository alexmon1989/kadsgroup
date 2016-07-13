<?php

namespace App\Http\Controllers\Marketing;

use App\Certificate;
use App\Gallery;
use App\GroupsCategory;
use App\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Отображает карту сайта в нужном формате формате.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($format = 'xml', $cached = true)
    {
        // Проверка формата вывода данных
        if (!in_array($format, ['xml', 'html', 'txt', 'ror-rss', 'ror-rdf'])){
            abort(404);
        }

        // Объект карты сайта
        $sitemap = App::make('sitemap');

        // Кэш карты сайта
        $sitemap->setCache('laravel.sitemap', 3600, (bool) $cached);

        // Проверка закеширована ли карта сайта, если нет - "строим" заново
        if (!$sitemap->isCached())
        {
            // Добавление страниц с постоянными ссылками
            $sitemap->add(URL::to('/'));

            $sitemap->add(URL::to('companies/sika/about'));
            $sitemap->add(URL::to('companies/sika/catalog'));

            $sitemap->add(URL::to('companies/sfs/about'));
            $sitemap->add(URL::to('companies/sfs/catalog'));
            //$sitemap->add(URL::to('companies/sfs/videos'));

            $sitemap->add(URL::to('companies/primer/about'));
            $sitemap->add(URL::to('companies/primer/catalog'));
            //$sitemap->add(URL::to('companies/primer/videos'));
            $sitemap->add(URL::to('companies/primer/price-list'));

            // Добавление страниц групп категорий и категорий всех трёх компаний
            foreach(['sika', 'sfs', 'primer'] as $company) {
                $groupCategories = GroupsCategory::whereEnabled(TRUE)
                    ->with(['categories' => function ($q) {
                        $f = function($q) {
                            $q->whereEnabled(TRUE);
                        };
                        $q->whereEnabled(TRUE)
                          ->with(['products_sika' => $f,
                              'products_sfs' => $f,
                              'products_primer' => $f]);
                    }])
                    ->whereHas('company', function($q) use ($company) {
                        $q->whereShortTitle($company);
                    })
                    ->get();

                // Проходим по группам категорий
                foreach($groupCategories as $groupCategory) {
                    // Добавление группы категорий
                    $sitemap->add(URL::to("companies/{$company}/catalog/group/{$groupCategory->id}"));

                    // Добавление категории
                    foreach($groupCategory->categories as $category) {
                        $sitemap->add(URL::to("companies/{$company}/catalog/category/{$category->id}"));

                        // Добавление товаров для каждой категории
                        foreach($category->products_sika as $productSika) {
                            // Ссылка на страницу продукта
                            $sitemap->add(URL::to("companies/{$company}/catalog/show/{$productSika->id}"));

                            // Ссылка на техкарту
                            //$sitemap->add(URL::to("assets/img/products/{$company}/tech-carts/{$productSika->tech_cart_file}"));
                        }
                        foreach($category->products_sfs as $productSfs) {
                            // Ссылка на страницу продукта
                            $sitemap->add(URL::to("companies/{$company}/catalog/show/{$productSfs->id}"));

                            // Ссылка на pdf
                            //$sitemap->add(URL::to("assets/img/products/{$company}/pdf/{$productSfs->file_name}"));
                        }
                        foreach($category->products_primer as $productPrimer) {
                            $sitemap->add(URL::to("companies/{$company}/catalog/show/{$productPrimer->id}"));
                        }
                    }
                }

                // Галереи
                /*$galleryImages = Gallery::whereHas('company', function ($query) use ($company) {
                    $query->whereShortTitle($company);
                })->get();
                $images = []; // Массив описаний изображений для Sitemap
                foreach($galleryImages as $image) {
                    $images[] = [
                        'url' => URL::to('assets/img/galleries/'.$image->file_name),
                        'title' => $image->title,
                    ];
                }
                $sitemap->add(URL::to("galleries/show/{$company}"), null, null, null, $images);*/
            }

            /*$certificates = Certificate::all();
            $imagesCertificates = []; // Массив описаний изображений для сертификатов
            foreach($certificates as $certificate) {
                $imagesCertificates[] = [
                    'url' => URL::to('assets/img/certificates/'.$certificate->file_name),
                    'title' => $certificate->title,
                ];
            }
            $sitemap->add(URL::to('certificates'), null, null, null, $imagesCertificates);*/

            $sitemap->add(URL::to('news'));
            // Добавляем все статьи новостей
            $news = News::all();
            foreach($news as $item) {
                $sitemap->add(URL::to('news/show/'.$item->id));
            }

            $sitemap->add(URL::to('contacts'));
        }

        // Отображение карты сайта
        return $sitemap->render($format);
    }
}
