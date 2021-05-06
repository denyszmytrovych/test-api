<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversionRequest;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use App\Services\RomanNumeralConverter;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversionController extends Controller
{
    protected RomanNumeralConverter $converter;

    public function __construct(RomanNumeralConverter $converter)
    {
        $this->converter = $converter;
    }

    public function index()
    {
        return ConversionResource::collection(Conversion::all());
    }

    public function convert(ConversionRequest $request)
    {
        $conversion = Conversion::where('integer', $request->integer)->first();

        if (!$conversion) {
            // convert integer to the Roman Numeral value
            $romanNumeral = $this->converter->convertInteger($request->integer);

            $newConversion = Conversion::create([
                'integer' => $request->integer,
                'roman' => $romanNumeral,
                'count' => 1
            ]);

            return new ConversionResource($newConversion);
        }

        $conversion->increment('count');

        return new ConversionResource($conversion);
    }

    public function top()
    {
        return ConversionResource::collection(Conversion::orderBy('count', 'DESC')->take(10)->get());
    }
}
