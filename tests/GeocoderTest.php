<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:31:16
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:33:13
 * @FilePath: \tianditu-sdk\tests\GeocoderTest.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
namespace Alphathinkyyl\Tianditu\Tests; 

use Alphathinkyyl\Tianditu\Exceptions\TiandituException;


class GeocoderTest extends TestCase
{
    public function testGeocode()
    {
        $data = $this->sdk->geocoder()->geocode('北京市朝阳区');
        $this->assertIsArray($data);
    }

    public function testReverseGeocode()
    {
        $data = $this->sdk->geocoder()->reverse('116.403874', '39.914888');
        $this->assertIsArray($data);
    }

    public function testReverseGeocodeWithInvalidCoords()
    {
        $this->expectException(TiandituException::class);
        $this->sdk->geocoder()->reverse('999', '999');
    }
}
