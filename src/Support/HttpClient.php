<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-09 14:01:10
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-09 16:00:27
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

    public function __construct(string $apiKey)
    {
        $this->client = new Client(['base_uri' => $this->baseUrl]);
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

            // 根据天地图返回结构判断是否出错（可自定义）
            if (isset($data['status']) && $data['status'] != 0) {
                $msg = $data['msg'] ?? '天地图接口返回错误';
                throw new TiandituException("天地图返回错误：{$msg}");
            }

            return $data;

        } catch (GuzzleException $e) {
            throw new TiandituException('网络请求失败：' . $e->getMessage(), $e->getCode(), $e);
        } catch (\Throwable $e) {
            throw new TiandituException('未知错误：' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
