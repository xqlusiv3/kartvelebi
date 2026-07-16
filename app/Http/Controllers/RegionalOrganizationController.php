<?php

namespace App\Http\Controllers;

use App\Models\RegionalOrganization;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegionalOrganizationController extends Controller
{
    public function index(Request $request): View
    {
        $districts = RegionalOrganization::query()
            ->published()
            ->whereNotNull('federal_district')
            ->where('federal_district', '!=', '')
            ->distinct()
            ->orderBy('federal_district')
            ->pluck('federal_district');

        $activeDistrict = $request->string('district')->toString();
        $search = trim($request->string('search')->toString());

        $organizations = RegionalOrganization::query()
            ->published()
            ->when($activeDistrict, fn ($query) => $query->where('federal_district', $activeDistrict))
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('region', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('leader_name', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->orderBy('sort_order')
            ->orderBy('federal_district')
            ->orderBy('region')
            ->orderBy('city')
            ->paginate(10)
            ->withQueryString();

        return view('regions.index', compact('organizations', 'districts', 'activeDistrict', 'search'));
    }

    public function show(RegionalOrganization $organization): View
    {
        abort_unless($organization->is_published, 404);

        $relatedOrganizations = RegionalOrganization::query()
            ->published()
            ->whereKeyNot($organization->id)
            ->when($organization->federal_district, fn ($query) => $query->where('federal_district', $organization->federal_district))
            ->orderBy('sort_order')
            ->orderBy('city')
            ->take(3)
            ->get();

        return view('regions.show', compact('organization', 'relatedOrganizations'));
    }
}
