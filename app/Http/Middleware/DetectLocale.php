<?php declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;

class DetectLocale
{
    /**
     * Locale Cookie name.
     *
     * @var mixed
     */
    protected $cookie;

    /**
     * Allowed locales list.
     *
     * @var $this
     */
    protected $locales;

    /**
     * DetectLocale constructor.
     */
    public function __construct()
    {
        $this->cookie = config('app.locale_cookie');

        $this->locales = collect(explode(',', config('app.locales')))->push(config('app.locale'));
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = session('session.locale');

        if (!$this->check($locale)) $locale = $this->detectLocale($request);

        session(['session.locale' => $locale]);

        to_js(['locale' => $locale]);

        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Check if locale is allowed
     *
     * @param $locale
     * @return bool
     */
    public function check($locale): bool
    {
        if (!$locale) return false;

        return $this->locales->contains($locale);
    }


    /**
     * Get languages from "HTTP_ACCEPT_LANGUAGE"
     *
     * @param Request $request
     * @return Repository|Application|mixed|string
     */
    protected function detectLocale(Request $request)
    {
        preg_match_all('/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i', $request->server('HTTP_ACCEPT_LANGUAGE'), $languages, PREG_SET_ORDER);

        $languages = collect($languages);

        $detectedLocale = config('app.locale');

        foreach ($languages as $language) {
            $locale = strtolower($language[1]);

            if ($this->locales->contains($locale)) {
                $detectedLocale = $locale;
                break;
            }
        }

        return $detectedLocale;
    }
}
