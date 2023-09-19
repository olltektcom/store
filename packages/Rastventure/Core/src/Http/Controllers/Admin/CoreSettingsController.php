<?php

namespace Rastventure\Core\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Rastventure\Core\Repositories\ThemeBannersRepository;


class CoreSettingsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    protected $themeBannersRepository;


    /* Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ThemeBannersRepository $themeBannersRepository)
    {
        $this->middleware('admin');
        $this->themeBannersRepository = $themeBannersRepository;
        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function banner()
    {
        $banners = $this->themeBannersRepository->all();
        return view($this->_config['view'], compact('banners'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->themeBannersRepository->saveBanners();
        session()->flash('success', "Theme banners are updated successfully!");
        return redirect()->route($this->_config['redirect']);
    }
}
