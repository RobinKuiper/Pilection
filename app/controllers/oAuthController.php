<?php

class oAuthController extends \BaseController
{

    protected $user;
    protected $settings;

    public function __construct(User $user, Settings $settings)
    {
        $this->beforeFilter('guest', ['only' => ['create', 'store']]);
        $this->beforeFilter('csrf', ['on' => 'post']);
        $this->user = $user;
        $this->settings = $settings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($social_provider, $action = "") {
        // check URL segment
        if ($action == "auth") {

            // process authentication
            try {
                Session::set('provider', $social_provider);
                Hybrid_Endpoint::process();
            } catch (Exception $e) {
                // redirect back to http://URL/social/
                return Redirect::route('loginWith');
            }
            return;
        }

        try {
            // create a HybridAuth object
            $socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
            // authenticate with Provider
            $provider = $socialAuth->authenticate($social_provider);

            // fetch user profile
            $userProfile = $provider->getUserProfile();
        } catch(Exception $e) {
            // exception codes can be found on HybBridAuth's web site
            Session::flash('error_msg', $e->getMessage());
            return Redirect::to('/login');
        }

        return View::make('oauth.create', ['userprofile' => $userProfile]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($userProfile=null)
    {
        if (isset($userProfile->username))
            $username = strlen($userProfile->username) > 0 ? $userProfile->username : "";

        if (isset($userProfile->screen_name))
            $username = strlen($userProfile->screen_name) > 0 ? $userProfile->screen_name : "";

        if (isset($userProfile->displayName))
            $username = strlen($userProfile->displayName) > 0 ? $userProfile->displayName : "";

        $email = strlen($userProfile->email) > 0 ? $userProfile->email : "";
        $email = strlen($userProfile->emailVerified) > 0 ? $userProfile->emailVerified : "";

        $password = 'test';

        if (User::where('email', $email)->count() <= 0) {
            $user = $this->user->create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);

            $this->settings->saveDefaults($user->id);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], Input::get('remember'))) {
            $this->user->where('id', '=', Auth::user()->id)->update(['lastlogin' => date('Y-m-d H:m:s')]);

            return Redirect::to(Input::get('url'))
                ->with('message', 'You are now logged in!')
                ->with('alert_class', 'alert-success');
        }

        return Redirect::to('login')
            ->with('message', 'Your credentials are incorrect, ' . link_to('password/forgot', 'forgot your password?'))
            ->with('alert_class', 'alert-danger')
            ->withInput();
    }

}