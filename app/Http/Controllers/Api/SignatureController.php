<?php

<?php

namespace App\Http\Controllers\Api;

use App\Signature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;

class SignatureController extends Controller
{
    /**
     **_ Return a paginated list of signatures.
     _**
     **_ @return SignatureResource
     _**/
    public function index()
    {
        $signatures = Signature::latest()
            ->ignoreFlagged()
            ->paginate(20);

        return SignatureResource::collection($signatures);
    }

    /**
     _ Fetch and return the signature.
     _
     _ @param Signature $signature
     _ @return SignatureResource
     _*/
    public function show(Signature $signature)
    {
        return new SignatureResource($signature);
    }

    /**
     _ Validate and save a new signature to the database.
     _
     _ @param Request $request
     _ @return SignatureResource
     _*/
    public function store(Request $request)
    {
        $signature = $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'body' => 'required|min:3'
        ]);

        $signature = Signature::create($signature);

        return new SignatureResource($signature);
    }
}
