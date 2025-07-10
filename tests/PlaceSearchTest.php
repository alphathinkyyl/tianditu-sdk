<?php 
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:28:13
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:30:01
 * @FilePath: \tianditu-sdk\tests\PlaceSearchTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
namespace Alphathinkyyl\Tianditu\Tests;

use Alphathinkyyl\Tianditu\Exceptions\TiandituException;
use Alphathinkyyl\Tianditu\TiandituService;

class PlaceSearchTest extends TestCase
{
    public function testNormalSearch()
    {
        $data = $this->sdk->place()->searchNormal('天安门');
        $this->assertIsArray($data);
        $this->assertArrayHasKey('pois', $data);
    }

    public function testSearchByDistrict()
    {
        $data = $this->sdk->place()->searchByDistrict('东城区');
        $this->assertIsArray($data);
    }

    public function testSearchNearby()
    {
        $data = $this->sdk->place()->searchNearby('116.403874,39.914888', 1000);
        $this->assertIsArray($data);
    }

    public function testExceptionForInvalidKey()
    {
        $this->expectException(TiandituException::class);
        $sdk = new TiandituService('INVALID_KEY');
        $sdk->place()->searchNormal('测试');
    }
}
