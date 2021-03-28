<?php

namespace App\Services;

use App\Models\Site;
use App\Models\Statistic;
use Illuminate\Support\Facades\Http;

class CallibriService
{
    /**
     * @var mixed
     */
    private $url;
    /**
     * @var array
     */
    private $baseParams;

    public function __construct()
    {
        $this->url = env('CALLIBRI_URL');
        $this->baseParams = [
            'user_email' => env('CALLIBRI_USER_EMAIL'),
            'user_token' => env('CALLIBRI_USER_TOKEN')
        ];
    }

    /**
     * Get sites
     */
    public function getSitesStatistics(): void
    {
        try {
            $response = Http::get("{$this->url}/get_sites", $this->baseParams);
        } catch (\Exception $e) {
            \Log::error("Не удолось получить информацию по сайтам: {$e->getMessage()}");

            return;
        }

        if ($response->ok()) {
            $data = $response->json()['sites'];
            foreach ($data as $item) {
                $site = Site::where('site_id', $item['site_id'])->get();
                if ($site->count() === 0) {
                    $site = new Site();
                    $site->site_id = $item['site_id'];
                    $site->name = $item['sitename'];
                    $site->is_active = $item['active'] === 'true';
                    $site->domains = $item['domains'];
                    $site->save();

                }
            }

            $this->getStatistics();
        }
    }

    /**
     * Get statistics
     */
    protected function getStatistics(): void
    {
        $date2 = new \Carbon\Carbon();
        $date1 = $date2->clone()->subDays(5);
        $sites = Site::all();
        foreach ($sites as $site) {
            if ($site->is_active === false) {
                continue;
            }
            try {
                $params = $this->baseParams;
                $params['date1'] = $date1->format('d.m.Y');
                $params['date2'] = $date2->format('d.m.Y');
                $params['site_id'] = $site->site_id;
                $response = Http::get("{$this->url}/site_get_statistics", $params);
            } catch (\Exception $e) {
                \Log::error("Не удолось получить статистику: {$e->getMessage()}");

                return;
            }

            if ($response->ok()) {
                $data = $response->json();
                if (isset($data['channels_statistics'])) {
                    foreach ($data['channels_statistics'] as $calls) {
                        foreach ($calls['calls'] as $item) {
                            $item['call_id'] = $item['id'];
                            unset($item['id']);
                            $item['site_id'] = $site->id;
                            $statistic = Statistic::firstOrCreate(['call_id' => $item['call_id']], $item);
                        }
                    }
                }
            }
        }
    }
}
