<?php

class SettingsController extends \BaseController
{
    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->beforeFilter('auth', ['only' => ['edit', 'index', 'show', 'update']]);
        //$this->beforeFilter('csrf', ['only' => 'edit']);
        $this->settings = $settings;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit()
    {
        $settings = $this->settings->where('user_id', '=', Auth::user()->id)->first();
        return View::make('settings.edit', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

}