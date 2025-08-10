<?php
namespace App\Scraping;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class Useful
{
    public function scrape($limit = 100, $postLimit = 100)
    {
        $site = 'https://afsi.gov.az/az/legislation/veterinary';
        $client = $this->initializeHttpClient();
        try {
            $response = $client->get($site);
            $htmlContent = $response->body();
        } catch (\Exception $e) {
            // Log the error
            return"cURL Error: " . $e->getMessage();
        }
        $crawler = new Crawler($htmlContent);
        $resoult = [];
        $crawler->filter('.content_div.full_qanun ul.full li')->each(function ($class) use (&$resoult, $client, $limit, $postLimit) {
            if (count($resoult) >= $limit) {
                return false; // Stop if the limit is reached
            }

            $title = $class->filter('a span.full')->first()->text(); // Extract text from <span> inside <a>

            $datetime = Carbon::now();

            $link = $class->filter('a')->first(); // Get the first <a> tag
            if ($link->count()) {
                $url = $link->attr('href'); // Extract href attribute

                $jobUrl = [
                    'url' => $url,
                    'title' => $title,
                    'datetime' => $datetime,
                ];

                $jobUrl = $this->url($client, $jobUrl); // Process the URL (if needed)
                if ($jobUrl) {
                    $resoult[] = $jobUrl;
                }
            }
        });


        // Hər bir `.reports__item` elementi üzrə dövr
        /*$crawler->filter('.reports__item')->each(function ($class) use (&$resoult, $client, $limit, $postLimit) {
            if (count($resoult) >= $limit) {
                return false; // Məhdudiyyətə çatıbsa dövrü dayandır
            }

            $title = $class->filter('.reports__desc p')->each(function ($node) {
                return $node->text();
            });

            $datetime = $class->filter('.reports__head span')->text('');

            $class->filter('a')->each(function ($link) use (&$resoult, $client, $postLimit, $title, $datetime) {
                if (count($resoult) < $postLimit) {
                    $url = $link->attr('href');

                    $jobUrl = [
                        'url' => $url,
                        'title' => $title,
                        'datetime' => $datetime,
                    ];

//                    dd($jobUrl);
                    $jobUrl = $this->url($client, $jobUrl);
                    if ($jobUrl) {
                        $resoult[] = $jobUrl;
                    }
                }
            });
        });*/

        return $resoult;
    }

    // You can include the rest of the methods from HelloJobController@data here
    private function initializeHttpClient()
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';
        return Http::withHeaders(['User-Agent' => $userAgent]);
    }

    private function url($client,$useful)
    {

        $url = 'https://afsi.gov.az/'.$useful['url'];
        try {
            if ($url && $useful['title']) {
                $data = [];
                $title = $useful['title'];//$crawler->filter('.full .sened_top_span')->text();
                $datetime = $useful['datetime'];//$crawler->filter('.full .news_date')->text();
                $file = '';
//                dd($useful['url']);
                if (!empty($url)) {
                    $fileData = @file_get_contents($url);
                    if ($fileData === false) {
                        // Hata durumunda bildirim
                        Log::error("Şəkil URL'den veri alınamadı: $url");
                    } else {
                        // Dosya uzantısını al
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        if (is_array($title)) {
                            $title = $title[0]; // Array-dakı bütün elementləri mətnə birləşdir
                        }else{
                            $title = $title;
                        }
                        // Dosya adını tanımla
                        $fileName = 'uploads/useful/file/' . preg_replace('/\s+/', '-', mb_strtolower($title, 'UTF-8')) . '.' . $extension;
//                        dd($fileName);
                        $directory = dirname($fileName);

                        if (!file_exists($directory)) {
                            if (!mkdir($directory, 0777, true)) {
                                Log::error("Klasör oluşturulamadı: $directory");
                                dd('Klasör oluşturma hatası');
                            }
                        }

                        // Dosyaya veriyi yaz
                        if (file_put_contents($fileName, $fileData) !== false) {
                            $file = preg_replace('/\s+/', '-', mb_strtolower($title, 'UTF-8')) . '.' . $extension;
                            Log::error("Şəkil dosyaya kaydedilemedi: $file");
                        } else {
                            // Hata durumunda bildirim
                            Log::error("Şəkil dosyaya kaydedilemedi: $fileName");
                        }
                    }

                }


                $data = [
                    'title' => $title,
                    'file' => $file,
                    'datetime' => $datetime,
                ];

                if (!empty($data)) {
                    $dataSave = self::dataSave($data);
                    return $dataSave;
                } else {
                    return $data;
                }
            }
        } catch (\Exception $e) {
            // Log the exception or handle it in some way
            Log::info('Exception: ' . $e->getMessage());
        }
    }

    public static function dataSave($data)
    {
        $response = [];
        try {
            if (!empty($data) && $data != NULL) {
                $title = $data['title'];
                $datetime = $data['datetime'];
                $file = $data['file'];
                $usefulTitle = ['az' => $title,'en' => '','ru' => ''];
                $usefulSlug = ['az' => Str::slug($title),'en' => '','ru' => ''];
                $usefulData = \App\Models\Useful::where('slug->az',$usefulSlug)->first();
                if (!empty($usefulData) && $usefulData['slug']['az'] != $usefulSlug) {
                    return [
                        'success' => false,
                        'message' => 'Məlumat boş olduqu üçün bazaya heçnə yazılmadı.',
                        'code' => 422
                    ];
                }
                $useful = new \App\Models\Useful();
                $useful->category_id = 1;
                $useful->parent_category_id = 10;
                $useful->sub_parent_category_id = 13;
                $useful->file = $file;
                $useful->title = $usefulTitle;
                $useful->slug = $usefulSlug;
                $useful->status = 1;
                $useful->link = $request->link ?? null;
                $useful->datetime = date('Y-m-d H:i:s',strtotime($datetime));
                $useful->save();
                $response = [
                    'success' => true,
                    'message' => 'Məlumat bazaya yazıldı.',
                    'code' => 200
                ];

                // end news
                return $response;
            } else {
                return [
                    'success' => false,
                    'message' => 'Məlumat boş olduqu üçün bazaya heçnə yazılmadı.',
                    'code' => 422
                ];
            }
        } catch (\Exception $e) {
            Log::info('Exception: ' . $e->getMessage());
        }
    }
}
