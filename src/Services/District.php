<?php

namespace Alphathinkyyl\Tianditu\Services;

use Alphathinkyyl\Tianditu\Support\HttpClient;

class District
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * @description: 获取行政区划信息
     * @param {string} $searchWord 搜索关键字
     * @param {string} $childLevel 规则：设置显示下级行政区级数（行政区级别包括：国家、省/直辖市、市、区/县多级数据 可选值：0、1、2、3
     *0：不返回下级行政区
     *1：返回下一级行政区
     *2：返回下两级行政区
     *3：返回下三级行政区
     * @param {bool} $extensions 是否返回扩展信息
     * @return {*}
     */
    public function getDistricts(string $searchWord, string $childLevel = '0', bool $extensions = false)
    {
        return $this->http->get('/administrative', ['keyword' => $searchWord, 'childLevel' => $childLevel, 'extensions' => $extensions]);
    }
}
