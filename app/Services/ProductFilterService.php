<?php

namespace App\Services;

use App\Models\Product;

class ProductFilterService
{
    public function filter($parameters)
    {
        $query = Product::query();

        if (isset($parameters['priceSort'])) {
            $query = $this->applyPriceSort($query, $parameters['priceSort']);
        }

        if (isset($parameters['selectedCategories'])) {
            $query = $this->applyCategoryFilter($query, $parameters['selectedCategories']);
        }

        if (isset($parameters['selectedColors'])) {
            $query = $this->applyColorFilter($query, $parameters['selectedColors']);
        }

        return $query->get();
    }

    protected function applyPriceSort($query, $priceSort)
    {
        if ($priceSort === 'lower') {
            return $query->orderBy('price', 'asc');
        } elseif ($priceSort === 'higher') {
            return $query->orderBy('price', 'desc');
        }

        return $query;
    }

    protected function applyCategoryFilter($query, $categories)
    {
        return $query->whereIn('category_id', $categories);
    }

    protected function applyColorFilter($query, $colors)
    {
        return $query->where(function ($q) use ($colors) {
            foreach ($colors as $color) {
                $q->orWhere('color_id', $color);
            }
        });
    }
}
