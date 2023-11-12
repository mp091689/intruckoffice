<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Response;

class AddressController extends Controller
{
    /**
     * @param  string  $zip
     *
     * @return JsonResponse
     */
    public function index(string $zip): JsonResponse
    {
        $response = \Http::asForm()->post(Setting::get('zip_url'), ['ZIP' => $zip])->body();

        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $response, $vals);
        xml_parser_free($parser);

        return Response::json($response);
    }
}
