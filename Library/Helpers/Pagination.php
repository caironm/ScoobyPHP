<?php

namespace Helpers;

use Core\Model;
use JasonGrimes\Paginator;

class Pagination
{
    /**
     * Cria Paginação de dados vindos do banco
     *
     * @param Model $model
     * @param integer $limit
     * @param string $urlPattern
     * @return array
     */
    public static function paginate(Model $model, int $limit, string $urlPattern): array
    {
        $currentPage = 1;
        if (!empty($_GET['page'])) {
            $currentPage = $_GET['page'];
        }
        $offset = ($currentPage * $limit) - $limit;
        $urlPattern = '/Paginator/blog?page=(:num)';
        $totalItems = $model::count();
        $info = $model->skip($offset)->take($limit)->get();
        $paginator = new Paginator($totalItems, $limit, $currentPage, $urlPattern);
        return ['data' => $info, 'pages' => $paginator];
    }
}
