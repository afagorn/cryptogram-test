<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Cards\Command\CreateCryptogram\Command;
use App\Cards\Command\CreateCryptogram\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CryptogramController extends Controller
{
    public function __construct(private Handler $handler)
    {
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pan' => 'required|max:16|min:16|string',
            'cvc' => 'required|max:3|min:3|string',
            'cardholder' => 'required|string',
            'expire' => 'required|string'
        ]);

        if ($validator->fails()) {
            Log::channel('cryptogram')->critical($validator->errors());
            return response()->json($validator->errors(), 400);
        }

        $data = $validator->validated();

        $command = new Command();
        $command->pan = $data['pan'];
        $command->cvc = $data['cvc'];
        $command->expire = $data['expire'];
        $command->cardHolder = $data['cardholder'];

        $cryptogram = $this->handler->handle($command);
        $data = $cryptogram->toFormatArray();

        Log::channel('cryptogram')->info('Success creating cryptogram', $data);

        return response()->json($data);
    }
}
