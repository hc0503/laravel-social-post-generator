<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Niche;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Default page configs
     * 
     * @var array
     */
    protected $pageConfigs = [
        'navbarType' => 'sticky',
        'footerType' => 'static',
        'horizontalMenuType' => 'floating',
        'theme' => 'dark',
        'navbarColor' => 'bg-primary'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $profiles = Auth()->user()->profiles;

        return view('/pages/profiles/index', [
            'pageConfigs' => $this->pageConfigs,
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $niches = Niche::all();
        $breadcrumbs = [
            ['link' => "/profiles", 'name' => trans('locale.profile.title')],
            ['name'=>trans('locale.profile.create')]
        ];

        return view('/pages/profiles/create', [
            'pageConfigs' => $this->pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'niches' => $niches
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Auth()->user()->profiles()->create([
            'niche_id' => $request->niche,
            'hashtag' => $request->hashtag,
            'favour_color' => $request->favour_color
        ]);

        return redirect()->route('profiles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Profile $profile): RedirectResponse
    {
        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('message', trans('locale.profile.message.delete'));
    }
}
