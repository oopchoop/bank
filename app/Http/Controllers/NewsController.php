<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $months =
        [
            'янв.',
            'фев.',
            'мар.',
            'апр.',
            'мая',
            'июня',
            'июля',
            'авг.',
            'сент.',
            'окт.',
            'нояб.',
            'дек.',
        ];

    public function getNews()
    {
        $result = [];

        $response = News::query()
            ->orderByDesc('id')
            ->take(3)
            ->get()
            ->sort();

        foreach ($response as $key => $value)
        {
            $result[$key] = $value;

            $month = $value['date']->format('m');
            $currentMonth = $this->months[intval($month)];

            $result[$key]['date_str'] = $value['date']->format('d') .
                ' ' . $currentMonth .
                ' ' . $value['date']->format('Y');
        }

        return $result;
    }

    public function getNewsFromId($id)
    {
        $result = News::query()
            ->where('id', '=', $id)
            ->get();

        return $result[0];
    }
}
