<?php namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\News;
use App\ProductPrimer;
use App\ProductSfs;
use App\ProductSika;
use Illuminate\Http\Request;

class SearchController extends Controller {

    // Источники поиска (таблицы БД)
    private $sources = [
        'news',
        'products_sika',
        'products_primer',
        'products_sfs',
    ];

	/**
	 * Действие для поиска и отображения результатов.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
        // Если не задан поиск
        $q = trim($request->get('q'));
        if (!$q or strlen($q) < 3)
        {
            return view('marketing.search.index');
        }

        // Начинаем поиск
        // по новостям
        if (in_array('news', $this->sources))
        {
            $data['news'] = News::where('title', 'LIKE', "%{$q}%")
                ->orWhere('full_text', 'LIKE', "%{$q}%")
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        // По прудуктам Sika
        if (in_array('products_sika', $this->sources))
        {
            $data['products_sika'] = ProductSika::where('title', 'LIKE', "%{$q}%")
                ->orWhere('description', 'LIKE', "%{$q}%")
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        // По прудуктам Sfs
        if (in_array('products_sfs', $this->sources))
        {
            $data['products_sfs'] = ProductSfs::where('title', 'LIKE', "%{$q}%")
                ->with('category')
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        // По прудуктам Primer
        if (in_array('products_primer', $this->sources))
        {
            $data['products_primer'] = ProductPrimer::where('title', 'LIKE', "%{$q}%")
                ->orWhere('description_small', 'LIKE', "%{$q}%")
                ->orWhere('description_full', 'LIKE', "%{$q}%")
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        // Всего результатов
        $resCount = 0;
        foreach($data as $value)
        {
            $resCount += count($value);
        }
        $data['res_count'] = $resCount;

        return view('marketing.search.index', $data);
	}

}
