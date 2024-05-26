<?php

namespace App\Api;

class YandexDisk
{
    private const TOKEN = 'y0_AgAAAAAIwi5aAAvX4AAAAAEFtIUXAADU5NKyXBpClZyQscmLmg39Hrj0Aw';

    public function send(string $method, string $url, array $data): array
    {
        $fullQuery = ($method === "POST") ? $url : $url. '?' . http_build_query($data);

        $curl = curl_init($fullQuery);

        switch ($method) {
            case 'PUT':
                curl_setopt($curl, CURLOPT_PUT, true);
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, 1);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: OAuth ' . self::TOKEN]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        return (!empty($result)) ? json_decode($result, true) : [];
    }

    /**
     * Метод для получения общей информации об аккаунте
     *
     * @return array
     */
    public function diskGetInfo(): array
    {
        $urlQuery = 'https://cloud-api.yandex.net/v1/disk/';
        return $this->send("GET", $urlQuery, []);
    }

    public function createFolder(string $folderName): array
    {
        $url = "https://cloud-api.yandex.net/v1/disk/resources";
        return $this->send("PUT", $url, [
            'path' => "$folderName",
            'fields' => ['name', '_embedded.items.path'],
        ]);
    }
    public function publicResource($resource): array
    {
        $urlPublish = "https://cloud-api.yandex.net/v1/disk/resources/publish";
        return $this->send("PUT", $urlPublish, [
            'path' => $resource
        ]);
    }
    public function upload(string $file, string $filePath): mixed
    {
        $url = "https://cloud-api.yandex.net/v1/disk/resources/upload";

        $response = $this->send("GET", $url, [
            'path' => "Adds/$file",
            'fields' => ['name', '_embedded.items.path']
        ]);

        if(empty($response['error'])) {
            return $this->uploadFileToYandexDisk($filePath, $response['href']);
        }
        $this->send('PUT', $response['href'], []);
        return $response;
    }

    private function uploadFileToYandexDisk(string $file, string $href): mixed
    {
        $fileOpen = fopen($file, 'r');
        $curl = curl_init($href);
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_UPLOAD, true);
        curl_setopt($curl, CURLOPT_INFILESIZE, filesize($file));
        curl_setopt($curl, CURLOPT_INFILE, $fileOpen);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $httpCode;
    }

    public function getFolderInfo(string $resource = ''): array
    {
        $url = "https://cloud-api.yandex.net/v1/disk/resources";
        return $this->send("GET", $url, [
            'path' => empty($resource) ? "disk:/Adds" : $resource,
            'fields' => ['name', '_embedded.items.path'],
        ]);

    }
}





















