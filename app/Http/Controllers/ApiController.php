<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\MatchRequest;
use App\Services\MatcherService;
use Illuminate\Http\Request;

class ApiController
{
    protected $matcherService;

    public function __construct(MatcherService $matcherService)
    {
        $this->matcherService = $matcherService;
    }

    public function match($propertyId)
    {
        $matches = $this->matcherService->match(intval($propertyId));
        return response()->json(['data' => $matches]);
    }
}
