<?php

namespace App\Http\Middleware;

use Closure;
use DOMDocument;
use DOMXPath;

class ArabicNumberMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response) {
            $content = $response->getContent();

            $doc = new DOMDocument();
            libxml_use_internal_errors(true); // تجاهل التحذيرات

            // تحميل الـ HTML
            $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

            $xpath = new DOMXPath($doc);

            // تحديد كل النصوص داخل العناصر المرئية (بعيدًا عن السكربتات والستايل)
            $textNodes = $xpath->query('//text()[not(ancestor::script) and not(ancestor::style) and not(ancestor::noscript)]');

            foreach ($textNodes as $node) {
                $node->nodeValue = $this->convertToArabicNumbers($node->nodeValue);
            }

            // إعادة بناء المحتوى النهائي (نأخذ فقط ما داخل البودي)
            $body = $doc->getElementsByTagName('body')->item(0);
            $newContent = '';
            foreach ($body->childNodes as $child) {
                $newContent .= $doc->saveHTML($child);
            }

            $response->setContent($newContent);
        }

        return $response;
    }

    private function convertToArabicNumbers(string $input): string
    {
        $arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        return strtr($input, array_flip(array_combine(range(0, 9), $arabicNumbers)));
    }
}
