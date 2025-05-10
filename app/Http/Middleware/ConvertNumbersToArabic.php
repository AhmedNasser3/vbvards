<?php
namespace App\Http\Middleware;

use Closure;

class ConvertNumbersToArabic
{
    /**
     * تحويل الأرقام إلى الأرقام العربية.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // التأكد من أن الرد هو View
        if ($response instanceof \Illuminate\View\View) {
            $response->getData();
            $data = $response->getData();

            // تحويل الأرقام في الـ data
            array_walk_recursive($data, function (&$value) {
                if (is_string($value)) {
                    $value = $this->convertToArabicNumbers($value);
                }
            });

            $response->with($data);
        }

        return $response;
    }

    /**
     * دالة تحويل الأرقام إلى الأرقام العربية.
     *
     * @param  string  $number
     * @return string
     */
    public function convertToArabicNumbers($number)
    {
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        return strtr($number, array_flip(array_combine(range(0, 9), $arabicNumbers)));
    }
}
