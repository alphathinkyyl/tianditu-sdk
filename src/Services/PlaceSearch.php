<?php

/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 14:01:10
 * @LastEditors: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @LastEditTime: 2025-07-11 16:37:46
 * @FilePath: Alphathinkyyl\Tianditu\Services\PlaceSearch.php
 * @Description: 地名搜索V2.0
 */
namespace Alphathinkyyl\Tianditu\Services;

use Alphathinkyyl\Tianditu\Support\HttpClient;

class PlaceSearch
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 普通搜索服务  http://lbs.tianditu.gov.cn/server/search2.html
     * @param {string} $keyword 搜索的关键字
     * @param {string} $level 目前查询的级别
     * @param {string} $dataTypes 数据分类（分类编码表）
     * @param {string} $show 返回poi结果信息类别 
     * @param {string} $mapBound查询的地图范围(“minx,miny,maxx,maxy”)	
     * @param {int} $page 返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchNormal(string $keyword, string $level = '1', string $dataTypes = '', string $show = '1', string $mapBound = "-180,-90,180,90", int $page = 1, int $count = 10)
    {
        return $this->searchBase([
            'keyWord' => $keyword,
            'queryType' => 1,
            'start' => $page,
            'count' => $count,
            'mapBound' => $mapBound,
            'level' => $level,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 行政区划区域搜索服务 http://lbs.tianditu.gov.cn/server/search2.html
     * @param {string} $keyword 搜索的关键字
     * @param {string} $specify 指定行政区的国标码（行政区划编码表）严格按照行政区划编码表中的（名称，gb码）
     * @param {string} $dataTypes 数据分类（分类编码表）
     * @param {string} $show 返回poi结果信息类别
     * @param {int} $page 返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchByDistrict(string $keyword, string $specify, string $dataTypes = '', string $show = '1', int $page = 1, int $count=10)
    {
        return $this->searchBase([
            'keyWord' => $keyword,
            'queryType' => 12,
            'specify' => $specify,
            'start' => $page,
            'count' => $count,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 视野内搜索
     * @param {string} $keyword 搜索的关键字
     * @param {string} $bounds  查询的地图范围(“minx,miny,maxx,maxy”)
     * @param {string} $level 目前查询的级别
     * @param {string} $dataTypes 数据分类（分类编码表）
     * @param {string} $show   返回poi结果信息类别
     * @param {int} $page   返回结果起始位（用于分页和缓存）默认0
     * @param {*} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchInViewBounds(string $keyword, string $bounds, string $level = '12', string $dataTypes = '', string $show = '1', int $page = 1, $count = 10)
    {
        return $this->searchBase([
            'keyWord' => $keyword,
            'queryType' => 2,
            'mapBound' => $bounds,
            'start' => $page,
            'count' => $count,
            'level' => $level,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 周边搜索 
     * @param {string} $keyword 搜索的关键字
     * @param {string} $queryRadius 查询半径（单位：米）
     * @param {string} $pointLonlat 查询中心点经纬度（格式：经度,纬度）
     * @param {string} $dataTypes   数据分类（分类编码表）
     * @param {string} $show    返回poi结果信息类别
     * @param {int} $page   返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchNearby(string $keyword, string $queryRadius, string $pointLonlat, string $dataTypes = '', string $show = '1', int $page = 1, int $count = 10)
    {
        return $this->searchBase([
            'keyWord' => $keyword,
            'queryRadius' => $queryRadius,
            'queryType' => 3,
            'pointLonlat' => $pointLonlat,
            'start' => $page,
            'count' => $count,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 多边形搜索
     * @param {string} $keyword 搜索的关键字
     * @param {array} $coordinates 多边形坐标数组（格式：[[经度1,纬度1],[经度2,纬度2],...]）
     * @param {string} $dataTypes 数据分类（分类编码表）
     * @param {string} $show 返回poi结果信息类别
     * @param {int} $page 返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchByPolygon($keyword, array $coordinates, string $dataTypes = '', string $show = '1', int $page = 1, int $count = 10)
    {
        $polygon = implode(',', $coordinates);
        return $this->searchBase([
            'keyWord' => $keyword,
            'queryType' => 10,
            'mapBound' => $polygon,
            'start' => $page,
            'count' => $count,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }


    /**
     * @description: 数据分类搜索
     * @param {string} $specify 指定数据分类（分类编码表）
     * @param {string} $mapBound 查询的地图范围(“minx,miny,maxx,maxy”)
     * @param {string} $dataTypes 数据分类（分类编码表）
     * @param {string} $show 返回poi结果信息类别
     * @param {int} $page 返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchByCategory(string $specify, string $mapBound, $dataTypes = '', string $show = '1', int $page = 1, int $count = 10)
    {
        return $this->searchBase([
            'queryType' => 13,
            'specify' => $specify,
            'mapBound' => $mapBound,
            'start' => $page,
            'count' => $count,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 统计搜索服务
     * @param {string} $keyword 搜索的关键字
     * @param {string} $specify 指定数据分类（分类编码表）
     * @param {*} $dataTypes 数据分类（分类编码表）
     * @param {string} $show 返回poi结果信息类别
     * @param {int} $page 返回结果起始位（用于分页和缓存）默认0
     * @param {int} $count 返回的结果数量（用于分页和缓存）
     * @return {*}
     */
    public function searchStats(string $keyword, string $specify, $dataTypes = '', string $show = '1', int $page = 1, int $count = 10)
    {
        return $this->searchBase([
            'keyWord' => $keyword,
            'specify' => $specify,
            'queryType' => 14,
            'start' => $page,
            'count' => 10,
            'dataTypes' => $dataTypes,
            'show' => $show
        ]);
    }

    /**
     * @description: 基础搜索请求
     * @param {array} $params 请求参数
     * @return {*}
     */
    protected function searchBase(array $params)
    {
        return $this->http->get('/v2/search', [
            'postStr' => json_encode($params, JSON_UNESCAPED_UNICODE),
            'type' => 'query'
        ]);
    }
}
