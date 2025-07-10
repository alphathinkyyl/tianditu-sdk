<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 13:48:49
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-09 17:01:17
 * @FilePath: \tianditu-sdk\src\TiandituService.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Alphathinkyyl\Tianditu;

use Alphathinkyyl\Tianditu\Support\HttpClient;
use Alphathinkyyl\Tianditu\Services\Geocoder;
use Alphathinkyyl\Tianditu\Services\PlaceSearch;
use Alphathinkyyl\Tianditu\Services\TransitRoute;
use Alphathinkyyl\Tianditu\Services\DrivingRoute;
use Alphathinkyyl\Tianditu\Services\StaticMap;
use Alphathinkyyl\Tianditu\Services\District;

class TiandituService
{
    protected $http;

    public function __construct(string $apiKey)
    {
        $this->http = new HttpClient($apiKey);
    }

    /**
     * @description: 获取地理编码服务
     * @return Geocoder
     */
    public function geocoder(): Geocoder
    {
        return new Geocoder($this->http);
    }

    /**
     * @description: 获取地名搜索服务
     * @return PlaceSearch
     */
    public function place(): PlaceSearch
    {
        return new PlaceSearch($this->http);
    }

    /**
     * @description: 获取公交规划服务
     * @return TransitRoute
     */
    public function transit(): TransitRoute
    {
        return new TransitRoute($this->http);
    }

    /**
     * @description: 获取驾车规划服务
     * @return DrivingRoute
     */
    public function drive(): DrivingRoute
    {
        return new DrivingRoute($this->http);
    }

    /**
     * @description: 获取静态地图服务
     * @return StaticMap
     */ 
    public function staticMap(): StaticMap
    {
        return new StaticMap($this->http);
    }

    /**
     * @description: 获取行政区划服务
     * @return District
     */ 
    public function district(): District
    {
        return new District($this->http);
    }
}
