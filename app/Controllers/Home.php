<?php

namespace App\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\RemoteConfig;

class Home extends BaseController
{
    public function index(): string
    {
        // error_reporting(1);
        // ini_set("display_errors", 1);

        $factory = (new Factory)->withServiceAccount('../google-services.json');
        $remoteConfig = $factory->createRemoteConfig();
        $template = $remoteConfig->get();
        $version = $template->version();
        $template = $remoteConfig->get($version->versionNumber());

        $paramName = 'setup_list_new';

        $parameter = $template->parameters();
        $listParam = $parameter[$paramName];
        $parameterData = $listParam->defaultValue()->toArray();

        $cctv_list = [];
        if ($parameterData && sizeof($parameterData) > 0 && isset($parameterData["value"])) {
            $cctv_list = json_decode($parameterData["value"]);
        }

        $cctv_list = array_map(function ($cctv) {
            $videosrc = "http://" . $cctv->ip_address_server_cctv . ":" . $cctv->port_server_cctv_http . "/" . $cctv->path_server_cctv;
            return [
                "nama" => $cctv->nama,
                "jalan" => $cctv->jalan,
                "status_online" => $cctv->status_online,
                "video_src" => $videosrc,
                "latitude" => $cctv->latitude,
                "longitude" => $cctv->longitude,
                "visible" => $cctv->visible
            ];
        }, $cctv_list);

        return view('home_map', ["cctv_list" => $cctv_list]);
    }

    public function proxy()
    {
        $encodedUrl = $this->request->getGet("url");
        if (!$encodedUrl) {
            http_response_code(400);
            echo "Missing URL.";
            exit;
        }

        // Decode the base64 URL
        $url = base64_decode($encodedUrl);
        // Validate URL
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            http_response_code(400);
            echo "Invalid URL.";
            exit;
        }

        // Get headers for .ts files
        $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));

        $contentType = match ($ext) {
            'm3u8' => 'application/vnd.apple.mpegurl',
            'ts'   => 'video/MP2T',
            default => 'application/octet-stream',
        };

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: $contentType");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] ?? 'PHP HLS Proxy');
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            http_response_code(502);
            echo "Error fetching URL.";
            exit;
        }
        curl_close($ch);

        if ($ext === 'm3u8') {
            $baseUrl = preg_replace('/[^\/]+$/', '', $url); // base path

            $response = preg_replace_callback('/^([^#\n\r][^\n\r]*)/m', function ($matches) use ($baseUrl) {
                $line = trim($matches[1]);

                // Ignore full URLs
                if (preg_match('#^https?://#', $line)) return $line;

                $proxiedUrl = base64_encode($baseUrl . $line);
                return 'proxy?url=' . urlencode($proxiedUrl);
            }, $response);
        }

        echo $response;
    }

    public function about()
    {
        return view('about_us');
    }
}
