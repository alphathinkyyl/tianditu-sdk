<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:33:30
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:36:45
 * @FilePath: \tianditu-sdk\tests\DistrictTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
namespace Alphathinkyyl\Tianditu\Tests;
use Alphathinkyyl\Tianditu\Exceptions\TiandituException;
use Alphathinkyyl\Tianditu\TiandituService;

class DistrictTest extends TestCase
{
    public function testGetDistrictByName()
    {
        $data = $this->sdk->district()->getDistricts('北京市');
        $this->assertIsArray($data);
    }


    public function testExceptionForInvalidDistrict()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->district()->getDistricts('无效地区');
    }
}
