<?php
// 1. 使用composer 自动加载器
require_once __DIR__.'/vendor/autoload.php';

// 2. 实例 Guzzle HTTP 客户端
$client = new \GuzzleHttp\Client();

// 3. 打开并迭代处理 CSV
$csv =\League\Csv\Reader::createFromPath($argv[1]);
foreach ($csv as $csvRow) {
    try {
        // 4. 发送 HTTP OPTIONS 请求
        $httpResponse = $client->options($csvRow[0]);
            
        // 5. 检查HTTP 响应的状态码
        if ($httpResponse->getStatusCode() >= 400) {
            throw new \Exception();
        }
    }catch (\Exception $e) {    
        // 6. 把死链发给标准输出
        echo $csvRow[0] . PHP_EOL;  
    }
}
