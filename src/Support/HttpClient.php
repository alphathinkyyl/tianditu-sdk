<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 14:01:10
 * @LastEditors: dingtalk_kyfese xiaoyu@zsjq9.wecom.work
 * @LastEditTime: 2025-07-14 13:03:16
 * @FilePath: \tianditu-sdk\src\Support\HttpClient.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
namespace Alphathinkyyl\Tianditu\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Alphathinkyyl\Tianditu\Exceptions\TiandituException;


class HttpClient
{
    protected $client;
    protected $baseUrl = 'https://api.tianditu.gov.cn';
    public $apiKey;

    public function __construct(array $config)
    {
        $url=$config['base_url'];
        $apiKey = $config['api_key'] ?? '';
        $this->client = new Client(['base_uri' => $url]);
        $this->apiKey = $apiKey;
    }

    /**
     * @description: 
     * @param {string} $endpoint
     * @param {array} $query
     * @return {*}
     */    
    public function get(string $endpoint, array $query = [])
    {
        try {
            $query['tk'] = $this->apiKey;

            $response = $this->client->get($endpoint, ['query' => $query]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new TiandituException('返回数据解析失败：' . json_last_error_msg());
            }
            return $data;
        } catch (GuzzleException $e) {
            throw new TiandituException('网络请求失败：' . $e->getMessage(), $e->getCode(), $e);
        } catch (\Throwable $e) {
            throw new TiandituException('未知错误：' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
