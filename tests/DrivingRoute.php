<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:37:04
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:40:45
 * @FilePath: \tianditu-sdk\tests\DrivingRoute.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
namespace Alphathinkyyl\Tianditu\Tests;
use Alphathinkyyl\Tianditu\Exceptions\TiandituException;

class DrivingRouteTest extends TestCase
{
    public function testDrivingRoute()
    {
        $data = $this->sdk->drivingRoute()->route('116.403874,39.914888', '116.407526,39.915085');
        $this->assertIsArray($data);
    }

    public function testDrivingWithWaypoints()
    {
        $data = $this->sdk->drivingRoute()->route(
            '116.403874,39.914888',
            '116.407526,39.915085',
            ['116.405000,39.915000', '116.406000,39.916000']
        );
        $this->assertIsArray($data);
    }

    public function testDrivingWithWaypointsInvalidCoords()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->drivingRoute()->route('invalid,coords', '116.407526,39.915085',['999,999']);
    }

    public function testExceptionForInvalidCoords()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->drivingRoute()->getRoute('999,999', '999,999');
    }
}