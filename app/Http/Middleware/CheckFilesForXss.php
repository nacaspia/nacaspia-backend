<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class CheckFilesForXss
{
    public function handle(Request $request, Closure $next): Response
    {
        $this->checkFiles($request->allFiles());

        return $next($request);
    }

    private function checkFiles($files)
    {
        foreach ($files as $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $this->checkFile($file);
            }
            elseif (is_array($file)) {
                $this->checkFiles($file);
            }
        }
    }

    private function checkFile($file)
    {
        if (!$file->isValid()) return;

        $ext = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        if (!$path || !file_exists($path)) return;

        $contents = file_get_contents($path);
        if ($contents === false) return;

        if ($ext === 'svg' && preg_match('/<(script|iframe|object|embed|form|input)|on\w+=|javascript:/i', $contents)) {
            abort(400, 'Malicious SVG');
        }

        if ($ext === 'pdf' && preg_match('/(JavaScript|Launch|OpenAction|EmbeddedFile|AcroForm|RichMedia)/i', $contents)) {
            if (preg_match('/alert\(|confirm\(|prompt\(|console\.(log|warn|error|debug)/i', $contents)) {
                abort(400, 'Malicious PDF');
            }
        }
    }
}
