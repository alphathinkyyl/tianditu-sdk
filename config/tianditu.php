<?php
/*
 * @Author: yuyanli 603447409@qq.com
 * @Date: 2025-07-10 11:50:57
 * @LastEditors: yuyanli 603447409@qq.com
 * @LastEditTime: 2025-07-10 11:51:11
 * @FilePath: \tianditu-sdk\config\tianditu.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
return [
    'api_key' => env('TIANDITU_API_KEY', ''),
    'base_url' => env('TIANDITU_BASE_URL', 'https://api.tianditu.gov.cn'),
];